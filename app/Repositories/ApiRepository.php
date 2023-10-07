<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterfaces;
// use illuminate\Support\Facades\DB;
use DB;

class ApiRepository implements RepositoryInterfaces
{
    public function all($table)
    {
        return DB::table($table)->get();
    }

    public function store($table, $data)
    {
        return DB::table($table)->insert($data);
    }

    public function destroy($table, $id)
    {
        return DB::table($table)->where('id', $id)->delete();
    }

    public function getUser($table, $id)
    {
        return DB::table($table)->where('id', $id)->get();
    }

    public function update($table, $data, $id)
    {
        return DB::table($table)->where('id', $id)->update($data->all());
    }
}
