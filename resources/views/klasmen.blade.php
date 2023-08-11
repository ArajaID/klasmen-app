@extends('layouts.app')

@section('title', 'Daftar Klasmen')

@section('content')
    <h1>Daftar Klasmen</h1>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Klub</th>
                <th scope="col">Main</th>
                <th scope="col">Menang</th>
                <th scope="col">Seri</th>
                <th scope="col">Kalah</th>
                <th scope="col">Goal Menang</th>
                <th scope="col">Goal Kalah</th>
                <th scope="col">Point</th>
            </tr>
        </thead>
        <tbody>
            @if ($standings->isNotEmpty())
                @foreach ($standings as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->club }}</td>
                        <td>{{ $data->Ma }}</td>
                        <td>{{ $data->Me }}</td>
                        <td>{{ $data->S }}</td>
                        <td>{{ $data->K }}</td>
                        <td>{{ $data->GM }}</td>
                        <td>{{ $data->GK }}</td>
                        <td>{{ $data->Point }}</td>
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
