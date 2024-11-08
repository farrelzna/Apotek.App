<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'medicines', 'name_customer', 'total_price'
    ];

    //  karna migration tidak bisa membaca tipe data array, jadi array di migration harus di ubah jadi json,
    //  agar bisa di insert ke database beruoa array (store/get). jd harus dipastikan dengan $cast
    //  $cast:mengecek tipe data di migration
    protected $casts = [
        'medicines' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
