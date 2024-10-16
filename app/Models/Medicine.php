<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    //  ditambahkan jika nama migration dan name model berbeda
    protected $fillable = ['name', 'price', 'stock', 'type', 'description'];
}
