@extends('layouts.app')

@section('title', 'Daftar Klub')

@section('content')
    <h1>Daftar Klub</h1>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif


    <a href="/club/create" class="btn btn-primary">Tambah Klub</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Klub</th>
                <th scope="col">Kota</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($clubs->isNotEmpty())
                @foreach ($clubs as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->club_name }}</td>
                        <td>{{ $data->city }}</td>
                        <td>
                            <a href="/club/{{ $data->id }}/edit" class="btn btn-primary btn-sm"><i
                                    class="bi bi-pencil-square"></i></a>

                            <form action="/club/{{ $data->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah anda akan menghapus club ini?')"><i
                                        class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" class="text-center fs-3">Data tidak ditemukan!</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
