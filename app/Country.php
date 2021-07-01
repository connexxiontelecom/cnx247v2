<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //





/*
 * Use-case methods
 */

	public function getCountries(){
		return Country::orderBy('name', 'ASC')->get();
	}
}
