<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Client as ClientModel;

class Client extends Model
{
        //lead-client relationship
        public function lead(){
            return $this->hasOne(Lead::class, 'id');
        }

        public function addedBy(){
            return $this->belongsTo(User::class, 'owner');
        }




        /*
         * Use-case methods
         */
	public function addNewClient(Request $request){
		$messages = [
			'required' => 'The :attribute is mandatory',
			'mobile_no.regex' => 'The phone number must be in E.164 format(+234...)'
		];
		$this->validate([
			'first_name'=>'required',
			'surname'=>'required',
			'mobile_no'=>'required',
			'street_1'=>'required',
			'email'=>'required|email',
			'country'=>'required',
			'company_name'=>'required',
			'city'=>'required'
		], $messages);
		//|regex:/^\+[1-9]\d{1,14}$/
		$client = new ClientModel;
		$client->owner = Auth::user()->id;
		$client->assigned_to = Auth::user()->id;
		$client->company_name = $request->company_name;
		$client->first_name = $request->first_name;
		$client->surname = $request->surname;
		$client->mobile_no = $request->mobile_no;
		$client->position = $request->position ?? '';
		$client->website = $request->website ?? '';
		$client->street_1 = $request->street_1;
		$client->street_2 = $request->street_2 ?? '';
		$client->email = $request->email;
		$client->country_id = $request->country;
		$client->state_id = $request->state;
		$client->city = $request->city;
		$client->postal_code = $request->postal_code;
		$client->note = $request->note ?? '';
		$client->tenant_id = Auth::user()->tenant_id ?? 0;
		$client->slug = substr(sha1(time()), 13,40);
		$client->save();
		/*session()->flash("success", "<strong>Success!</strong> New client registered.");
		return redirect()->route('clients');*/
	}

}
