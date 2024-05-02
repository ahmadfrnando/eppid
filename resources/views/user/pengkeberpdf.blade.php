<?php
use Carbon\Carbon;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pengajuan Keberatan</title>
    <style>
        * {
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

        .kapital {
            text-transform: capitalize;
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

        table td {
            font-size: 13px;
            padding-left: 20px;
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
                <font size="4" class="fw-bold">PERNYATAAN KEBERATAN ATAS PELAYANAN INFORMASI</font><br><br>
            </center>
        </tr>
    </table>

    <table>
        <tr>
            <font size="3" class="fw-bold">A. Informasi Pengajuan Keberatan</font>
        </tr>
    </table>

    <table class="form">
        <tr>
            <td width="150">
                <font size="3">No. Registrasi Keberatan </font>
            </td>
            <td width="1px">
                <font size="3">:</font>
            </td>
            <td>
                <font size="3" class="kapital">{{ $nopengkeber }}</font>
        </tr>
        <tr>
            <td>
                <font size="3">No. Pendaftaran Permohonan</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3" class="kapital">
                    @if (is_string($noperminfo))
                        {{ $noperminfo }}
                    @endif
                </font>
            </td>
        </tr>
        <tr>
            <td>
                <font size="3">Tujuan Penggunaan Informasi</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3" class="kapital">{{ $tujuan }}</font>
            </td>
        </tr>
    </table><br>

    <table class="form">
        <tr>
            <td width="150">
                <font size="3" class="fw-bold">Identitas Pemohon</font>
            </td>
            <td width="1px">
                <font size="3"></font>
            </td>
        </tr>
        <tr>
            <td>
                <font size="3">Nama</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3" class="kapital">{{ $nama }}</font>
            </td>
        </tr>
        <tr>
            <td>
                <font size="3">Alamat</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3" class="kapital">{{ $alamat }}</font>
            </td>
        </tr>
        <tr>
            <td>
                <font size="3">Pekerjaan</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3" class="kapital">{{ $pekerjaan }}</font>
            </td>
        </tr>
        <tr>
            <td>
                <font size="3">No. Telp</font>
            </td>
            <td>
                <font size="3">:</font>
            </td>
            <td>
                <font size="3" class="kapital">{{ $notel }}</font>
            </td>
        </tr>
    </table><br>

    <table>
        <tr>
            <font size="3" class="fw-bold">B. Alasan Keberatan</font>
        </tr>
    </table>

    <table class="form">
        <tr>
            <td>
                <font size="3" class="kapital">{{ $alasan }}</font>
            </td>
        </tr>
    </table><br>

    <table>
        <tr>
            <font size="3" class="fw-bold">C. Kasus Posisi</font>
        </tr>
    </table>

    <table class="form">
        <tr>
            <td>
                <font size="3" class="kapital">{{ $kaspol }}</font>
            </td>
        </tr>
    </table><br>

    <table>
        <tr>
            <font size="3" class="fw-bold">D. Hari dan Tanggal Tanggapan atas Keberatan</font>
        </tr>
    </table>

    <table class="form">
        <tr>
            <td>
                <font size="3">
                    {{ \Carbon\Carbon::parse($created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}</font>
            </td>
        </tr>
    </table><br><br><br><br><br><br>


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
                    <img src="{{ asset($signature) }}" width="40%">
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
