@extends('layout.app')
@section('container')
<div class="row gy-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tambah pengguna</h5>
            </div>
            <div class="card-body">
                <form action="/pengguna" method="post">
                    @csrf
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Nama lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan nama pengguna">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Role pengguna</label>
                            <select name="role" id="role" class="form-select">
                                <option disabled selected>Pilih role pengguna</option>
                                <option value="admin">Admin</option>
                                <option value="user">Pengguna</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukan email">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Buat password">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-600">Simpan pengguna</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection