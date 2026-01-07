<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: buat tabel users
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                                // Primary key
            $table->string('name');                      // Nama lengkap
            $table->string('email')->unique();           // Email (unique)
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');                  // Password (hashed)
            // Kolom profil tambahan
            $table->string('nik')->unique();             // NIK Kepala Keluarga
            $table->string('alamat');                    // Alamat
            $table->string('no_kk');                     // Nomor KK
            $table->rememberToken();                     // Token "remember me"
            $table->timestamps();                        // created_at & updated_at
        });
    }

    /**
     * Rollback migrasi: drop tabel users
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
