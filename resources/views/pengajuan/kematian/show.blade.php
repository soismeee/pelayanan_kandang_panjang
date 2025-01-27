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
                    </table>
                    <form action="/pengajuanProses/{{ $data->pengajuan_id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Status pengajuan</label>
                                    <select id="status" name="status" class="form-select">
                                        <option value="pengajuan" @if ($data->status == "pengajuan") selected @endif>Pengajuan</option>
                                        <option value="proses" @if ($data->status == "proses") selected @endif>Proses</option>
                                        <option value="selesai" @if ($data->status == "selesai") selected @endif>Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggal_pencairan">Tanggal selesai</label>
                                    <input type="date" class="form-control" name="updated_at" id="updated_at" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label>Berkas dokumen (dapat dikosongkan jika masih dalam proses)</label>
                                <input type="file" class="form-control" name="dokumen" id="dokumen">
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-success">Proses pengajuan</button>
                            </div>
                        </div>
                    </form>
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
                1. Berkas Kartu keluarga <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_kk'] }}" alt="berkas KK" width="50%"> <br />
                2. Berkas KTP <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_ktp'] }}" alt="berkas KTP" width="50%"> <br />
                3. Berkas AKTA <br />
                <img src="/Pengajuan/{{ $data->jenis_pengajuan }}/{{ $data->dataKematian[0]['berkas_akta'] }}" alt="berkas Akta" width="50%"> <br />
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