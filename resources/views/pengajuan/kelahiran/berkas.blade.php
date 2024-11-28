@extends('layout.app')
@section('container')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">

                    <label>Berkas Pengajuan</label>
                    <a class="btn btn-primary" href="/pengajuan_kelahiran">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                1. Berkas Kartu keluarga <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['berkas_kk'] }}" alt="berkas KK" width="50%"> <br />
                2. KTP ayah <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['ktp_ayah'] }}" alt="KTP ayah" width="50%"> <br />
                3. KTP ibu <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKelahiran[0]['ktp_ibu'] }}" alt="KTP ibu" width="50%"> <br />
            </div>
        </div>
    </div>
</div>
@endsection