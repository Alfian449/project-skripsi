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
        Schema::create('rekaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('response_id')->constrained('users')->onDelete('cascade');
            $table->string('kedisiplinan');
            $table->string('tanggung_jawab');
            $table->string('komunikasi');
            $table->string('kerja_sama');
            $table->string('inisiatif');
            $table->string('ketekunan');
            $table->string('kreativitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekaps');
    }
};
