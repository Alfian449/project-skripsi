@extends('layout.halsiswa')
@section('content')
    <div class="row ml-3 mt-3">
        @foreach ($history as $his)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $his->instansi->name }}</h5>
                    <div class="card-text">{{ $his->instansi->email }} | {{ $his->instansi->phone }}</div>
                    <div class="card-text">{{ $his->instansi->alamat }}</div>
                    <a href="{{ route('trainings.show', $his->id) }}" class="btn btn-primary">Logbook</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
