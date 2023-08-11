@extends('layouts.app')

@section('title', 'Tambah Klub')

@section('content')
    <h1>Tambah Klub</h1>

    <form action="/club" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="club" class="form-label">Nama Klub</label>
                    <input type="text" class="form-control @error('club_name') is-invalid @enderror" id="club"
                        name="club_name" value="{{ old('club_name') }}" required autofocus>
                    @error('club_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="city" class="form-label">Kota Klub</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                        name="city" value="{{ old('city') }}" required>
                    @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection
