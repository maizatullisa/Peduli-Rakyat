<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kebutuhan_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->integer('jumlah_anak')->default(0);      // jumlah anak sekolah
            $table->integer('spp_per_anak')->default(0);     // Rp per anak per bulan
            $table->integer('transport')->default(0);        // Rp transport sekolah per bulan
            $table->integer('buku')->default(0);            // Rp kebutuhan buku per bulan
            $table->integer('pendapatan')->default(0);      // Rp total pendapatan per bulan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kebutuhan_pendidikan');
    }
};
