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
        Schema::create('perminfo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('noperminfo', 20)->nullable();
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('informasidimohon');
            $table->string('tujuan');
            $table->enum('data', ['Data Perkara', 'Data Kepegawaian', 'Data Aset/keuangan', 'Data Umum/lainnya']);
            $table->enum('jenis', ['Softcopy', 'Hardcopy']);
            $table->enum('caramemperoleh', ['Melihat', 'Membaca', 'Mendengarkan']);
            $table->enum('caramendapatkan', ['Mengambil Langsung', 'Mengirim Via Email']);
            $table->enum('jenisberkas', ['KTP atau SKP', 'Akta Badan Hukum', 'Surat Kuasa dan KTP', 'KITAS dan Paspor', 'Akta Badan Hukum PMA']);
            $table->string('berkas');
            $table->enum('status', ['PROSES', 'DITERIMA', 'DITOLAK']);
            $table->string('signature');
            $table->string('buktipengajuan');
            $table->text('pesan')->nullable();
            $table->string('doc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perminfo');
    }
};