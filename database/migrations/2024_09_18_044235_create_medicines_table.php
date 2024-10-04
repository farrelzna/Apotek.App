<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //up : membuat, dijalankan ketika "php artisan migrate"
    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            //membuat primary key dengan nama id dan sifatnya ai (auto increment)
            $table->id();
            //$table->tipedata('nama_field');
            $table->enum('type',['tablet', 'sirup', 'kapsul']);
            $table->string('name');
            $table->integer('price');
            $table->integer('stock');
            //membuat created at dan updated at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};