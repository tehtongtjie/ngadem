<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom phone setelah kolom email, bisa nullable
            $table->string('phone')->nullable()->after('email');
            // Tambahkan kolom address setelah kolom phone, bisa nullable
            $table->text('address')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom saat rollback
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }
};