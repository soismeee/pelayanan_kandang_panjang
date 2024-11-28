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
    <h4 class="tengah">LAPORAN DATA KELAHIRAN</h4>
    <h5 class="tengah">Pertanggal {{ $tanggal }}</h5>
    <table id="table">
        <tr class="text-center">
            <td>No</td>
            <td>Nama</td>
            <td>Tempat Lahir</td>
            <td>Tgl Lahir</td>
            <td>Jenis Kelamin</td>
            <td>Ayah</td>
            <td>Ibu</td>
        </tr>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->dataKelahiran[0]->nama_bayi }}</td>
                    <td>{{ $item->dataKelahiran[0]->tempat_lahir }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->dataKelahiran[0]->tanggal_lahir)) }}</td>
                    <td>{{ $item->dataKelahiran[0]->jenis_kelamin == "L" ? "Laki - laki" : "Perempuan" }}</td>
                    <td>{{ $item->dataKelahiran[0]->nama_ayah }}</td>
                    <td>{{ $item->dataKelahiran[0]->nama_ibu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<script>
    print()
</script>