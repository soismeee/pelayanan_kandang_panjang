<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
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
    @stack('css')
</head>

<body>
    
    @include('layout.sidebar')
    
    <main class="dashboard-main">
        <div class="navbar-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <button type="button" class="sidebar-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                            <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                        </button>
                        <button type="button" class="sidebar-mobile-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        {{-- <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button> --}}
                        
                        <div class="dropdown">
                            <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown">
                                <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                            </button>
                            <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                                <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                    <div>
                                        <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifikasi</h6>
                                    </div>
                                    <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center jumlahNotifikasi">0</span>
                                </div>

                                <div class="max-h-400-px overflow-y-auto scroll-sm pe-4 notifikasi">
                                    
                                </div>

                            </div>
                        </div><!-- Notification dropdown end -->


                        <div class="dropdown">
                            <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
                                <img src="/assets/images/logo-fold.png" alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle">
                            </button>
                            <div class="dropdown-menu to-top dropdown-menu-sm">
                                <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                    <div>
                                        <h6 class="text-lg text-primary-light fw-semibold mb-2">{{ auth()->user()->name }}</h6>
                                        <span class="text-secondary-light fw-medium text-sm">{{ auth()->user()->role }}</span>
                                    </div>
                                </div>
                                <ul class="to-top-list">
                                    <li>
                                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="/profil">
                                            <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> Profil saya
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" href="/logout">
                                            <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon> Keluar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-main-body">
            @yield('container')
        </div>

        <footer class="d-footer">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <p class="mb-0">© {{ date('Y') }} Pelayanan Kelurahan Kandang Panjang.</p>
                </div>
                <div class="col-auto">
                    <p class="mb-0">Made by <span class="text-primary-600">KP</span></p>
                </div>
            </div>
        </footer>
    </main>
        
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
    @stack('js')
    @can('admin')
    <script>

        $(document).ready(function(e){
            $.ajax({
                url: "{{ url('getPenggunaBaru') }}",
                type: "GET",
                success: function(response){
                    let data = response.data;
                    data.forEach((params, index) => {
                        $('.notifikasi').append(`
                            <a href="/verifikasiPengguna/${params.id}" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                    <div>
                                        <h6 class="text-md fw-semibold mb-4">Pengguna baru - ${params.name}</h6>
                                        <p class="mb-0 text-sm text-secondary-light text-w-200-px"> ${params.email}</p>
                                    </div>
                                </div>
                                <span class="text-sm text-secondary-light flex-shrink-0">${formatTanggal(params.created_at)}</span>
                            </a>
                        `);
                    });
                },
                error: function(err){
                    alert(err.responseJSON.message);
                }
            });
        });
    </script> 
    @endcan

    <script>
        function formatTanggal(tanggal) {
            if (!tanggal) return "Belum tersedia"; // Jika tanggal null atau undefined
            let date = new Date(tanggal); // Konversi string tanggal ke objek Date
            let day = String(date.getDate()).padStart(2, '0'); // Hari dengan 2 digit
            let month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dengan 2 digit
            let year = date.getFullYear(); // Tahun
            return `${day}/${month}/${year}`; // Format dd-mm-yyyy
        }

        $(document).ready(function(e){
            $.ajax({
            url: "{{ url('getNotif') }}",
            type: "GET",
            success: function(response){
                $('.jumlahNotifikasi').text(response.jumlahNotifikasi)
                let data = response.data;
                data.forEach((params, index) => {
                    $('.notifikasi').append(`
                        <a href="/readNotif/${params.pengajuan_id}" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                            <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                
                                <div>
                                    <h6 class="text-md fw-semibold mb-4">${params.nama_pelapor}</h6>
                                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">data ${params.jenis_pengajuan} - ${params.status}</p>
                                </div>
                            </div>
                            <span class="text-sm text-secondary-light flex-shrink-0">${formatTanggal(params.tanggal_pengajuan)}</span>
                        </a>
                    `);
                });
            },
            error: function(err){
                alert(err.responseJSON.message);
            }
        });
        });
    </script>
</body>
        
</html>