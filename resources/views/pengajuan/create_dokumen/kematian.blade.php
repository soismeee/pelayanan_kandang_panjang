<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @page {
            size: 8.27in 13in; /* Ukuran kertas F4 */
            margin: 1in; /* Margin 1 inch */
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        #table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
        }
        #table th, #table td {
            border: 1px solid #3c3c3c;
            padding: 8px;
            text-align: left;
        }
        #table th {
            background-color: #f2f2f2;
        }
        .tengah {
            text-align: center;
        }
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .signature-box {
            width: 45%;
            text-align: center;
            line-height: 1.8;
        }
        .signature-box p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="tengah">
        <img src="/assets/images/kop_surat.png" width="100%" alt="Kop Surat">
    </div>
    <h4 class="tengah"><u>SURAT KETERANGAN KEMATIAN</u></h4>
    <h5 class="tengah">Nomor {{ $nomor }}</h5>
    <table id="table">
        <tr>
            <td style="width: 28%">Nama Kepala Keluarga</td>
            <td style="width: 2%">:</td>
            <td style="width: 70%">KK</td>
        </tr>
        <tr>
            <td>Nomor Kartu Keluarga</td>
            <td>:</td>
            <td>KK</td>
        </tr>
        <tr>
            <td colspan="3"><strong><u>JENAZAH</u></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['nik'] }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['nama_alm'] }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['jenis_kelamin'] == "L" ? "Laki-laki" : "Perempuan" }}</td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['tempat_lahir'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['tanggal_lahir'] }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['agama'] }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['pekerjaan'] }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['alamat'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Kematian</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['tanggal_kematian'] }}</td>
        </tr>
        <tr>
            <td>Sebab Kematian</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['sebab_kematian'] }}</td>
        </tr>
        <tr>
            <td>Tempat Kematian</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['tempat_kematian'] }}</td>
        </tr>
        <tr>
            <td>Yang Menerangkan</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['yang_menerangkan'] }}</td>
        </tr>

        <tr>
            <td colspan="3"><strong><u>IBU KANDUNG</u></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['nik_ibu'] }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['nama_ibu'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['tgl_lahir_ibu'] }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['pekerjaan_ibu'] }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['alamat_ibu'] }}</td>
        </tr>
        <tr>
            <td colspan="3"><strong><u>AYAH KANDUNG</u></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['nik_ayah'] }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['nama_ayah'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['tgl_lahir_ayah'] }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['pekerjaan_ayah'] }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->dataKematian[0]['alamat_ayah'] }}</td>
        </tr>
        <tr>
            <td colspan="3"><strong><u>PELAPOR</u></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $data->nik_pelapor }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $data->nama_pelapor }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $data->tgl_lahir_pelapor }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $data->pekerjaan_pelapor }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->alamat_pelapor }}</td>
        </tr>
        <tr>
            <td colspan="3"><strong><u>SAKSI I</u></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $data->nik_saksi1 }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $data->nama_saksi1 }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $data->tgl_lahir_saksi1 }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $data->pekerjaan_saksi1 }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->alamat_saksi1 }}</td>
        </tr>
        <tr>
            <td colspan="3"><strong><u>SAKSI II</u></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $data->nik_saksi2 }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $data->nama_saksi2 }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $data->tgl_lahir_saksi2 }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $data->pekerjaan_saksi2 }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->alamat_saksi2 }}</td>
        </tr>
    </table>
    <div class="signature-section">
        <div class="signature-box">
            <p>Pelapor</p>
            <br><br><br>
            <p><strong>{{ $data->nama_pelapor }}</strong></p>
        </div>
        <div class="signature-box">
            <p>Pekalongan, {{ date('d-m-Y') }}</p>
            <p>Mengetahui,</p>
            <p>a.n. Lurah Kandang Panjang</p>
            <p><strong>Kasi Pemerintahan dan Pembangunan</strong></p>
            <br><br><br>
            <p><strong>Nama Lurah</strong></p>
            <p>NIP. 123456789</p>
        </div>
    </div>
</body>
</html>
<script>
    print()
</script>