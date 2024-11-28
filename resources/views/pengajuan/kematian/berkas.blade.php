@extends('layout.app')
@section('container')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">

                    <label>Berkas Pengajuan</label>
                    <a class="btn btn-primary" href="/pengajuan_kematian">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                1. Berkas Kartu keluarga <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_kk'] }}" alt="berkas KK" width="50%"> <br />
                2. Berkas KTP <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_ktp'] }}" alt="berkas KTP" width="50%"> <br />
                3. Berkas AKTA <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_akta'] }}" alt="berkas Akta" width="50%"> <br />
            </div>
        </div>
    </div>
</div>
@endsection