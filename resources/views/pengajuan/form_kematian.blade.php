@extends('layout.app')
@push('css')
<link rel="stylesheet" href="/assets/sweetalert2/sweetalert2.min.css">
    
@endpush
@section('container')
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulir pengajuan data kematian</h5>
                </div>
                <div class="card-body">
                    <form id="form-pengajuan">
                        @csrf
                        <div class="row">
                            <strong>Data Pelapor</strong>
                            <input type="hidden" name="jenis_pengajuan" id="jenis_pengajuan" value="kematian" class="form-control">
                            <div class="col-md-4 mb-2">
                                <label for="nama_pelapor">Nama Pelapor</label>
                                <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" value="{{ session('nama') }}" placeholder="Masukan nama pelapor">
                                <span id="span_nama_pelapor"></span>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="nik_pelapor">nik Pelapor</label>
                                <input type="text" class="form-control" name="nik_pelapor" id="nik_pelapor" maxlength="16" onkeypress="return nik('event')" placeholder="Masukan nik pelapor">
                                <span id="span_nik_pelapor"></span>    
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="tgl_lahir_pelapor">Tanggal Lahir Pelapor</label>
                                <input type="date" class="form-control" name="tgl_lahir_pelapor" id="tgl_lahir_pelapor">
                                <span id="span_tgl_lahir_pelapor"></span>        
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="no_hp">Telepon Pelapor</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" maxlength="16" value="{{ auth()->user()->pengguna->no_telepon }}" onkeypress="return nik('event')" placeholder="Masukan nomor telepon pelapor">
                                <span id="span_no_hp"></span>        
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="pekerjaan_pelapor">Pekerjaan Pelapor</label>
                                <input type="text" class="form-control" name="pekerjaan_pelapor" id="pekerjaan_pelapor" placeholder="Masukan pekerjaan pelapor">
                                <span id="span_pekerjaan_pelapor"></span>    
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="alamat_pelapor">Alamat Pelapor</label>
                                <textarea name="alamat_pelapor" id="alamat_pelapor" cols="5" rows="5" class="form-control">{{ session('alamat') }}</textarea>
                                <span id="span_alamat_pelapor"></span>    
                            </div>

                            <strong>Data Saksi 1</strong>
                            <div class="col-md-6 mb-2">
                                <label for="nama_saksi1">Nama saksi 1</label>
                                <input type="text" class="form-control" name="nama_saksi1" id="nama_saksi1" placeholder="Masukan nama saksi 1">
                                <span id="span_nama_saksi1"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nik_saksi1">nik saksi 1</label>
                                <input type="text" class="form-control" name="nik_saksi1" id="nik_saksi1" maxlength="16" onkeypress="return nik('event')" placeholder="Masukan nik saksi 1">
                                <span id="span_nik_saksi1"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tgl_lahir_saksi1">Tanggal Lahir saksi 1</label>
                                <input type="date" class="form-control" name="tgl_lahir_saksi1" id="tgl_lahir_saksi1">
                                <span id="span_nama_tgl_lahir_saksi1"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="pekerjaan_saksi1">Pekerjaan saksi 1</label>
                                <input type="text" class="form-control" name="pekerjaan_saksi1" id="pekerjaan_saksi1" placeholder="Masukan pekerjaan saksi 1">
                                <span id="span_pekerjaan_saksi1"></span>    
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="alamat_saksi1">Alamat saksi 1</label>
                                <textarea name="alamat_saksi1" id="alamat_saksi1" cols="5" rows="5" class="form-control"></textarea>
                                <span id="span_alamat_saksi1"></span>    
                            </div>

                            <strong>Data Saksi 2</strong>
                            <div class="col-md-6 mb-2">
                                <label for="nama_saksi2">Nama saksi 2</label>
                                <input type="text" class="form-control" name="nama_saksi2" id="nama_saksi2" placeholder="Masukan nama saksi 2">
                                <span id="span_nama_saksi2"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nik_saksi2">nik saksi 2</label>
                                <input type="text" class="form-control" name="nik_saksi2" id="nik_saksi2" maxlength="16" onkeypress="return nik('event')" placeholder="Masukan nik saksi 2">
                                <span id="span_nik_saksi2"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tgl_lahir_saksi2">Tanggal Lahir saksi 2</label>
                                <input type="date" class="form-control" name="tgl_lahir_saksi2" id="tgl_lahir_saksi2">
                                <span id="span_nama_tgl_lahir_saksi2"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="pekerjaan_saksi2">Pekerjaan saksi 2</label>
                                <input type="text" class="form-control" name="pekerjaan_saksi2" id="pekerjaan_saksi2" placeholder="Masukan pekerjaan saksi 2">
                                <span id="span_pekerjaan_saksi2"></span>    
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="alamat_saksi2">Alamat saksi 2</label>
                                <textarea name="alamat_saksi2" id="alamat_saksi2" cols="5" rows="5" class="form-control"></textarea>
                                <span id="span_alamat_saksi2"></span>    
                            </div>
                        </div>
                        

                        <div class="row" id="form">
                            <strong>Data Kematian</strong>
                            <div class="col-md-3 mb-2">
                                <label for="nama_alm">Nama</label>
                                <input type="text" class="form-control" name="nama_alm" id="nama_alm" placeholder="Masukan nama almarhum">
                                <span id="span_nama_alm"></span>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukan nik almarhum" maxlength="16" onkeypress="return nik('event')">
                                <span id="span_nik"></span>    
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    <option disabled selected>Pilih jenis kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <span id="span_jenis_kelamin"></span>    
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="tanggal_lahir">Tanggal lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                                <span id="span_tanggal_lahir"></span>    
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="tempat_lahir">Tempat lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukan tempat lahir">
                                <span id="span_tempat_lahir"></span>    
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="agama">Agama</label>
                                <input type="text" name="agama" id="agama" class="form-control" placeholder="Masukan agama">
                                <span id="span_agama"></span>    
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="pekerjaan">pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Masukan pekerjaan">
                                <span id="span_pekerjaan"></span>    
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="alamat">alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat">
                                <span id="span_alamat"></span>    
                            </div>


                            <div class="col-md-3 mb-2">
                                <label for="tanggal_kematian">Tanggal kematian</label>
                                <input type="date" class="form-control" name="tanggal_kematian" id="tanggal_kematian">
                                <span id="span_tanggal_kematian"></span>    
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="waktu_kematian">Waktu kematian</label>
                                <input type="time" class="form-control" name="waktu_kematian" id="waktu_kematian">
                                <span id="span_waktu_kematian"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tempat_kematian">Tempat kematian</label>
                                <input type="text" name="tempat_kematian" id="tempat_kematian" class="form-control" placeholder="Masukan tempat kematian">
                                <span id="span_tempat_kematian"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="sebab_kematian">Sebab kematian</label>
                                <input type="text" name="sebab_kematian" id="sebab_kematian" class="form-control" placeholder="Masukan sebab kematian">
                                <span id="span_sebab_kematian"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="yang_menerangkan">Yang Menerangkan</label>
                                <input type="text" name="yang_menerangkan" id="yang_menerangkan" class="form-control" placeholder="Masukan yang menerangkan">
                                <span id="span_yang_menerangkan"></span>    
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="nama_kepala_keluarga">Nama kepala Keluarga</label>
                                <input type="text" name="nama_kepala_keluarga" id="nama_kepala_keluarga" class="form-control" placeholder="Masukan nama kepala keluarga">
                                <span id="span_nama_kepala_keluarga"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nomor_keluarga">Nomor Kartu Keluarga</label>
                                <input type="text" name="nomor_keluarga" id="nomor_keluarga" class="form-control" maxlength="16" onkeypress="return nik('event')" placeholder="Masukan nomor kartu keluarga">
                                <span id="span_nomor_keluarga"></span>    
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" placeholder="Masukan nama ayah">
                                <span id="span_nama_ayah"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" placeholder="Masukan nama ibu">
                                <span id="span_nama_ibu"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nik_ayah">NIK Ayah</label>
                                <input type="text" name="nik_ayah" id="nik_ayah" class="form-control" maxlength="16" onkeypress="return nik('event')" placeholder="Masukan nik ayah">
                                <span id="span_nik_ayah"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nik_ibu">NIK Ibu</label>
                                <input type="text" name="nik_ibu" id="nik_ibu" class="form-control" maxlength="16" onkeypress="return nik('event')" placeholder="Masukan nik ibu">
                                <span id="span_nik_ibu"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tgl_lahir_ayah">Tgl lahir Ayah</label>
                                <input type="date" name="tgl_lahir_ayah" id="tgl_lahir_ayah" class="form-control">
                                <span id="span_tgl_lahir_ayah"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tgl_lahir_ibu">Tgl lahir Ibu</label>
                                <input type="date" name="tgl_lahir_ibu" id="tgl_lahir_ibu" class="form-control">
                                <span id="span_tgl_lahir_ibu"></span>    
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" placeholder="Masukan pekerjaan ayah">
                                <span id="span_pekerjaan_ayah"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control" placeholder="Masukan pekerjaan ibu">
                                <span id="span_pekerjaan_ibu"></span>    
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="alamat_ayah">Alamat Ayah</label>
                                <input type="text" name="alamat_ayah" id="alamat_ayah" class="form-control" placeholder="Masukan alamat ayah">
                                <span id="span_alamat_ayah"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="alamat_ibu">Alamat Ibu</label>
                                <input type="text" name="alamat_ibu" id="alamat_ibu" class="form-control" placeholder="Masukan alamat ibu">
                                <span id="span_alamat_ibu"></span>    
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="ktp_ayah">Berkas KTP Ayah</label>
                                <input type="file" name="ktp_ayah" id="ktp_ayah" class="form-control" placeholder="Masukan ktp ayah">
                                <span id="span_ktp_ayah"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="ktp_ibu">Berkas KTP Ibu</label>
                                <input type="file" name="ktp_ibu" id="ktp_ibu" class="form-control" placeholder="Masukan ktp ibu">
                                <span id="span_ktp_ibu"></span>    
                            </div>

                            <div class="col-md-4">
                                <label for="berkas_ktp">Berkas KTP</label>
                                <input type="file" name="berkas_ktp" id="berkas_ktp" class="form-control">
                                <span id="span_berkas_ktp"></span>    
                            </div>
                            <div class="col-md-4">
                                <label for="berkas_akta">Berkas Akta</label>
                                <input type="file" name="berkas_akta" id="berkas_akta" class="form-control">
                                <span id="span_berkas_akta"></span>    
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="berkas_kk">Berkas KK</label>
                                <input type="file" name="berkas_kk" id="berkas_kk" class="form-control">
                                <span id="span_berkas_kk"></span>    
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="surat_pengantar_rt">Surat Surat Pengantar RT</label>
                                <input type="file" name="surat_pengantar_rt" id="surat_pengantar_rt" class="form-control">
                                <span id="span_surat_pengantar_rt"></span>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="surat_ket_rs">Surat Keterangan RS</label>
                                <input type="file" name="surat_ket_rs" id="surat_ket_rs" class="form-control">
                                <span id="span_surat_ket_rs"></span>    
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="ktp_pelapor">KTP Pelapor</label>
                                <input type="file" name="ktp_pelapor" id="ktp_pelapor" class="form-control">
                                <span id="span_ktp_pelapor"></span>    
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="ktp_saksi1">KTP saksi 1</label>
                                <input type="file" name="ktp_saksi1" id="ktp_saksi1" class="form-control">
                                <span id="span_ktp_saksi1"></span>    
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="ktp_saksi2">KTP saksi 2</label>
                                <input type="file" name="ktp_saksi2" id="ktp_saksi2" class="form-control">
                                <span id="span_ktp_saksi2"></span>    
                            </div>
                            <div class="col-md-12">
                                <button type="submit" id="submit" class="btn btn-primary">Buat Pengajuan</button>
                                <a href="/home" class="btn btn-dark">Batal</a>    
                            </div>
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
                    window.location.href = "/home";
                },
                error: function(err) {
                    $('#submit').html("Buat Pengajuan");
                    Swal.fire({
                        icon: "warning",
                        title: "Maaf!",
                        text: err.responseJSON?.message || "Terjadi kesalahan",
                    });
                    let error = err.responseJSON;
                    $.each(error.errors, function(key, value){
                        $('#'+key).addClass('is-invalid');
                        $('#span_'+key).text(value);
                        $('#span_'+key).addClass('text-danger');
                    })
                }
            });
            });
    </script>
@endpush