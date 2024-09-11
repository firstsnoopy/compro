@extends('layouts2.app')
@section('content')
    <div class="card">
        <div class="card-header">Experience</div>
        <div class="card-body">
            <a href="{{ route('experience.create') }}" class="btn btn-primary btn-sm mb-2">ADD</a>
            <a href="{{ route('experience.recycle') }}" class="btn btn-warning btn-sm mb-2">RECYCLE</a>
            <div class="table table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Profile Id</th>
                            <th>Title</th>
                            <th>Position</th>
                            <th>Description</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($experience as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="justify-content-center"><a href="{{ route('experience.edit', $item->id) }}"
                                        class="btn btn-success btn-sm">Edit</a>
                                    <form style="display: inline;" action="{{ route('experience.softdelete', $item->id) }}"
                                        onsubmit="return confirm ('Akan di delete sementara?')" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">SoftDelete</button>
                                    </form>
                                </td>
                                {{-- <td><span class="badge badge-success">Active</span></td> --}}
                                <td>{{ $item->profile_id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
@endsection

@section('script-sweetalert')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const statusRadios = document.querySelectorAll('.status-radio');
            statusRadios.forEach(radio => {
                radio.addEventListener('click', (event) => {
                    const itemId = event.target.getAttribute('data-id');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    fetch(`/admin/profiles/update-status/${itemId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Berhasil',
                                    'Status Berhasil Diperbaharui',
                                    'success'
                                );
                                statusRadios.forEach(r => {
                                    if (r.getAttribute('data-id') != itemId) {
                                        r.checked = false;
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Gagal',
                                    data.error ||
                                    'Terjadi Kesalahan saat memperbarui status',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Gagal',
                                'Terjadi Kesalahan saat memperbarui status',
                                'error'
                            );
                        });
                });
            });
        });
    </script>
@endsection
{{-- <style>
        .pre {
            font-family: 'Times new roman', Times, Serif
        }
    </style>

    <pre>
Engkau selalu ada untukku
Menemaniku dalam suka dan duka
Menemani hari-hari ceriaku,

Bunda,
Engkau selalu membimbingku
Mengajariku untuk berakhlak mulia
Dalam keseharianku

Bunda,
Engkau bagai malaikat bagiku
Engkau juga sahabat bagiku
Ketulusan yang ada dalam dirimu
Membuat aku bangga pada dirimu

Bunda,
Aku selalu menyayangimu
Jasamu tak akan pernah bisa terbalas olehku
Namun aku akan berusaha menjadi anak kebanggaanmu

</pre> --}}
