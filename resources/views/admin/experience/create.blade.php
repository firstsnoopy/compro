@extends('layouts2.app')
@section('content')
    <form action="{{ route('experience.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="profile_id">Profile Id</label>
            <select name="profile_id" id="profile_id" class="form-control">
                <option value="">Pilih Profile</option>
                @foreach ($profile as $item)
                <option value="{{$item->id}}">{{$item->nama_lengkap}}</option>

                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="mb-3">
            <label for="position">Position</label>
            <input type="text" name="position" id="position" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
        </div>
        {{-- <div class="mb-3">
            <label for="email">Description</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="facebook">Facebook</label>
            <input type="url" name="facebook" id="facebook" class="form-control" placeholder="https://example.com">
        </div>
        <div class="mb-3">
            <label for="twitter">Twitter</label>
            <input type="url" name="twitter" id="twitter" class="form-control" placeholder="https://example.com">
        </div>
        <div class="mb-3">
            <label for="instagram">Instagram</label>
            <input type="url" name="instagram" id="instagram" class="form-control" placeholder="https://example.com">
        </div>
        <div class="mb-3">
            <label for="linkedin">LinkedIn</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control" placeholder="https://example.com">
        </div>
        <div class="mb-3">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
        </div> --}}
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('experience') }}" class="btn btn-warning">Back</a>
        </div>
    </form>
@endsection
