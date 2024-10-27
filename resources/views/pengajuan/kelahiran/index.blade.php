@extends('layout.app')
@push('css')
        <!-- Data Table css -->
        <link rel="stylesheet" href="/assets/css/lib/dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css">
@endpush
@section('container')
<div class="card basic-data-table">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title mb-0">Data Pengguna</h5>
            <a href="/pengguna/create" class="btn btn-sm btn-primary">Tambah pengguna</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
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
        const table = $('#dataTable').DataTable({          
            "lengthMenu": [[5, 10, 25, 50, 100, -1],[5, 10, 25, 50, 100, 'All']],
            "pageLength": 10, 
            processing: true,
            serverSide: true,
            responseive: true,
            ajax: {
                url:"{{ url('jsonPengguna') }}",
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
                        return row.name
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        return row.email
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        let span = `<span class="badge bg-primary">Admin</span>`;
                        if (row.role == 'user'){
                            span = `<span class="badge bg-dark">Pengguna</span>`
                        }
                        return span;
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        let span2 = `<span class="badge bg-success">Aktif</span>`;
                        if (row.status == 'inactive'){
                            span2 = `<span class="badge bg-danger">Tidak aktif</span>`
                        }
                        return span2;
                    }
                },
                {
                    "targets": "_all",
                    "defaultContent": "-",
                    "render": function(data, type, row, meta){
                        let status = row.status;
                        let isActive = "active";
                        if (status == "active") {
                            isActive = "inactive"
                        }
                        return `
                            <a href="#" data-id="`+row.id+`" data-status="`+isActive+`" class="isActice w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                            </a>
                            <a href="/pengguna/`+row.id+`/edit" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a href="#" data-id="`+row.id+`" class="hapusdata w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
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
                        url: "/penggunaDel/"+id,
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

        $(document).on('click', '.isActice', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            let status = $(this).data('status');
            $.ajax({
                url: "/penggunaAct/"+id,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    'status' : status
                },
                success: function(response){
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Status pengguna berhasil diubah",
                        icon: "success"
                    });
                    table.ajax.reload();
                }
            });
        });
    </script>
@endpush