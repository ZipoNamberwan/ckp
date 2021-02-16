<?php

namespace App\Traits;

trait SelfReferenceTrait
{
    protected $parentColumn = 'parent_id';

    public function parent()
    {
        return $this->belongsTo(static::class);
    }

    public function children()
    {
        return $this->hasMany(static::class, $this->parentColumn);
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function root()
    {
        return $this->parent
            ? $this->parent->root()
            : $this;
    }

    public function getAllChildrenUsers()
    {
        $users = collect();
        if ($this->allchildren) {
            foreach ($this->allchildren as $subdepartment) {
                $users = $users->merge($subdepartment->users);
                $users = $users->merge($subdepartment->getAllChildrenUsers());
            }
        }
        return $users;
    }

    public function getAllChildrenDepartment()
    {
        $departments = collect();
        if ($this->allchildren) {
            foreach ($this->allchildren as $subdepartment) {
                $subdepartmentarray = collect();
                $subdepartmentarray->push($subdepartment);
                $departments = $departments->merge($subdepartmentarray);
                $departments = $departments->merge($subdepartment->getAllChildrenDepartment());
            }
        }
        return $departments;
    }
}
