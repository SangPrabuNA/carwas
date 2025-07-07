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
        Schema::table('schedules', function (Blueprint $table) {
            // Hapus kolom 'nama' yang lama
            $table->dropColumn('nama');

            // Tambahkan foreign key
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->after('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->after('car_id')->constrained()->onDelete('cascade');

            // Tambahkan kolom status
            $table->string('status')->after('jam_keluar')->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            //
        });
    }
};
