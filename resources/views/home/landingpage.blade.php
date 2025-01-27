<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="/assets/images/favicon.png" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="/assets/css/remixicon.css">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="/assets/css/lib/bootstrap.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="/assets/css/style.css">

</head>
<body>
    <div class="card basic-data-table">
        <div class="card-header p-0 border-0">
            <div class="responsive-padding-40-150 bg-light-pink">
                <div class="row gy-4 align-items-center">
                    <div class="col-xl-7">
                        <h4 class="mb-20">Pelayanan Kelurahan Kandang Panjang</h4>
                        <p class="mb-0 text-secondary-light max-w-634-px text-xl">Permudah urusan administrasi anda terkait berkas kelahiran dan kematian menggunakan website ini, anda dapat menyajukan permohonan data kelahiran maupun kematian, masuk untuk menggunakan website ini.</p>
                        <a href="/login" class="btn btn-primary">Login</a>    
                        <a href="/register" class="btn btn-dark">Registrasi</a>    
                    </div>
                    <div class="col-xl-5 d-xl-block d-none">
                        <img src="assets/images/logo-fold.png" width="50%" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body bg-base responsive-padding-40-150">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="active-text-tab nav flex-column nav-pills bg-base shadow py-0 px-24 radius-12 border" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link text-secondary-light fw-semibold text-xl px-0 py-16 border-bottom active" id="v-pills-about-us-tab" data-bs-toggle="pill" data-bs-target="#v-pills-about-us" type="button" role="tab" aria-controls="v-pills-about-us" aria-selected="true">Tentang Kelurahan</button>
                        <button class="nav-link text-secondary-light fw-semibold text-xl px-0 py-16 border-bottom" id="v-pills-ux-ui-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ux-ui" type="button" role="tab" aria-controls="v-pills-ux-ui" aria-selected="false">Pelayanan</button>
                        <button class="nav-link text-secondary-light fw-semibold text-xl px-0 py-16 border-bottom" id="v-pills-development-tab" data-bs-toggle="pill" data-bs-target="#v-pills-development" type="button" role="tab" aria-controls="v-pills-development" aria-selected="false">Pengguna</button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-about-us" role="tabpanel" aria-labelledby="v-pills-about-us-tab" tabindex="0">
                            <div class="accordion" id="accordionExample">
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button text-primary-light text-xl" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Kelurahan Kandang Panjang
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Kandang Panjang merupakan salah satu kelurahan yang berada di kecamatan Pekalongan Utara, Kota Pekalongan, provinsi Jawa Tengah, Indonesia.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-ux-ui" role="tabpanel" aria-labelledby="v-pills-ux-ui-tab" tabindex="0">
                            <div class="accordion" id="accordionExampleTwo">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button text-primary-light text-xl" type="button" data-bs-toggle="collapse" data-bs-target="#c-1" aria-expanded="true" aria-controls="c-1">
                                            Pelayanan Kelurahan Kandang Panjang
                                        </button>
                                    </h2>
                                    <div id="c-1" class="accordion-collapse collapse show" data-bs-parent="#accordionExampleTwo">
                                        <div class="accordion-body">
                                            Pelayanan yang ada pada kelurahan kandang panjang meliputi administasi dan kependudukan
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button text-primary-light text-xl collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c-2" aria-expanded="false" aria-controls="c-2">
                                            Pengajuan Data Kelahiran
                                        </button>
                                    </h2>
                                    <div id="c-2" class="accordion-collapse collapse" data-bs-parent="#accordionExampleTwo">
                                        <div class="accordion-body">
                                            Anda dapat mengajukan permohonan data kelahiran pada website ini.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button text-primary-light text-xl collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c-3" aria-expanded="false" aria-controls="c-3">
                                            Pengajuan Data Kematian
                                        </button>
                                    </h2>
                                    <div id="c-3" class="accordion-collapse collapse" data-bs-parent="#accordionExampleTwo">
                                        <div class="accordion-body">
                                            Anda dapat mengajukan permohonan data kematian pada website ini.
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-development" role="tabpanel" aria-labelledby="v-pills-development-tab" tabindex="0">
                            <div class="accordion" id="accordionExampleThree">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button text-primary-light text-xl" type="button" data-bs-toggle="collapse" data-bs-target="#c-7" aria-expanded="true" aria-controls="c-7">
                                            Pengguna website ini
                                        </button>
                                    </h2>
                                    <div id="c-7" class="accordion-collapse collapse show" data-bs-parent="#accordionExampleThree">
                                        <div class="accordion-body">
                                            Setiap warga kandang panjang dapat membuat dan menggunakan website ini untuk pengajuan data kelahiran dan data kematian, anda dapat mengajukan beberapa data sekaligus tanpa harus membuat akun baru setiap kali ingin mengajukan permohonan data baru.
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery library js -->
    <script src="/assets/js/lib/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="/assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Iconify Font js -->
    <script src="/assets/js/lib/iconify-icon.min.js"></script>
    <!-- jQuery UI js -->
    <script src="/assets/js/lib/jquery-ui.min.js"></script>

    <!-- main js -->
    <script src="/assets/js/app.js"></script>
</body>
</html>