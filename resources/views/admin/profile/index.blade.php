@extends('layouts2.app')
@section('content')
    <div class="card">
        <div class="card-header">Profile</div>
        <div class="card-body">
            <a href="{{ route('profiles.create') }}" class="btn btn-primary btn-sm mb-2">ADD</a>
            <a href="{{ route('profiles.recycle') }}" class="btn btn-warning btn-sm mb-2">RECYCLE</a>
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
                                <td class="justify-content-center"><a href="{{ route('profiles.edit', $item->id) }}"
                                        class="btn btn-success btn-sm">Edit</a>
                                    <form style="display: inline;" action="{{ route('profiles.softdelete', $item->id) }}"
                                        onsubmit="return confirm ('Akan di delete sementara?')" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">SoftDelete</button>
                                    </form>
                                    <a href="{{ route('generate-pdf', $item->id) }}"
                                        class="btn btn-warning btn-sm">Print</a>
                                </td>
                                {{-- <td><span class="badge badge-success">Active</span></td> --}}
                                <td>
                                    <input type="radio" name="status" class="status-radio" data-id="{{ $item->id }}"
                                        {{ $item->status == 1 ? 'checked' : '' }}>
                                </td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_telpon }}</td>
                                <td><img width="100px" height="100px" src="{{ asset('storage/image/' . $item->picture) }}"
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
