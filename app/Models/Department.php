<?php

namespace App\Models;

use App\Traits\SelfReferenceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, SelfReferenceTrait;
    protected $guarded = [];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
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
