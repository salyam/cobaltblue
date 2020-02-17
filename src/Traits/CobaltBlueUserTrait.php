<?php

namespace Salyam\CobaltBlue\Traits;

trait CobaltBlueUserTrait
{

    public function roles() {
        return $this->belongsToMany('\Salyam\CobaltBlue\Models\Role');
    }

    public function permissions() {
        return $this->cb_directPermissions()->union($this->cb_indirectPermissions());
    }

    public function HasAnyRole(array $values) {
        foreach($values as $value) {
            if($this->HasRole($value)) {
                return true;
            }
        }
        return false;
    }

    public function HasEveryRole(array $values) {
        foreach($values as $value) {
            if(!$this->HasRole($value)) {
                return false;
            }
        }
        return true;
    }

    public function HasRole($value) : bool {
        if(is_int($value)) {
            return $this->roles()->get()->contains($value);
        }
        else if(is_string($value)) {
            $role = \Salyam\CobaltBlue\Models\Role::firstWhere('name', '=', $value);
            return $this->HasRole($role);
        }
        else if(is_a($value, '\Salyam\CobaltBlue\Models\Role')) {
            if($value != null) {
                return $this->roles()->get()->contains($value->id);
            }
        }

        return false;
    }

    public function GrantRole($value) {
        if(is_int($value)) {
            $this->roles()->attach($value);
        }
        else if(is_string($value)) {
            $$role = \Salyam\CobaltBlue\Models\Role::firstWhere('name', '=', $value);
            $this->GrantRole($role);
        }
        else if(is_a($value, '\Salyam\CobaltBlue\Models\Role')) {
            if($value != null) {
                return $this->roles()->attach($value->id);
            }
        }
    }
 
    public function RevokeRole($value) {
        if(is_int($value)) {
            $this->roles()->detach($value);
        }
         else if(is_string($value)) {
            $role = \Salyam\CobaltBlue\Models\Role::firstWhere('name', '=', $value);
            $this->RevokeRole($role);
        }
        else if(is_a($value, '\Salyam\CobaltBlue\Models\Role')) {
            if($value != null) {
                return $this->roles()->detach($value->id);
            }
        }
    }

    public function HasAnyPermission(array $values) {
        foreach($values as $value) {
            if($this->HasPermission($value)) {
                return true;
            }
        }
        return false;
    }

    public function HasEveryPermission(array $values) {
        foreach($values as $value) {
            if(!$this->HasPermission($value)) {
                return false;
            }
        }
        return true;
    }

    public function HasPermission($value) : bool {
        if(is_int($value)) {
            return $this->permissions()->get()->contains($value);
        }
        else if(is_string($value)) {
            $permission = \Salyam\CobaltBlue\Models\Permission::firstWhere('name', '=', $value);
            return $this->HasPermission($permission);
        }
        else if(is_a($value, '\Salyam\CobaltBlue\Models\Permission')) {
            if($value != null) {
                return $this->permissions()->get()->contains($value->id);
            }
        }

        return false;
    }

    public function GrantPermission($value) {
        if(is_int($value)) {
            $this->cb_directPermissions()->attach($value);
        }
        else if(is_string($value)) {
            $permission = \Salyam\CobaltBlue\Models\Permission::firstWhere('name', '=', $value);
            $this->GrantPermission($permission);
        }
        else if(is_a($value, '\Salyam\CobaltBlue\Models\Permission')) {
            if($value != null) {
                return $this->cb_directPermissions()->attach($value->id);
            }
        }
    }

    public function RevokePermission($value) {
        if(is_int($value)) {
            $this->cb_directPermissions()->detach($value);
        }
        else if(is_string($value)) {
            $permission = \Salyam\CobaltBlue\Models\Permission::firstWhere('name', '=', $value);
            $this->RevokePermission($permission);
        }
        else if(is_a($value, '\Salyam\CobaltBlue\Models\Permission')) {
            if($value != null) {
                return $this->cb_directPermissions()->detach($value->id);
            }
        }
    }

    private function cb_directPermissions() {
        return $this->belongsToMany('\Salyam\CobaltBlue\Models\Permission');
    }

    private function cb_indirectPermissions() {
        return $this->hasManyThrough('\Salyam\CobaltBlue\Models\Permission', '\Salyam\CobaltBlue\Models\Role');
    }
}