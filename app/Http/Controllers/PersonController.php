<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Repositories\PersonRepositoryInterface;

class PersonController extends Controller
{
    
    private $personRepository;

    public  function __construct(PersonRepositoryInterface $personRepository) {
        $this->personRepository = $personRepository;
    }

    public function index()
    {
        $people = $this->personRepository->getList();
        return response()->json(['people' => $people], 200);
    }

    public function find($id){

        return response()->json($this->personRepository->getById($id),200);

    }

    public function create(PersonRequest $request)
    {
        $data = $request->validated();
        $this->personRepository->create($data);

        return response()->json([], 201);
    }


    public function update(PersonRequest $request, int $id) {

        $person = $this->personRepository->getById($id);
        
        if (!$person) {
            return response()->json([
                'message' => 'Person id not found'
            ], 404);
        }

        $request->$id = $person->id;
        if (!$person->update($request->validated())) {
            return response()->json([
                'message' => 'Error on updating Person'
            ], 500);
        }
        return response()->json([], 204);
    }

    public function delete(int $id)
    {
        $person = $this->personRepository->getById($id);
        if (!$person) {
            return response()->json([
                'message' => 'Person id not found'
            ], 404);
        }
        if (!$this->personRepository->delete($person)) {
            return response()->json([
                'message' => 'Error on deleting Person'
            ], 500);
        }
        return response()->json([], 204);
    }
}
