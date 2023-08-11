<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form>
        <div class="add-input">
            <div class="row">

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="club_1" class="form-label">Club 1</label>
                        <select wire:model="club_1.0" id="club_1" class="form-select">
                            @foreach (App\Models\Club::all() as $club)
                                <option value="{{ $club->club_name }}">{{ $club->club_name }}</option>
                            @endforeach
                        </select>
                        @error('club_1.0')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="club_2" class="form-label">Club 1</label>
                        <select wire:model="club_2.0" id="club_2" class="form-select">
                            @foreach (App\Models\Club::all() as $club)
                                <option value="{{ $club->club_name }}">{{ $club->club_name }}</option>
                            @endforeach
                        </select>
                        @error('club_2.0')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="score_1" class="form-label">Score 1</label>
                        <input type="number" class="form-control" id="score_1" wire:model="score_1.0" required>
                        @error('score_1.0')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="score_2" class="form-label">Score 1</label>
                        <input type="number" class="form-control" id="score_2" wire:model="score_2.0" required>
                        @error('score_2.0')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2 mt-4">
                    <div class="form-group">
                        <button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{ $i }})"><i
                                class="bi bi-plus-square"></i></button>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($inputs as $key => $value)
            <div class="add-input mt-2">
                <div class="row">

                    <div class="col-md-3">
                        <div class="mb-3">
                            <select wire:model="club_1.{{ $value }}" id="club_1" class="form-select">
                                @foreach (App\Models\Club::all() as $club)
                                    <option value="{{ $club->club_name }}">{{ $club->club_name }}</option>
                                @endforeach
                            </select>
                            @error('club_1.' . $value)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <select wire:model="club_2.{{ $value }}" id="club_2" class="form-select">
                                @foreach (App\Models\Club::all() as $club)
                                    <option value="{{ $club->club_name }}">{{ $club->club_name }}</option>
                                @endforeach
                            </select>
                            @error('club_2.' . $value)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <input type="number" class="form-control" id="score_1"
                                wire:model="score_1.{{ $value }}" required>
                            @error('score_1.' . $value)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <input type="number" class="form-control" id="score_2"
                                wire:model="score_2.{{ $value }}" required>
                            @error('score_2.' . $value)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-2 mt-1">
                        <div class="form-group">
                            <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{ $key }})"><i
                                    class="bi bi-dash-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary">Simpan Semua</button>
                </div>
            </div>
        </div>

    </form>
</div>
