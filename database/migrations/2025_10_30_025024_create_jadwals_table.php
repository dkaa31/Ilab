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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->string('jam_ke');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('set null');
        $table->foreignId('mapel_id')->nullable()->constrained('mapels')->onDelete('set null');
        $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade');
        $table->foreignId('kelase_id')->constrained('kelases')->onDelete('cascade');
        $table->enum('status', ['Aktif','Istirahat'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
