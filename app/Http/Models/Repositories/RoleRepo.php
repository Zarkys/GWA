<?php
    
    namespace App\Http\Models\Repositories;

    use App\Http\Models\Entities\Role;
    
    class RoleRepo {

        public function all() {
            
            $roles = Role::all();
            
            return $roles;
        }
     
        public function addRole($user, $role) {
            $role = Role::find($role);
            $role->users()->attach($user);
            
            return $role;
        }
        
     
        public function getRoles() {
            $roles = Role::orderBy('name', 'asc')->get();
            
            return $roles;
        }
        
        public function find($role) {
            $role = Role::with(['permissions'])->find($role);
            
            return $role;
        }
        
        public function createRole($data) {
            $role = Role::create($data);
            
            return $role;
        }
        
     
        public function userRoles($user) {
            $roles = Role::with(['permissions'])->whereHas('users', function ($query) use ($user) {
                $query->where('id', $user);
            })->get();
            
            return $roles;
        }
    }
