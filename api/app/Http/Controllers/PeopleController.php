<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;

class PeopleController extends APIController
{
    public function view(Request $request, $id = null)
    {
        # detalhamento
        if ($id) {
            $people = People::find($id);
            return $people ?? abort(404);
        }
        # listagem
        else {
            $peoples = $this->filter($request, People::class);
            return $this->paginate($request, $peoples)->get(People::$minified);
        }
    }

    public function list_full(Request $request)
    {
        $peoples = $this->filter($request, People::class);
        $peoples = $peoples->get();

        return $peoples;
    }
     
    public function pagination(Request $request)
    {
        $peoples = $this->filter($request, People::class);
        return $this->pagination_info($request, $peoples);
    }

    public function create(Request $request)
    {
        $validatedData = $this->validate($request, People::$rules);
        $people = People::create($validatedData);
        return $people;
    }

    public function update(Request $request, $id)
    {
        $people = People::find($id);
        if ($people) {
            $validatedData = $this->validate($request, People::$rules);
            $people = $people->fill($validatedData);
            $people->touch();
            return $people;
        }
        else {
            abort(404);
        }
    }

    public function delete(Request $request, $id)
    {
        $people = People::find($id);
        if ($people) {
            $people->fill(array('is_active' => false));
            $people->touch();
            return $people;
        }
        else {
            abort(404);
        }
    }
}
