<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterfaces;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use DB;

class ApiRepository implements RepositoryInterfaces
{
    public function all($table)
    {
        return DB::table($table)->get();
    }

    public function store($table,$data)
    {
        // $user = User::create($data);

        $user = DB::table($table)->insert($data);

        if (!empty($user)) {
            return $user;
        } else {
            return [];
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        User::destroy($id);

        if(!$user)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getUser($id)
    {
        $user = User::find($id);

        if (!empty($user)) {
            return $user;
        } else {
            return [];
        }
    }

    public function update($data, $id)
    {
        $user = User::find($id);
        $status = $user->update($data->all());

        if ($user == true) {
            return $user;
        } else {
            return [];
        }
    }
}
