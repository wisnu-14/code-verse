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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');  // IP pengunjung
            $table->string('user_agent');  // Informasi browser dan perangkat
            $table->unsignedBigInteger('user_id')->nullable();  // ID user jika login
            $table->timestamp('visited_at')->useCurrent();  // Waktu kunjungan
            $table->timestamps();  // Waktu dibuat dan diubah
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
