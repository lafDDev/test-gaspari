<?php

namespace App\Repositories;

use App\Models\Person;

interface PersonRepositoryInterface
{

    public function getList();


    public function getById(int $id);

    public function create(array $data);

    public function delete(Person $person);



}