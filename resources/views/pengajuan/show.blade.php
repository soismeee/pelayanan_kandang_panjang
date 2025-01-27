@extends('layout.app')
@section('container')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Formulir pengajuan data</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="3">DATA PENGAJUAN</td>
                        </tr>
                        <tr>
                            <td width="20%">Pengajuan</td>
                            <td width="5%">:</td>
                            <td width="75%">{{ $data->pengajuan_id }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Pengajuan</td>
                            <td>:</td>
                            <td> <strong> {{ $data->jenis_pengajuan == "kelahiran" ? "Kelahiran" : "Kematian" }} </strong></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>:</td>
                            <td>{{ date('d-m-Y', strtotime($data->tanggal_pengajuan)) }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{ $data->status }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">DATA PELAPOR</td>
                        </tr>
                        <tr>
                            <td>Pelapor</td>
                            <td>:</td>
                            <td>{{ $data->nama_pelapor }} ({{ $data->nik_pelapor }})
                                <br />
                                Tgl Lahir : {{ date('d/m/Y', strtotime($data->tgl_lahir_pelapor)) }}<br />
                            </td>

                        </tr>
                        <tr>
                            <td>Pekerjaan </td>
                            <td>:</td>
                            <td>{{ $data->pekerjaan_pelapor }}</td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td>:</td>
                            <td>{{ $data->alamat_pelapor }}</td>
                        </tr>

                        <tr>
                            <td>No. Telp </td>
                            <td>:</td>
                            <td>{{ $data->no_hp }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">DATA SAKSI 1</td>
                        </tr>
                        <tr>
                            <td>Saksi 1</td>
                            <td>:</td>
                            <td>{{ $data->nama_saksi1 }} ({{ $data->nik_saksi1 }})
                                <br />
                                Tgl Lahir : {{ date('d/m/Y', strtotime($data->tgl_lahir_saksi1)) }}<br />
                            </td>

                        </tr>
                        <tr>
                            <td>Pekerjaan </td>
                            <td>:</td>
                            <td>{{ $data->pekerjaan_saksi1 }}</td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td>:</td>
                            <td>{{ $data->alamat_saksi1 }}</td>
                        </tr>

                        <tr>
                            <td colspan="3">DATA SAKSI 2</td>
                        </tr>
                        <tr>
                            <td>Saksi 2</td>
                            <td>:</td>
                            <td>{{ $data->nama_saksi2 }} ({{ $data->nik_saksi2 }})
                                <br />
                                Tgl Lahir : {{ date('d/m/Y', strtotime($data->tgl_lahir_saksi2)) }}<br />
                            </td>

                        </tr>
                        <tr>
                            <td>Pekerjaan </td>
                            <td>:</td>
                            <td>{{ $data->pekerjaan_saksi2 }}</td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td>:</td>
                            <td>{{ $data->alamat_saksi2 }}</td>
                        </tr>
                        
                        <tr>
                            <td colspan="3">DATA LENGKAP</td>
                        </tr>
                        @if ($data->jenis_pengajuan == "kelahiran")
                            <tr>
                                <td>Nama bayi</td>
                                <td>:</td>
                                <td>{{ $data->dataKelahiran[0]['nama_bayi'] }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $data->dataKelahiran[0]['jenis_kelamin'] == "L" ? "Laki-laki" : "Perempuan" }}</td>
                            </tr>
                            <tr>
                                <td>Tempat, tgl lahir</td>
                                <td>:</td>
                                <td>{{ $data->dataKelahiran[0]['tempat_lahir'] }}, {{ date('d-m-Y', strtotime($data->dataKelahiran[0]['tanggal_lahir'])) }}
                                    <br> {{ $data->dataKelahiran[0]['waktu_lahir'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>Data kelahiran</td>
                                <td>:</td>
                                <td>
                                    tempat : {{ $data->dataKelahiran[0]['tempat_dilahirkan'] }}
                                    <br>
                                    Jenis Kelahiran : {{ $data->dataKelahiran[0]['jenis_kelahiran'] }}
                                    <br>
                                    Kelahiran : {{ $data->dataKelahiran[0]['kelahiran_ke'] }}
                                    <br>
                                    Penolong : {{ $data->dataKelahiran[0]['penolong_kelahiran'] }}
                                    <br>
                                    Berat : {{ $data->dataKelahiran[0]['berat_bayi'] }}, Panjang : {{ $data->dataKelahiran[0]['panjang_bayi'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>Orang tua</td>
                                <td>:</td>
                                <td>
                                    @if ($data->dataKelahiran[0]['ktp_ayah'] !== null)
                                        
                                    Ayah : {{ $data->dataKelahiran[0]['nama_ayah'] }} ({{ $data->dataKelahiran[0]['nik_ayah'] }})<br />
                                    @else
                                    Ayah : - <br />
                                    @endif
                                    Ibu : {{ $data->dataKelahiran[0]['nama_ibu'] }} ({{ $data->dataKelahiran[0]['nik_ibu'] }})
                                </td>
                            </tr>
                        @else
                        <tr>
                            <td>Nama almarhum</td>
                            <td>:</td>
                            <td>{{ $data->dataKematian[0]['nama_alm'] }} ({{ $data->dataKematian[0]['nik'] }})</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $data->dataKematian[0]['jenis_kelamin'] == "L" ? "Laki-laki" : "Perempuan" }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, tgl lahir</td>
                            <td>:</td>
                            <td>{{ $data->dataKematian[0]['tempat_lahir'] }}, {{ date('d-m-Y', strtotime($data->dataKematian[0]['tanggal_lahir'])) }}</td>
                        </tr>
                        <tr>
                            <td>Data Almarhum</td>
                            <td>:</td>
                            <td>
                                Agama : {{ $data->dataKematian[0]['agama'] }} <br />
                                Pekerjaan : {{ $data->dataKematian[0]['pekerjaan'] }} <br />
                                Alamat : {{ $data->dataKematian[0]['alamat'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat, tgl kematian</td>
                            <td>:</td>
                            <td>{{ $data->dataKematian[0]['tempat_kematian'] }}, {{ date('d-m-Y', strtotime($data->dataKematian[0]['tanggal_kematian'])) }}</td>
                        </tr>
                        <tr>
                            <td>Data Kematian</td>
                            <td>:</td>
                            <td>
                                Sebab kematian : {{ $data->dataKematian[0]['sebab_kematian'] }} <br />
                                Yang menerangkan : {{ $data->dataKematian[0]['yang_menerangkan'] }}
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <label>Berkas Pengajuan</label>
            </div>
            <div class="card-body">
                @if ($data->jenis_pengajuan == "kelahiran")
                    {{-- {{ $data->dataKelahiran[0]['berkas_kk'] }} --}}
                    1. Berkas Kartu keluarga <br />
                    <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['berkas_kk'] }}" alt="berkas KK" width="50%"> <br />
                    2. KTP ayah <br />
                    @if ($data->dataKelahiran[0]['ktp_ayah'] !== null)
                        <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['ktp_ayah'] }}" alt="KTP ayah" width="50%"> <br />                    
                    @else
                        tidak ada <br />
                    @endif
                    3. KTP ibu <br />
                    <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['ktp_ibu'] }}" alt="KTP ibu" width="50%"> <br />
                    4. Akta nikah <br />
                    <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['akta_nikah'] }}" alt="akta nikah" width="50%"> <br />
                @else
                1. Berkas Kartu keluarga <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_kk'] }}" alt="berkas KK" width="50%"> <br />
                2. Berkas KTP <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_ktp'] }}" alt="berkas KTP" width="50%"> <br />
                3. Berkas AKTA <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_akta'] }}" alt="berkas Akta" width="50%"> <br />
                @endif
                <ul>
                    <li>
                        KTP Pelapor <br />
                        <img src="/Pengajuan/pelayanan/{{ $data->ktp_pelapor }}" alt="KTP Pelapor" width="50%"> <br />
                    </li>   
                    <li>
                        KTP saksi 1<br />
                        <img src="/Pengajuan/pelayanan/{{ $data->ktp_saksi1 }}" alt="KTP saksi 1" width="50%"> <br />
                    </li>   
                    <li>
                        KTP saksi 2<br />
                        <img src="/Pengajuan/pelayanan/{{ $data->ktp_saksi2 }}" alt="KTP saksi 2" width="50%"> <br />
                    </li>   
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection