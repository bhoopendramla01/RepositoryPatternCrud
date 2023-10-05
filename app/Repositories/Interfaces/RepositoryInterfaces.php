<?php 

namespace App\Repositories\Interfaces;

interface RepositoryInterfaces{
    public function all($table);

    public function store($table,$data);

    public function destroy($id);

    public function getUser($id);

    public function update($data, $id);
}