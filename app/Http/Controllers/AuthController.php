<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Models\Entities\Role;
    use App\Http\Models\Entities\User;
    use App\Http\Models\Enums\Permissions;
    use App\Http\Models\Enums\Roles;
    use App\Http\Models\Repositories\RoleRepo;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Gate;
    use Illuminate\Support\Facades\Session;
    
    class AuthController extends Controller {
        
        public function login() {
            
            return view('login');
        }
        
        public function logout() {
            
            Auth::logout();
            
            return redirect()->route('auth.login');
            
        }
        
        public function authenticate(Request $request, RoleRepo $rolesRepo) {
            
            $username    = $request->input('email');
            $password    = $request->input('password');
            $credentials = [
                'email'    => strtolower($username),
                'password' => $password,
            ];
            
            if (Auth::attempt($credentials)) {
                
                $roles       = collect();
                $permissions = collect();
                
                $user = User::where('id', Auth::id())->with([
                    'Rol' => function ($query) {
                        $query->with('permissions');
                    },
                ])->first();
                
                foreach ($user->Rol->permissions as $index => $item) {
                    $permissions->push($item->id);
                }
                
                $unique_permissions = $permissions->unique()->values()->all();
                Log::debug($unique_permissions);
                Session::put('permissions', $unique_permissions);
               
                if (Gate::allows('permission', [
                    Permissions::$login,
                    $unique_permissions,
                ])) {
                    Session::flash('message', 'Bienvenido: ' . Auth::user()->name);
                    
                    if ($user->rol === Roles::$root) {
                        Log::debug('Accediendo como Root');
                        return redirect()->route('root.index');
                    } else if($user->rol === Roles::$company){
                        Log::debug('Accediendo como Cliente');
                        return redirect()->route('admin.home');
                    }
                    
                    
                } else {
                    Log::debug('No esta accediendo');
                    Session::flash('warning', 'Usted no tiene acceso...');
                    
                    Auth::logout();
                    
                    return redirect()->route('auth.login');
                }
                
            }
            
            Session::flash('warning', 'Datos Incorrectos');
            
            return redirect()->route('auth.login');
            
        }
        
    }
