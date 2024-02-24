<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'id' , 'name', 'author', 'ratt', 'vie', 'img','page','amazon','cover'
    ];
}
