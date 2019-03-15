<?php
    
    namespace App\Http\Middleware;
    
    use Closure;
    use Illuminate\Support\Facades\Gate;
    use Illuminate\Support\Facades\Session;
    
    class Permission {
        public function handle($request, Closure $next, $permission) {
            
            if (\Auth::check()) {
                if (Gate::denies('permission', [$permission])) {
                    Session::flash('warning', 'No Tiene Permisos');
                    
                    return redirect()->back();
                }
            }
            
            return $next($request);
            
        }
        
    }
