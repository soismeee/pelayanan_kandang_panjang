@extends('layout.app')
@section('container')
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Laporan kelahiran</h5>
            </div>
            <div class="card-body">
                <label>Pilih tanggal awal dan tanggal akhir, anda bisa melihat data terlebih dahulu kemudian mencetaknya</label>
                <form action="/cetakkelahiran" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mt-3">
                            <input type="date" class="form-control" id="tgl_awal" name="tgl_awal">
                        </div>
                        <div class="col-lg-4 col-md-12 mt-3">
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
                        </div>
                        <div class="col-lg-4 col-md-12 mt-3">
                            <a href="#" class="btn btn-sm btn-primary" id="lihat">Lihat data</a>
                            <button type="submit" class="btn btn-sm btn-success">Cetak</button>
                        </div>
                    </div>
                </form>
                <br />
                <label>Data kelahiran</label>
                <div id="data-kelahiran" class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Tempat Lahir</td>
                                <td>Tgl Lahir</td>
                                <td>Jenis Kelamin</td>
                                <td>Ayah</td>
                                <td>Ibu</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function(){
        loading();
        $('#loading').hide();
        $('#empty').show();
    });

    function formatTanggal(tanggal) {
        if (!tanggal) return "Belum tersedia"; // Jika tanggal null atau undefined
        let date = new Date(tanggal); // Konversi string tanggal ke objek Date
        let day = String(date.getDate()).padStart(2, '0'); // Hari dengan 2 digit
        let month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dengan 2 digit
        let year = date.getFullYear(); // Tahun
        return `${day}-${month}-${year}`; // Format dd-mm-yyyy
    }

    function loading(){
        $('#data-kelahiran table tbody').append(`
            <tr>
                <td colspan="8" class="text-center" id="loading">Loading...</td>
            </tr>
            <tr>
                <td colspan="8" class="text-center" style="display: none" id="empty">Tidak ada data</td>
            </tr>
        `);
    }

    $(document).on('click', '#lihat', function(e){
        e.preventDefault();
        $('#data-kelahiran table tbody').empty(); // Menghapus isi tabel
        loading(); // Membuat loading
        $.ajax({
            url: "{{ url('lihatlaporankelahiran') }}",
            type: "POST",
            data: { 'tgl_awal' : $('#tgl_awal').val(), 'tgl_akhir' : $('#tgl_akhir').val(), '_token' : "{{ csrf_token() }}" },
            dataType: 'json',
            success: function(response){
                $('#loading').hide();
                let data = response.data;
                data.forEach((params, index) => {
                    let gender = "Laki-laki";
                    if (params.data_kelahiran[0].jenis_kelamin == "P") {
                        gender = "Perempuan";
                    }
                    $('#data-kelahiran table tbody').append(
                        '<tr>'+
                            '<td>'+(index+1)+'</td>'+
                            '<td>'+params.data_kelahiran[0].nama_bayi+'</td>'+
                            '<td>'+params.data_kelahiran[0].tempat_lahir+'</td>'+
                            '<td>'+formatTanggal(params.data_kelahiran[0].tanggal_lahir)+'</td>'+
                            '<td>'+gender+'</td>'+
                            '<td>'+params.data_kelahiran[0].nama_ayah+'</td>'+
                            '<td>'+params.data_kelahiran[0].nama_ibu+'</td>'+
                            '<td>'+params.status+'</td>'+
                        '</tr>'
                    );
                })
            },
            error:function(error){

            }
        });
    });

</script>
@endpush