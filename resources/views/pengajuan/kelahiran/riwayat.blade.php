@extends('layout.app')
@push('css')
        <!-- Data Table css -->
        <link rel="stylesheet" href="/assets/css/lib/dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css">
@endpush
@section('container')
<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Data Riwayat Kelahiran</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Data</th>
                        <th scope="col">Orang tua</th>
                        <th scope="col">Tgl Pengajuan</th>
                        <th scope="col">Tgl selesai</th>
                        <th scope="col">Berkas</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
    <!-- Data Table js -->
    <script src="/assets/js/lib/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js"></script>
    <script>

        function formatTanggal(tanggal) {
            if (!tanggal) return "Belum tersedia"; // Jika tanggal null atau undefined
            let date = new Date(tanggal); // Konversi string tanggal ke objek Date
            let day = String(date.getDate()).padStart(2, '0'); // Hari dengan 2 digit
            let month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dengan 2 digit
            let year = date.getFullYear(); // Tahun
            return `${day}-${month}-${year}`; // Format dd-mm-yyyy
        }

        const table = $('#dataTable').DataTable({          
            "lengthMenu": [[5, 10, 25, 50, 100, -1],[5, 10, 25, 50, 100, 'All']],
            "pageLength": 10, 
            processing: true,
            serverSide: true,
            responseive: true,
            ajax: {
                url:"{{ url('jsonRiwayatKelahiran') }}",
                type:"POST",
                data:function(d){
                    d._token = "{{ csrf_token() }}"
                }
            },
            columns:[
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return row.data_kelahiran[0].nama_bayi + "<br />" + row.data_kelahiran[0].tempat_lahir + ", " + formatTanggal(row.data_kelahiran[0].tanggal_lahir)
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        let ayah = row.data_kelahiran[0].nama_ayah == null ? "-" : row.data_kelahiran[0].nama_ayah;
                        return "Ayah : " + ayah + "<br /> Ibu : " + row.data_kelahiran[0].nama_ibu
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return formatTanggal(row.tanggal_pengajuan)
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return formatTanggal(row.updated_at)
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return `<a href="/berkaskelahiran/`+row.pengajuan_id+`" class="btn btn-sm btn-primary">Lihat</a>`
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return `<span class="badge bg-success">Selesai</span>`;
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return `
                            <a href="/Pengajuan/dokumen/`+row.dokumen+`" download="`+row.dokumen+`" data-id="`+row.pengajuan_id+`" class="download btn btn-sm btn-primary">
                                Download berkas
                            </a>
                        `
                    }
                },
            ]
        });
    </script>
@endpush