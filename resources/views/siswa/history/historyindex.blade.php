@extends('layout.halsiswa')
@section('content')
    <div class="row ml-3 mt-3">
        @if ($history)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $history->instansi->name }}</h5>
                    <div class="card-text">{{ $history->instansi->email }} | {{ $history->instansi->phone }}</div>
                    <div class="card-text">{{ $history->instansi->alamat }}</div>
                    @if ($history->status == 'approved')
                        <a href="{{ route('trainings.show', $history->id) }}"
                            class="btn mt-3 {{ $history->status == 'approved' ? 'btn-success' : ($history->status == 'pending' ? 'btn-warning' : 'btn-danger') }}">Logbook</a>
                    @else
                        <button class="btn btn-secondary mt-3" disabled>Logbook</button>
                    @endif
                </div>
                @if ($history->status == 'approved')
                    <div class="card-footer text-success">
                        <small class="text-success font-italic">Approved</small>
                    </div>
                @elseif ($history->status == 'pending')
                    <div class="card-footer text-warning">
                        <small class="text-warning
                            font-italic">Pending</small>
                    </div>
                @else
                    <div class="card-footer text-danger">
                        <small class="text-danger
                            font-italic">Rejected</small>
                    </div>
                @endif
            </div>
        @else
            <p class="ml-3">Belum ada instansi yang dipilih.</p>
        @endif
    </div>
@endsection
