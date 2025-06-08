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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan'); 
            $table->text('deskripsi')->nullable(); 
            $table->decimal('harga_dasar', 10, 2); 
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); 
            $table->timestamps(); 
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });
        
        Schema::dropIfExists('services');
    }
};
