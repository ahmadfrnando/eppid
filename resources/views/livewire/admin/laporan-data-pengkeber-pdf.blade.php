<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Pengajuan Keberatan</title>
    <style>
        #header {
            letter-spacing: 1px;
            border-collapse: collapse;
            border: none;
        }

        #content {
            border-collapse: collapse;
        }

        #content,
        #content th,
        #content td {
            border: 1px solid black;
        }

        #content th,
        #content td {
            padding: 5px;
        }

        body {
            margin: 0.5cm 2cm 2cm 2cm;
        }
    </style>
</head>

<body>
    <table align="center" id="header">
        <tr>
            <td width="110">
                <center>
                    <img src="data:image/jpg;base64, {{ $data['imagePath'] }}" alt="Logo Pengadilan Negeri Medan"
                        width="90">
                </center>
            </td>
            <td width="30">
            </td>
            <td>
                <center>
                    <font size="5"> &nbsp;</font><br><br>
                    <font size="5" style="font-weight: bold;">PENGADILAN NEGERI MEDAN KELAS IA KHUSUS</font><br>
                    <font size="4">Jalan Pengadillan No.8-10, Kota Medan-20111</font><br>
                    <font size="4">Telp/Fax: (061)4515847</font><br>
                    <font size="4">Website: www.pnmedankota.go.id</font><br>
                    <font size="4">Email: info@pnmedankota.go.id</font><br><br><br>
                </center>
            </td>
        </tr>
    </table>
    <hr>
    <br>
    <div class="mt-3">
        <center>
            <h2>Laporan Pengajuan Keberatan</h2>
            <h2>{{ ucwords($data['selectedData']) }}</h2>
            <h2>
                @if ($data['selectedDateStart'] != null)
                    {{ \Carbon\Carbon::parse($data['selectedDateStart'])->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                @endif
                @if($data['selectedDateEnd'] != null)
                    to
                    {{ \Carbon\Carbon::parse($data['selectedDateEnd'])->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                @endif
            </h2>
        </center>
        <table class="w-full" id="content">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Pendaftaran Permohonan</th>
                    <th>Nama pemohon</th>
                    <th>Jenis Data</th>
                    <th>alasan pemohon</th>
                    <th>waktu pengajuan</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['pengkebers'] as $no => $pengkeber)
                    <tr>
                        <td class="text-center">{{ $no + 1 }}</td>
                        <td>{{ ucwords($pengkeber->noperminfo) }}</td>
                        <td>{{ ucwords($pengkeber->nama) }}</td>
                        <td>{{ ucwords($pengkeber->data) }}</td>
                        <td>{{ $pengkeber->alasan }}</td>
                        <td class="whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($pengkeber->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                        </td>
                        <td>{{ $pengkeber->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
