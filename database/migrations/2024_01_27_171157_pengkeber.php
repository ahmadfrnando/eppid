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
        Schema::create('pengkeber', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('noperminfo', 20)->nullable();
            $table->string('nopengkeber', 20)->nullable();
            $table->string('nama');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('tujuan');
            $table->string('notel');
            $table->enum('data', ['Data Perkara', 'Data Kepegawaian', 'Data Aset/keuangan', 'Data Umum/lainnya']);
            $table->enum('alasan', ['Permohonan informasi ditolak', 'Informasi berkala tidak disediakan','Permintaan tidak ditanggapin','Permintaan informasi ditanggapi tidak sebagaimana yang diminta', 'Permintaan informasi tidak dipenuhi', 'Biaya yang dikenakan tidak wajar', 'Informasi yang disampaikan melebihi jangka waktu yang ditentukan']);
            $table->string('kaspol');
            $table->enum('status', ['PROSES', 'DITERIMA', 'DITOLAK']);
            $table->string('signature');
            $table->string('buktipengajuan');
            $table->string('pesan')->nullable();
            $table->string('doc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengkeber');
    }
};