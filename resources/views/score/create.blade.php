@extends('layouts.app')

@section('title', 'Tambah Score')

@section('content')
    <h1>Tambah Score</h1>

    @if (session()->has('success'))
        <div class="alert alert-danger" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="/score" method="POST">
        @csrf
        <div class="row">

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="club_1" class="form-label">Club 1</label>
                    <select name="club_1" id="club_1" class="form-select">
                        @foreach (App\Models\Club::all() as $club)
                            <option value="{{ $club->club_name }}">{{ $club->club_name }}</option>
                        @endforeach
                    </select>
                    @error('club_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="club_2" class="form-label">Club 2</label>
                    <select name="club_2" id="club_2" class="form-select">
                        @foreach (App\Models\Club::all() as $club)
                            <option value="{{ $club->club_name }}">{{ $club->club_name }}</option>
                        @endforeach
                    </select>
                    @error('club_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="score_1" class="form-label">Score 1</label>
                    <input type="number" class="form-control @error('score_1') is-invalid @enderror" id="score_1"
                        name="score_1" value="{{ old('score_1') }}" required>
                    @error('score_1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="score_2" class="form-label">Score 2</label>
                    <input type="number" class="form-control @error('score_2') is-invalid @enderror" id="score_2"
                        name="score_2" value="{{ old('score_2') }}" required>
                    @error('score_2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <div class="row mt-3">
        <livewire:multiple-form />
    </div>
@endsection
