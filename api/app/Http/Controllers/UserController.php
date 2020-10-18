<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\User;

class UserController extends APIController
{
    public function view(Request $request, $id = null)
    {
        # /users/me/ - usuário logado
        if ($id == 'me') {
            $user = Auth::user();
            return $user ?? abort(404);
        }
        # /users/ID/ - usuário de ID
        elseif ($id) {
            $user = User::find($id);
            return $user ?? abort(404);
        }
        # users/ - lista usuários
        else {
            $users = $this->filter($request, User::class);
            return $this->paginate($request, $users)->get(User::$minified);
        }
    }

    public function list_full(Request $request) 
    {
        $users = $this->filter($request, User::class);
        $users = $users->get();         
        return $users;
    }

    public function pagination(Request $request)
    {
        $users = $this->filter($request, User::class);
        return $this->pagination_info($request, $users);
    }

    public function create(Request $request)
    { 
        $validatedData = $this->validate($request, User::$rules);
        //$validatedData['usermail'] = $request->usermail;
        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $rules = User::$rules;
            $rules['username'] .= ','.$id;
            foreach ($rules as $key => $value) {
                if (!$request->has($key)) unset($rules[$key]);
            }
            $validatedData = $this->validate($request, $rules);
            if (in_array('password', array_keys($validatedData))) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }
            $user = $user->fill($validatedData);
            $user->touch();
            return $user;
        }
        else {
            abort(404);
        }
    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return $user;
        }
        else {
            abort(404);
        }
    }
}
