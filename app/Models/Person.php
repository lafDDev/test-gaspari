<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';
   
    public $timestamps = true;

    protected $fillable = [
        'firstname',
        'lastname',
        'birth_date',
        'gender',
        'email'
    ];

}
