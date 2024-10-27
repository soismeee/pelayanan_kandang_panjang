@extends('layout.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css">
@endpush
@section('container')
    <div class="row gy-4">
        <div class="col-lg-4">
            <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                <img src="assets/images/user-grid/background.png" alt="" class="w-100 object-fit-cover">
                <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        <img src="assets/images/users/profil.png" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                        <h6 class="mb-0 mt-16">{{ auth()->user()->name }}</h6>
                        <span class="text-secondary-light mb-16">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="mt-24">
                        <h6 class="text-xl mb-16">Data Personal</h6>
                        <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Nama</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ auth()->user()->name }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Email</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ auth()->user()->email }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Role</span>
                                <span class="w-70 text-secondary-light fw-medium">: User</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Status</span>
                                <span class="w-70 text-secondary-light fw-medium">: Aktif</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                        <h6 class="text-md text-primary-light mb-16">Profile Image</h6>
                        <!-- Upload Image Start -->
                        <!-- Upload Image End -->
                        <form id="form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Nama lengkap <span class="text-danger-600">*</span></label>
                                        <input type="text" class="form-control radius-8" id="nama" placeholder="Nama pengguna" name="nama" value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                        <input type="email" class="form-control radius-8" id="email" name="email" value="{{ auth()->user()->email }}" readonly placeholder="Masukan email address">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="no_telepon" class="form-label fw-semibold text-primary-light text-sm mb-8">Telepon</label>
                                        <input type="text" class="form-control radius-8" id="no_telepon" name="no_telepon" placeholder="Masukan nomor telepon">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="alamat" class="form-label fw-semibold text-primary-light text-sm mb-8">Alamat</label>
                                        <textarea name="alamat" class="form-control radius-8" id="alamat" placeholder="Tuliskan alamat anda..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center gap-3">
                                {{-- <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                    Batal
                                </button> --}}
                                <button type="submit" id="tombol" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $("#form-data").on('submit', function(event) {
            event.preventDefault();
            $('#tombol').html('Loading...');
            $.ajax({
                url: "/storePelanggan",
                type: "POST",
                dataType: "JSON",
                data: $('#form-data').serialize(),
                success: function(response){
                    $('#tombol').html('Simpan');
                    Swal.fire({
                        icon: "success",
                        title: "Selamat!",
                        text: "Data dpa berhasil disimpan.",
                    });
                    window.location.reload();
                },
                error: function(err){
                    $('#tombol').html('Simpan');
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: err.responseText.message,
                    });
                }
            })
        })
    </script>
@endpush