@extends('layouts2.app')
@section('content')
    <form action="{{ route('experience.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        {{-- <div class="mb-3">
            <label for="picture">Photo</label>
            <input type="file" name="picture" id="picture" class="form-control">
            <img src="{{ asset('storage/image/' . $data->picture) }}" alt="" width="50" height="50">
        </div> --}}
        <div class="mb-3">
            <label for="nama-lengkap">Profile Id</label>
            <input type="text" name="profile_id" id="profile_id" class="form-control"
                value="{{ $data->profile_id }}">
        </div>
        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $data->title }}">
        </div>
        <div class="mb-3">
            <label for="position">Position</label>
            <input type="text" name="position" id="position" class="form-control" value="{{ $data->position }}">
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $data->description }}</textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('experience') }}" >Back</a>
        </div>
    </form>
@endsection
