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
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id(); // auto increment id
            $table->string('judul', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->foreignId('kategori_id')->nullable()->constrained()->onDelete('set null'); // foreign key ke tabel kategori
            $table->timestamps();
            $table->string('cover', 255)->nullable(); // untuk cover tutorial
            $table->string('kode', 255)->nullable();
            $table->bigInteger('views')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorials');
    }
};
