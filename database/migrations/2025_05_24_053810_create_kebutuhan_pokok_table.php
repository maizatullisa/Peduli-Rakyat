<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kebutuhan_pokok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('beras')->default(0);       // kg/bulan
            $table->integer('minyak')->default(0);      // liter/bulan
            $table->integer('gas')->default(0);         // tabung/bulan
            $table->integer('listrik')->default(0);     // Rp/bulan
            $table->integer('air')->default(0);         // Rp/bulan
            $table->integer('kesehatan')->default(0);   // estimasi Rp/bulan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kebutuhan_pokok');
    }
};
