@extends('layout.app')
@section('container')

<div class="row gy-4">
    @can('admin')
        
    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-start-3">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">

                        <div class="w-64-px h-64-px radius-16 bg-base-50 d-flex justify-content-center align-items-center me-20">
                            <span class="mb-0 w-40-px h-40-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center radius-8 h6 mb-0">
                                <iconify-icon icon="flowbite:users-group-solid" class="icon"></iconify-icon>
                            </span>
                        </div>

                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Pengguna</span>
                            <h6 class="fw-semibold my-1">{{ $data['pengguna'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->

    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-start-2">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">

                        <div class="w-64-px h-64-px radius-16 bg-base-50 d-flex justify-content-center align-items-center me-20">
                            <span class="mb-0 w-40-px h-40-px bg-purple flex-shrink-0 text-white d-flex justify-content-center align-items-center radius-8 h6 mb-0">
                                <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                            </span>
                        </div>

                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Total Pengajuan</span>
                            <h6 class="fw-semibold my-1">{{ $data['pengajuan'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->

    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-start-5">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">

                        <div class="w-64-px h-64-px radius-16 bg-base-50 d-flex justify-content-center align-items-center me-20">
                            <span class="mb-0 w-40-px h-40-px bg-red flex-shrink-0 text-white d-flex justify-content-center align-items-center radius-8 h6 mb-0">
                                <iconify-icon icon="fa6-solid:file-invoice-dollar" class="text-white text-2xl mb-0"></iconify-icon>
                            </span>
                        </div>

                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Total Kelahiran</span>
                            <h6 class="fw-semibold my-1">{{ $data['kelahiran'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->

    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-start-4">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">

                        <div class="w-64-px h-64-px radius-16 bg-base-50 d-flex justify-content-center align-items-center me-20">
                            <span class="mb-0 w-40-px h-40-px bg-success-main flex-shrink-0 text-white d-flex justify-content-center align-items-center radius-8 h6 mb-0">
                                <iconify-icon icon="streamline:bag-dollar-solid" class="icon"></iconify-icon>
                            </span>
                        </div>

                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Total Kematian</span>
                            <h6 class="fw-semibold my-1">{{ $data['kematian'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->
    @endcan

    @can('user')
        <div class="col-xl-6">
            <div class="card radius-12 overflow-hidden h-100 d-flex align-items-center flex-nowrap flex-row">
                <div class="d-flex flex-shrink-0 w-170-px h-100">
                    <img src="assets/images/pengajuan/kelahiran.png" class="h-100 w-100 object-fit-cover" alt="">
                </div>
                <div class="card-body p-16 flex-grow-1">
                    <h5 class="card-title text-lg text-primary-light mb-6">Pengajuan data kelahiran</h5>
                    <p class="card-text text-neutral-600 mb-16">Ajukan data kelahiran buah hati anda dengan mengisi formulir pengajuan seperti nama, jenis kelamin, tanggal lahir, tempat lahir, data diri dan KTP orang tua.</p>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card radius-12 overflow-hidden h-100 d-flex align-items-center flex-nowrap flex-row flex-row-reverse">
                <div class="d-flex flex-shrink-0 w-170-px h-100">
                    <img src="assets/images/pengajuan/kematian.png" class="h-100 w-100 object-fit-cover" alt="">
                </div>
                <div class="card-body p-16 flex-grow-1">
                    <h5 class="card-title text-lg text-primary-light mb-6">Pengajuan data kelahiran</h5>
                    <p class="card-text text-neutral-600 mb-16">Ajukan data kematian orang kesayangan anda dengan mengisi formulir pengajuan seperti nama, jenis kelamin, tanggal kematian, tempat kematian, data diri dan Berkas lain.</p>
                </div>
            </div>
        </div>
    @endcan

    <!-- Revenue Statistics Start -->
    <div class="col-xxl-12">
        <div class="card h-100 radius-8 border-0">
            <div class="card-body p-24">
                <label class="mb-3">Daftar pengajuan yang belum di proses</label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel-pengajuan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Pengajuan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengajuan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_pelapor }}</td>    
                                    <td>{{ $item->jenis_pengajuan }}</td>    
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_pengajuan)) }}</td>    
                                    <td>{{ $item->status }}</td>    
                                </tr>                                
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data pengajuan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Revenue Statistics End -->

</div>

@endsection