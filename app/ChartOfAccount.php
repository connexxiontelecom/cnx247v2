<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChartOfAccount extends Model
{
    //


	/*
	 *
	 * Use-case methods
	 */
	public function getDetailedAccounts(){
		return DB::table(Auth::user()->tenant_id.'_coa')->where('type', 1)->get();
	}

	public function checkForAccountingPackageSubscription(){
		if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
			return 1; //subscribed for accounting package

		}else{
			return 0;
		}
	}
}
