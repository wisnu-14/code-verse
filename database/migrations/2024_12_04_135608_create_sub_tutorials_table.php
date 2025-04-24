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
        Schema::create('sub_tutorials', function (Blueprint $table) {
            $table->id(); // auto increment id
            $table->foreignId('tutorial_id')->nullable()->constrained('tutorials')->onDelete('set null'); // foreign key ke tabel tutorial
            $table->string('sub_judul', 255)->nullable();
            $table->text('penjelasan')->nullable();
            $table->timestamps();
            $table->text('kode')->nullable();
            $table->text('penjelasan_kode')->nullable();
            $table->string('type', 255)->nullable();
            $table->string('foto', 255)->nullable(); // untuk foto sub tutorial
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tutorials');
    }
};
