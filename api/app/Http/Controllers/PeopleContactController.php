<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeopleContact;
use App\People;

class PeopleContactController extends APIController
{
    public function view(Request $request, $people_id, $id = null)
    {
        # detalhamento
        if ($id) {
            $people_contact = PeopleContact::where('people_id', $people_id)->where('id', $id)->first();
            return $people_contact ?? abort(404);
        }
        # listagem
        else {
            $people_contacts = $this->filter($request, PeopleContact::class, PeopleContact::where('people_id', $people_id));
            return $this->paginate($request, $people_contacts)->get(PeopleContact::$minified);
        }
    }
     
    public function pagination(Request $request)
    {
        $people_contacts = $this->filter($request, PeopleContact::class);
        return $this->pagination_info($request, $people_contacts);
    }

    public function create(Request $request, $people_id) 
    {
        $people = People::find($people_id);
        if ($people) {
	        $validatedData = $this->validate($request, PeopleContact::$rules);
	        $people_contact = PeopleContact::create($validatedData);
        	return $people_contact;
        }
        else {
            abort(404);
        }
    }

    public function update(Request $request, $people_id, $id)
    {
        $people_contact = PeopleContact::where('people_id', $people_id)->where('id', $id)->first();
        if ($people_contact) {
            $validatedData = $this->validate($request, PeopleContact::$rules);
            $people_contact = $people_contact->fill($validatedData);
            $people_contact->touch();
            return $people_contact;
        }
        else {
            abort(404);
        }
    }

    public function delete(Request $request, $people_id, $id)
    {
        $people_contact = PeopleContact::where('people_id', $people_id)->where('id', $id)->first();
        if ($people_contact) {
            $people_contact->delete();
            return $people_contact;
        }
        else {
            abort(404);
        }
    }
}
