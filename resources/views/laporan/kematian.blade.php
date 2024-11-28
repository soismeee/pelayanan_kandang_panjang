@extends('layout.app')
@section('container')
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Laporan kematian</h5>
            </div>
            <div class="card-body">
                <label>Pilih tanggal awal dan tanggal akhir, anda bisa melihat data terlebih dahulu kemudian mencetaknya</label>
                <form action="/cetakkematian" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <input type="date" class="form-control" id="tgl_awal" name="tgl_awal">
                        </div>
                        <div class="col-4">
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
                        </div>
                        <div class="col-4">
                            <a href="#" class="btn btn-sm btn-primary" id="lihat">Lihat data</a>
                            <button type="submit" class="btn btn-sm btn-success">Cetak</button>
                        </div>
                    </div>
                </form>
                <br />
                <label>Data kematian</label>
                <div id="data-kematian">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Jenis Kelamin</td>
                                <td>Tempat kematian</td>
                                <td>Tgl kematian</td>
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
    });

    function loading(){
        $('#data-kematian table tbody').append(`
            <tr>
                <td colspan="7" class="text-center" id="loading">Tidak ada data</td>
            </tr>
        `);
    }

    // Fungsi untuk memformat tanggal ke format Indonesia
    function formatTanggal(tanggal) {
        if (!tanggal) return "Belum tersedia"; // Jika tanggal null atau undefined
        let date = new Date(tanggal); // Konversi string tanggal ke objek Date
        let day = String(date.getDate()).padStart(2, '0'); // Hari dengan 2 digit
        let month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dengan 2 digit
        let year = date.getFullYear(); // Tahun
        return `${day}-${month}-${year}`; // Format dd-mm-yyyy
    }

    $(document).on('click', '#lihat', function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ url('lihatlaporankematian') }}",
            type: "POST",
            data: { 'tgl_awal' : $('#tgl_awal').val(), 'tgl_akhir' : $('#tgl_akhir').val(), '_token' : "{{ csrf_token() }}" },
            dataType: 'json',
            success: function(response){
                let data = response.data;
                $('#loading').hide();
                data.forEach((params, index) => {
                    let gender = "Laki-laki";
                    if (params.data_kematian[0].jenis_kelamin == "P") {
                        gender = "Perempuan";
                    }
                    $('#data-kematian table tbody').append(
                        '<tr>'+
                            '<td>'+(index+1)+'</td>'+
                            '<td>'+params.data_kematian[0].nama_alm+'</td>'+
                            '<td>'+gender+'</td>'+
                            '<td>'+params.data_kematian[0].tempat_kematian+'</td>'+
                            '<td>'+formatTanggal(params.data_kematian[0].tanggal_kematian)+'</td>'+
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