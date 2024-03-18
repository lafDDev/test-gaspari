<?php

namespace App\Repositories;

use App\Models\Person;


class PersonRepository implements PersonRepositoryInterface
{
   
    public function getList() {
        return Person::all();
    }

   
    public function getById(int $id) {
        return Person::find($id);
    }


    public function create(array $data) {
        return Person::create($data);
    }

    public function delete(Person $person) {
        return $person->delete();
    }
}
