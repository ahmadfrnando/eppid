<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Permohonan Informasi</title>
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
            margin: 2cm 2cm 2cm 2cm;
        }
    </style>
</head>

<body>
    <table align="center" id="header">
        <tr>
            <td width="110">
                <center>
                    <img src="data:image/jpg;base64, {{ $data['imagePath'] }}" alt="Logo Pengadilan Negeri Medan" width="90">
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
    </table><br>
    <hr>

    <div class="mt-3">
        <h3 align="center" class="text-xl">Laporan Permohonan Informasi</h3>
        <h3 align="center" class="text-xl">{{ ucwords($data['selectedData']) }}</h3>
    </div>

    <div class="mt-3">
        <table class="w-full" id="content">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tujuan Informasi</th>
                    <th>Informasi Yang Dimohon</th>
                    <th>Jenis Data Informasi</th>
                    <th>Tanggal Permohonan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['perminfos'] as $no => $perminfo)
                    <tr>
                        <td class="text-center">{{ $no + 1 }}</td>
                        <td>{{ ucwords($perminfo->nama) }}</td>
                        <td>{{ ucwords($perminfo->tujuan) }}</td>
                        <td>{{ ucwords($perminfo->informasidimohon) }}</td>
                        <td>{{ $perminfo->data }}</td>
                        <td>{{ $perminfo->created_at->locale('id')->isoFormat('DD-MM-YYYY') }}</td>
                        <td>{{ $perminfo->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
