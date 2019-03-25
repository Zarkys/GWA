<?php
    
    namespace App\Http\Models\Repositories;
    
    use Mockery\Matcher\Type;
    
    use App\Http\Models\Entities\User;
    
    class UserRepo {
        public function all() {
            
            $users = User::with([
                    'Rol',
                ])->whereIn('active', [0, 1])->get();
            
            return $users;
        }
        
        public function find($id) {

            
            $user = User::find($id);

            
            return $user;
        }
        public function findbyid($id)
    {

        $user = User::find($id);

        return $user;
    }
        
        
        public function store($data) {
            
            $user = new User();
            $user->fill($data);
            $user->save();
            
            return $user;
        }
        
        public function update($user, $data) {
            
            $user->fill($data);
            $user->save();
            
            return $user;
        }
        
        public function activate($user, $data) {
            
            $user->fill($data);
            $user->save();
            
            return $user;
        }
        public function inactivate($user, $data) {
            
            $user->fill($data);
            $user->save();
            
            return $user;
        }
        
        public function delete($user, $data) {
            
            $user->fill($data);
            $user->save();
            
            return $user;
        }
    }
