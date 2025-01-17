@extends('layout.app')
@push('css')
<link rel="stylesheet" href="/assets/sweetalert2/sweetalert2.min.css">
    
@endpush
@section('container')
    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulir pengajuan data</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <button id="kelahiran" class="btn btn-lg btn-success" data-jenis_pengajuan="kelahiran">Pengajuan Data Kelahiran</button>
                        <button id="kematian" class="btn btn-lg btn-dark" data-jenis_pengajuan="kematian">Pengajuan Data Kematian</button>
                    </div>
                    <hr />
                    <form id="form-pengajuan">
                        @csrf
                        <div class="row">
                            <strong>Data Pelapor</strong>
                            <input type="hidden" name="jenis_pengajuan" id="jenis_pengajuan" class="form-control">
                            <div class="col-md-6 mb-3">
                                <label for="nama_pelapor">Nama Pelapor</label>
                                <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" value="{{ session('nama') }}" placeholder="Masukan nama pelapor">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nik_pelapor">nik Pelapor</label>
                                <input type="text" class="form-control" name="nik_pelapor" id="nik_pelapor" maxlength="16" onkeypress="return nik('event')" placeholder="Masukan nik pelapor">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="alamat_pelapor">Alamat Pelapor</label>
                                <textarea name="alamat_pelapor" id="alamat_pelapor" cols="5" rows="5" class="form-control">{{ session('alamat') }}</textarea>
                            </div>
                        </div>
                        <div class="row" id="form">
                            <p class="text-center">Pilih pengajuan, formulir akan tampil sesuai dengan pilihan</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="/assets/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        function nik(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        
        $(document).on('keyup', '#nik', function(e){
            let input = $(this).val();
            let sanitizedInput = input.replace(/[^0-9]/g, '');
            // Jika input berubah, perbarui nilai di input field
            if (input !== sanitizedInput) {
                $('#nik').val(sanitizedInput);
            }
        })

        $(document).on('click', '#kelahiran', function(e){
            $('#jenis_pengajuan').val($(this).data('jenis_pengajuan'));
            $('#form').html(
                `
                <div class="col-md-6 mb-3">
                    <label for="nama_bayi">Nama bayi</label>
                    <input type="text" class="form-control" name="nama_bayi" id="nama_bayi" placeholder="Masukan nama bayi">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option disabled selected>Pilih jenis kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal lahir  bayi">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tempat_lahir">Tempat lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukan tempat lahir bayi">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama_ayah">Nama Ayah</label>
                    <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" placeholder="Masukan nama ayah">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama_ibu">Nama Ibu</label>
                    <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" placeholder="Masukan nama ibu">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nik_ayah">NIK Ayah</label>
                    <input type="text" name="nik_ayah" id="nik_ayah" class="form-control" onkeypress="return nik('event')" placeholder="Masukan nik ayah">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nik_ibu">NIK Ibu</label>
                    <input type="text" name="nik_ibu" id="nik_ibu" class="form-control" onkeypress="return nik('event')" placeholder="Masukan nik ibu">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ktp_ayah">Berkas KTP Ayah</label>
                    <input type="file" name="ktp_ayah" id="ktp_ayah" class="form-control" maxlength="16" placeholder="Masukan ktp ayah">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ktp_ibu">Berkas KTP Ibu</label>
                    <input type="file" name="ktp_ibu" id="ktp_ibu" class="form-control" maxlength="16" placeholder="Masukan ktp ibu">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="akta_nikah">Akta Nikah</label>
                    <input type="file" name="akta_nikah" id="akta_nikah" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="berkas_kk">Berkas Kartu keluarga</label>
                    <input type="file" name="berkas_kk" id="berkas_kk" class="form-control">
                </div>
                <div class="col-md-12">
                    <button type="submit" id="submit" class="btn btn-primary">Buat Pengajuan</button>
                    <a href="/home" class="btn btn-dark">Batal</a>    
                </div>
                `
            );
        });

        $(document).on('click', '#kematian', function(e){
            $('#jenis_pengajuan').val($(this).data('jenis_pengajuan'));
            $('#form').html(
                `
                <div class="col-md-6 mb-3">
                    <label for="nama_alm">Nama</label>
                    <input type="text" class="form-control" name="nama_alm" id="nama_alm" placeholder="Masukan nama almarhum">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukan nik almarhum" maxlength="16">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                        <option disabled selected>Pilih jenis kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tanggal_kematian">Tanggal kematian</label>
                    <input type="date" class="form-control" name="tanggal_kematian" id="tanggal_kematian" placeholder="Tanggal kematian">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tempat_kematian">Tempat kematian</label>
                    <input type="text" name="tempat_kematian" id="tempat_kematian" class="form-control" placeholder="Masukan tempat kematian">
                </div>
                <div class="col-md-4">
                    <label for="berkas_ktp">Berkas KTP</label>
                    <input type="file" name="berkas_ktp" id="berkas_ktp" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="berkas_akta">Berkas Akta</label>
                    <input type="file" name="berkas_akta" id="berkas_akta" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="berkas_kk">Berkas KK</label>
                    <input type="file" name="berkas_kk" id="berkas_kk" class="form-control">
                </div>
                <div class="col-md-12">
                    <button type="submit" id="submit" class="btn btn-primary">Buat Pengajuan</button>
                    <a href="/home" class="btn btn-dark">Batal</a>    
                </div>
                `
            );
        });

        $(document).on('click', '#submit', function(e) {
            e.preventDefault();
            $('#submit').html('Loading...');
        
            // Create FormData properly from the native DOM element
            let formData = new FormData($('#form-pengajuan').get(0));
        
            $.ajax({
                type: "POST",
                url: "{{ url('storePengajuan') }}",
                data: formData,
                dataType: 'JSON',
                contentType: false, // Required to send multipart/form-data
                cache: false,
                processData: false, // Prevent jQuery from processing the data
                success: function(response) {
                $('#submit').html("Buat Pengajuan");
                Swal.fire({
                    icon: "success",
                    title: "Pengajuan Terkirim",
                    text: response.message,
                });
                window.location.href = "/";
                },
                error: function(err) {
                $('#submit').html("Buat Pengajuan");
                Swal.fire({
                    icon: "warning",
                    title: "Maaf!",
                    text: err.responseJSON?.message || "Terjadi kesalahan",
                });
                }
            });
            });
    </script>
@endpush