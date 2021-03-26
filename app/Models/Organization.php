<?php

namespace App\Models;

use App\Traits\SelfReferenceTrait;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory, SelfReferenceTrait;
    protected $guarded = [];
    public $timestamps = false;

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function getAllChildrenDepartments()
    {
        $departments = collect();
        if ($this->allchildren) {
            foreach ($this->allchildren as $suborganization) {
                $departments = $departments->merge($suborganization->departments);
                $departments = $departments->merge($suborganization->getAllChildrenDepartments());
            }
        }
        return $departments;
    }

    public function getAllChildrenOrganizations()
    {
        $organizations = collect();
        if ($this->allchildren) {
            foreach ($this->allchildren as $suborganization) {
                $suborganizationarray = collect();
                $suborganizationarray->push($suborganization);
                $organizations = $organizations->merge($suborganizationarray);
                $organizations = $organizations->merge($suborganization->getAllChildrenOrganizations());
            }
        }
        return $organizations;
    }
}
