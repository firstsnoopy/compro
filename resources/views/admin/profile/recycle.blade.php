@extends ('layouts2.app')
@section('content')
    <div class="card">
        <div class="card-header">Profile</div>
        <div class="card-body">
            {{-- <a href="{{ route('profiles.create') }}" class="btn btn-primary btn-sm mb-2">ADD</a> --}}
            <a href="{{ url('admin/profiles') }}" class="btn btn-secondary btn-sm mb-2">Back</a>
            <div class="table table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Actions</th>
                            <th>Status</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telpon</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="justify-content-center">
                                    <a href="{{route('profiles.restore', $item->id)}}" class="btn btn-success btn-sm">Restore</a>
                                    <form style="display: inline;" action="{{ route('profiles.destroy', $item->id) }}"
                                        onsubmit="return confirm ('Akan di delete sementara?')" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                {{-- <td><span class="badge badge-success">Active</span></td> --}}
                                <td>
                                    <input type="radio" name="status" class="status-radio">
                                    {{-- data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }} --}}
                                </td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_telpon }}</td>
                                <td><img width="100px" height="100px"
                                    {{-- src="{{ asset('storage/image/' . $item->picture) }}" --}}
                                        alt=""></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
@endsection
