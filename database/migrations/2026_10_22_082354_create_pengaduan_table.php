<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('email', 150);
            $table->string('no_hp', 20);
            $table->string('lampiran_path')->nullable();
            $table->string('lampiran_nama')->nullable();
            $table->longText('masukan');
            $table->timestamps();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};