<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\RepositoryInterfaces;
use myMessage;
// use Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\MessageTrait;

class UserController extends Controller
{
    private $repositoryInterfaces;
    use MessageTrait;
    public function __construct(RepositoryInterfaces $repositoryInterfaces)
    {
        $this->repositoryInterfaces = $repositoryInterfaces;
    }

    public function index()
    {
        $table = 'users';
        $users = $this->repositoryInterfaces->all($table);

        if(!$users)
        {
            return $this->errorMessage(myMessage::GET_USER_ERROR);
        }
        else
        {
            return $this->successMessage(myMessage::GET_USER,$users);
        } 
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|regex:/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/|unique:users',
            'password' => 'required'
        ]);

        $table = 'users';
        $user = $this->repositoryInterfaces->store($table,$data);
    
        if(!$user)
        {
            return $this->errorMessage(myMessage::ADD_USER_ERROR);
        }
        else
        {
            return $this->successMessage(myMessage::ADD_USER,'');
        }        
    }

    public function destroy(Request $request)
    {
        $table = 'users';
        $id = $request->id;
        $user = $this->repositoryInterfaces->destroy($table,$id);
    
        if(!$user)
        {
            return $this->errorMessage(myMessage::DELETE_USER_ERROR);
        }
        else
        {
            return $this->successMessage(myMessage::DELETE_USER,'');
        }        
    }

    public function getUser(Request $request)
    {
        $table = 'users';
        $id = $request->id;
        $user = $this->repositoryInterfaces->getUser($table,$id);
    
        if(!$user)
        {
            return $this->errorMessage(myMessage::GET_USER_ERROR);
        }
        else
        {
            return $this->successMessage(myMessage::GET_USER,$user);
        }        
    }

    public function update(Request $request)
    {
        $table = 'users';
        $id = $request->id;
        $user = $this->repositoryInterfaces->update($table,$request,$id);
    
        if(!$user)
        {
            return $this->errorMessage(myMessage::UPDATE_USER_ERROR);
        }
        else
        {
            return $this->successMessage(myMessage::UPDATE_USER,'');
        }        
    }

    public function login(Request $request)
    {
        $status = $request->validate([
            'email' => 'required|regex:/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',
            'password' => 'required'
        ]);

        if(!$token = auth()->attempt($status))
        {
            return $this->errorMessage(myMessage::NOT_AUTH_USER);
        }

        return $this->responseWithToken($token);
    }

    protected function responseWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }

    public function profile()
    {
        return response()->json(auth()->user());
    }

}
