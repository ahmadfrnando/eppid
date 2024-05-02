<?php
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Bukti Pengajuan Permohonan Informasi</title>
    <style>
        <style>* {
            font-family: Times New Roman;
        }

        .judul {
            letter-spacing: 1px;
        }

        .form {
            text-transform: capitalize;
        }

        .ttd {
            text-transform: capitalize;
            font-weight: bold;
        }

        hr:last-child {
            position: relative;
            bottom: 5px;
        }

        table {
            width: 625px;
        }

        table tr td {
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
        }

        img {
            padding: 15px;
        }

        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <table class="judul">
        <tr>
            <td width="110">
                <center>
                    <img src="{{ asset('logoppid.png') }}" alt="Logo Pengadilan Negeri Medan" width="90">
                </center>
            </td>
            <td width="30">
            </td>
            <td>
                <center>
                    <font size="4" class="fw-bold"> &nbsp;</font><br><br>
                    <font size="4" class="fw-bold">PENGADILAN NEGERI MEDAN</font><br>
                    <font size="4" class="fw-bold">KELAS IA KHUSUS</font><br>
                    <font size="3">Jalan Pengadillan No.8-10, Kota Medan-20111</font><br>
                    <font size="3">Telp/Fax: (061)4515847</font><br>
                    <font size="3">Website: www.pnmedankota.go.id</font><br>
                    <font size="3">Email: info@pnmedankota.go.id</font><br><br><br>
                </center>
            </td>
        </tr>
    </table><br>

    <table>
        <tr>
            <center>
                <font size="4" class="fw-bold">BUKTI PENGAJUAN PERMOHONAN INFORMASI</font><br><br>
            </center>
        </tr>
    </table>
    <table>
        <tr>
            <td width="180">
                <font size="3">Tanggal Pengajuan Permohonan</font>
            </td>
            <td>
                <font size="3">:
                    {{ \Carbon\Carbon::parse($created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}</font>
            </td>
        </tr>
        <tr>
            <td width="180">
                <font size="3">Tanggal Pemberitahuan Tertulis</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
        </tr>
        <tr>
            <td width="180">
                <font size="3">Nomor Pendaftaran</font>
            </td>
            <td>
                <font size="3">: {{ $noperminfo }}</font>
            </td>
        </tr>
    </table><br><br>

    <table class="form">
        <tr>
            <td width="150">
                <font size="3">Nama / Nama Perusahaan</font>
            </td>
            <td width="2">
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $nama }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Alamat</font>
            </td>
            <td width="2">
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $alamat }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Pekerjaan / Jenis Usaha</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $pekerjaan }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Informasi yang dimohon</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $informasidimohon }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Tujuan Penggunaan Informasi</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $tujuan }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Jenis Data Informasi</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $data }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Jenis Dokumen Informasi</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $jenis }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Cara memperoleh Informasi</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $caramemperoleh }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Cara mendapatkan informasi </font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $caramendapatkan }}</font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <font size="3">Upload Berkas</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3">{{ $jenisberkas }}</font>
            </td>
        </tr>
    </table><br><br><br><br>

    <table class="ttd">
        <tr>
            <td width="250">
                <center>
                    <font size="3">Petugas Informasi</font>
                </center>
            </td>
            <td>
                <center>
                    <font size="3">Pemohon Informasi</font>
                </center>
            </td>
        </tr>
        <tr>
            <td height="70" width="250">
            </td>
            <td>
                <center>
                    <img src="{{ asset("storage/". $signature) }}" width="40%">
                </center>
            </td>
        </tr>
        <tr>
            <td width="250">
                <center>
                    <font size="3">( Petugas PPID )</font>
                </center>
            </td>
            <td>
                <center>
                    <font size="3">( {{ $nama }} )</font>
                </center>
            </td>
        </tr>
    </table>
</body>

</html>
