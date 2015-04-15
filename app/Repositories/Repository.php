<?php
namespace App\Repositories;

interface Repository {

    public function all($columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $attributes);

    public function find($id, $columns = array('*'));

}