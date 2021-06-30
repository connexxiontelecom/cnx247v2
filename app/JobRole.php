<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class JobRole extends Model
{
    //department-job-role relationship
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }


    /*
     * Use-case methods
     */

	public function getTenantJobRoles(){
		return JobRole::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'ASC')->get();
	}


}
