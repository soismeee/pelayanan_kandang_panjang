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
                            <td>{{ $data->jenis_pengajuan }}</td>
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
                                <td>@if ($data->dataKelahiran[0]['jenis_kelamin'] == "L")
                                    Laki-laki
                                @else
                                    Perempuan
                                @endif</td>
                            </tr>
                            <tr>
                                <td>Tanggal lahir</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y', strtotime($data->dataKelahiran[0]['tanggal_lahir'])) }}</td>
                            </tr>
                            <tr>
                                <td>Tempat lahir</td>
                                <td>:</td>
                                <td>{{ $data->dataKelahiran[0]['tempat_lahir'] }}</td>
                            </tr>
                            <tr>
                                <td>Orang tua</td>
                                <td>:</td>
                                <td>
                                    Ayah : {{ $data->dataKelahiran[0]['nama_ayah'] }} ({{ $data->dataKelahiran[0]['nik_ayah'] }})<br />
                                    Ibu : {{ $data->dataKelahiran[0]['nama_ibu'] }} ({{ $data->dataKelahiran[0]['nik_ibu'] }})
                                </td>
                            </tr>
                        @else
                        <tr>
                            <td>Nama almarhum</td>
                            <td>:</td>
                            <td>{{ $data->dataKematian[0]['nama_alm'] }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>@if ($data->dataKematian[0]['jenis_kelamin'] == "L")
                                Laki-laki
                            @else
                                Perempuan
                            @endif</td>
                        </tr>
                        <tr>
                            <td>Tanggal kematian</td>
                            <td>:</td>
                            <td>{{ date('d-m-Y', strtotime($data->dataKematian[0]['tanggal_kematian'])) }}</td>
                        </tr>
                        <tr>
                            <td>Tempat kematian</td>
                            <td>:</td>
                            <td>{{ $data->dataKematian[0]['tempat_kematian'] }}</td>
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
                    <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['ktp_ayah'] }}" alt="KTP ayah" width="50%"> <br />
                    3. KTP ibu <br />
                    <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['ktp_ibu'] }}" alt="KTP ibu" width="50%"> <br />
                @else
                1. Berkas Kartu keluarga <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_kk'] }}" alt="berkas KK" width="50%"> <br />
                2. Berkas KTP <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_ktp'] }}" alt="berkas KTP" width="50%"> <br />
                3. Berkas AKTA <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_akta'] }}" alt="berkas Akta" width="50%"> <br />
                @endif
            </div>
        </div>
    </div>
</div>
@endsection