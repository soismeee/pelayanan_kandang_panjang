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
</head>

<body>

    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="/assets/images/auth/background.jpg" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="index.php" class="mb-40 max-w-290-px">
                        {{-- <img src="/assets/images/logo.png" alt=""> --}}
                        <strong>Pelayanan Kandang Panjang</strong>
                    </a>
                    <h4 class="mb-12">Registrasi akun anda</h4>
                    <p class="mb-32 text-secondary-light text-lg">Selamat datang, buat akunmu sendiri</p>
                </div>
                <form id="form-register">
                    @csrf
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" class="form-control h-56-px bg-neutral-50 radius-12" name="name" placeholder="Masukan nama">
                    </div>
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" class="form-control h-56-px bg-neutral-50 radius-12" name="email" placeholder="Masukan Email">
                    </div>
                    <div class="mb-20">
                        <div class="position-relative ">
                            <div class="icon-field">
                                <span class="icon top-50 translate-middle-y">
                                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                </span>
                                <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" name="password" id="password" placeholder="Password">
                            </div>
                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                        </div>
                        <span class="mt-12 text-sm text-secondary-light">Password minimal 5 karakter</span>
                    </div>

                    <button type="submit" id="tombol" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Registrasi</button>
                    <div class="mt-32 text-center text-sm">
                        <p class="mb-0">Sudah memiliki akun? <a href="/login" class="text-primary-600 fw-semibold">Masuk</a></p>
                    </div>

                </form>
            </div>
        </div>
    </section>

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

    <script>

        $(document).on('submit', '#form-register', function(e) {
            e.preventDefault();
            $('#tombol').prop('disabled', true);
            $('#tombol').html('Loading...')

            $.ajax({
                type: "POST",
                url: "{{ url('regist') }}",
                data: $('#form-register').serialize(),
                dataType: "json",
                success: function(response) {
                    window.location.href = '/login'
                },
                error: function(err) {
                    $('#tombol').prop('disabled', false);
                    $('#tombol').html('Registrasi');
                    let error = err.responseJSON;
                    $.each(error.errors, function(key, value) {
                        $('#' + key).addClass('is-invalid');
                    });
                }
            });
        });
    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================
    </script>

</body>

</html>