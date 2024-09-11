@extends('layouts2.app')
@section('content')
    <form action="{{ route('profiles.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="picture">Photo</label>
            <input type="file" name="picture" id="picture" class="form-control">
            <img src="{{ asset('storage/image/' . $data->picture) }}" alt="" width="50" height="50">
        </div>
        <div class="mb-3">
            <label for="nama-lengkap">Nama</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                value="{{ $data->nama_lengkap }}">
        </div>
        <div class="mb-3">
            <label for="no_telpon">No Telp</label>
            <input type="number" name="no_telpon" id="no_telpon" class="form-control" value="{{ $data->no_telpon }}">
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}">
        </div>
        <div class="mb-3">
            <label for="desciption">Desciption</label>
            <textarea name="description" id="desciption" class="form-control" cols="30" rows="10">{{ $data->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="facebook">Facebook</label>
            <input type="url" name="facebook" id="facebook" class="form-control" placeholder="https://example.com"
                value="{{ $data->facebook }}">
        </div>
        <div class="mb-3">
            <label for="twitter">Twitter</label>
            <input type="url" name="twitter" id="twitter" class="form-control" placeholder="https://example.com"
                value="{{ $data->twitter }}">
        </div>
        <div class="mb-3">
            <label for="instagram">Instagram</label>
            <input type="url" name="instagram" id="instagram" class="form-control" placeholder="https://example.com"
                value="{{ $data->instagram }}">
        </div>
        <div class="mb-3">
            <label for="linkedin">LinkedIn</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control" placeholder="https://example.com"
                value="{{ $data->linkedin }}">
        </div>
        <div class="mb-3">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10">{{ $data->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('admin/profiles') }}">Back</a>
        </div>
    </form>
@endsection
