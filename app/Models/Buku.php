<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'writer', 
        'publisher', 
        'isbn', 
        'category', 
        'synopsis', 
        'cover',
        'pdf'
    ];
}
