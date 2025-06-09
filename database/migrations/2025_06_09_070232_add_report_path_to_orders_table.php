<?php

// database/migrations/YYYY_MM_DD_HHMMSS_add_report_path_to_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('report_path')->nullable()->after('deskripsi_masalah'); // Atau lokasi lain
        });
    }
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('report_path');
        });
    }
};