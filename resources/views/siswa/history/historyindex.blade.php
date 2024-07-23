@extends('layout.halsiswa')
@section('content')
    <div class="row ml-3 mt-3">
        @if ($history)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $history->instansi->name }}</h5>
                    <div class="card-text">{{ $history->instansi->email }} | {{ $history->instansi->phone }}</div>
                    <div class="card-text">{{ $history->instansi->alamat }}</div>
                    <a href="{{ route('trainings.show', $history->id) }}" class="btn btn-primary">Logbook</a>
                </div>
            </div>
        @else
            <p class="ml-3">Belum ada instansi yang dipilih.</p>
        @endif
    </div>
@endsection
