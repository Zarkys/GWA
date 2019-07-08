<?php
    
    namespace App\Http\Models\Repositories;
    
    use App\Http\Models\Entities\Permission;
    
    
    class PermissionsRepo {
        function getByRole($role) {
            $permissions = Permission::join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
                ->where('role_id', $role)->get();
            
            return $permissions;
        }
        
        public function getPermissions() {
            $permissions = Permission::orderBy('name', 'asc')->get();
            
            return $permissions;
        }
        
        public function createPermission($data) {
            $role = Permission::create($data);
            
            return $role;
        }
    }
