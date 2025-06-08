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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (pengguna yang memesan)
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            
            // Relasi ke tabel users (teknisi yang ditugaskan) - nullable
            $table->foreignId('teknisi_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            
            // Relasi ke tabel services (layanan yang dipilih)
            $table->foreignId('service_id')
                ->constrained('services')
                ->onDelete('cascade');
            
            // Waktu pembuatan pesanan
            $table->dateTime('tanggal_pesanan')->useCurrent();
            
            // Tanggal dan waktu servis yang diinginkan
            $table->date('tanggal_service_diharapkan');
            $table->time('jam_service_diharapkan');
            
            // Alamat tempat servis dan deskripsi masalah
            $table->text('alamat_service');
            $table->text('deskripsi_masalah')->nullable();
            
            // Status pesanan
            $table->enum('status_order', ['pending', 'diterima', 'dalam_proses', 'selesai', 'dibatalkan'])
                ->default('pending');
            
            // Total harga pesanan
            $table->decimal('total_harga', 10, 2)->default(0.00);
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
