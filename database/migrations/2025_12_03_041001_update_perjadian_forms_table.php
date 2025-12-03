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
        Schema::table('perjadian_forms', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->after('id');
            $table->string('nama');
            $table->string('nip');
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->string('nama_kegiatan');
            $table->enum('jenis_kegiatan', ['dalam_kota', 'luar_kota']);
            $table->string('surat_kegiatan')->nullable(); // file path
            $table->string('nama_instansi');
            $table->text('alamat_kegiatan');
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('catatan_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perjadian_forms', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['user_id']);
            $table->dropColumn([
                'user_id',
                'nama',
                'nip',
                'nomor_surat',
                'tanggal_surat',
                'tanggal_berangkat',
                'tanggal_pulang',
                'nama_kegiatan',
                'jenis_kegiatan',
                'surat_kegiatan',
                'nama_instansi',
                'alamat_kegiatan',
                'status',
                'catatan_admin',
            ]);
        });
    }
};
