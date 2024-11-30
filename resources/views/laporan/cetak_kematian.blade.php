<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <style type="text/css">
        body{
        font-family: sans-serif;
        }
        #table{
        margin: 20px auto;
        border-collapse: collapse;
        }
        #table th,
        #table td{
        border: 1px solid #3c3c3c;
        padding: 3px 8px;
        }
        .tengah{
            text-align: center;
        }
        .kooradmin{
            text-align: center;
            /* text-decoration: underline; */
            font-weight: bold
        }
    </style>
    <h4 class="tengah">LAPORAN DATA KEMATIAN</h4>
    <h5 class="tengah">Pertanggal {{ $tanggal }}</h5>
    <table id="table">
        <tr class="text-center">
            <td>No</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
            <td>Tempat kematian</td>
            <td>Tgl kematian</td>
            <td>Status Pengajuan</td>
        </tr>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->dataKematian[0]->nama_alm }}</td>
                    <td>{{ $item->dataKematian[0]->jenis_kelamin == "L" ? "Laki - laki" : "Perempuan" }}</td>
                    <td>{{ $item->dataKematian[0]->tempat_kematian }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->dataKematian[0]->tanggal_kematian)) }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<script>
    print()
</script>