<?php 

namespace App\Repositories\Interfaces;

interface RepositoryInterfaces{
    public function all($table);

    public function store($table,$data);

    public function destroy($table,$id);

    public function getUser($table,$id);

    public function update($table,$data, $id);
}