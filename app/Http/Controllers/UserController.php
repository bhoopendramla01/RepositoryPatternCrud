<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\RepositoryInterfaces;
use myConstant;
use myMessage;
use Auth;
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

    public function index(Request $request)
    {
        $table = $request->table;
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

        $table = $request->table;
        $user = $this->repositoryInterfaces->store($table,$data);
    
        if(!$user)
        {
            return $this->errorMessage(myMessage::ADD_USER_ERROR);
        }
        else
        {
            return $this->successMessage(myMessage::ADD_USER,$user);
        }        
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = $this->repositoryInterfaces->destroy($id);
    
        if($user)
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
        $id = $request->id;
        $user = $this->repositoryInterfaces->getUser($id);
    
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
        $id = $request->id;
        $user = $this->repositoryInterfaces->update($request,$id);
    
        if(!$user)
        {
            return $this->errorMessage(myMessage::UPDATE_USER_ERROR);
        }
        else
        {
            return $this->successMessage(myMessage::UPDATE_USER,$user);
        }        
    }
}
