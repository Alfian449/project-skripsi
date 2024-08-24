<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique()->nullable();
            $table->string('nip')->unique()->nullable();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('kelas')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('phone')->nullable();
            $table->string('tahun_pelajaran')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->enum('role', ['admin', 'siswa', 'guru',]);
            $table->string('status')->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
