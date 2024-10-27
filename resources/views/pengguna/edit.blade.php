@extends('layout.app')
@section('container')
<div class="row gy-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit pengguna</h5>
            </div>
            <div class="card-body">
                <form action="/pengguna/{{ $user->id }}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Nama lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Masukan nama pengguna">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Role pengguna</label>
                            <select name="role" id="role" class="form-select">
                                <option disabled>Pilih role pengguna</option>
                                <option value="admin" {{ $user->role == "admin" ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == "user" ? 'selected' : '' }}>Pengguna</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Masukan email">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ganti password">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-600">Update pengguna</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection