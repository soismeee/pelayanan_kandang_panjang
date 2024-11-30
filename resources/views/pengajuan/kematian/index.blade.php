@extends('layout.app')
@push('css')
        <!-- Data Table css -->
        <link rel="stylesheet" href="/assets/css/lib/dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css">
@endpush
@section('container')
<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Data Pengajuan Kematian</h5>
        <span>Catatan : Segera buat dokumen surat jika status pengajuan sudah di proses</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Data kematian</th>
                        <th scope="col">Tgl Pengajuan</th>
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
                url:"{{ url('jsonKematian') }}",
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
                        return row.data_kematian[0].nama_alm
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return "Tgl : " + formatTanggal(row.data_kematian[0].tanggal_kematian) + "<br /> Tempat meninggal : " + row.data_kematian[0].tempat_kematian

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
                        return `<a href="/berkaskematian/`+row.pengajuan_id+`" class="btn btn-sm btn-primary">Lihat</a>`
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        let span = `<span class="badge bg-primary">Pengajuan</span>`;
                        if (row.status == 'proses'){
                            span = `<span class="badge bg-warning">Proses</span>`
                        }
                        return span;
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return `
                            <a href="/pengajuan_kematian/`+row.pengajuan_id+`" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                            </a>
                            <a href="#" data-id="`+row.pengajuan_id+`" class="hapusdata w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                        `
                    }
                },
            ]
        });

        $(document).on('click', '.hapusdata', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: "",
                text: "Anda akan menghapus data ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yaa, hapus!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/pengajuanDel/"+id,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response){
                            Swal.fire({
                                title: "Terhapus!",
                                text: "Data berhasil di hapus",
                                icon: "success"
                            });
                            table.ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush