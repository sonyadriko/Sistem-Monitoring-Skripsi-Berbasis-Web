@extends('layouts/template')

@section('title')
Edit Ruangan
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <h5 class="card-header">Edit Ruangan</h5>
        <div class="card-body">
            <form action="{{ route('ruangan.update', $ruangan->id_ruangan) }}" method="POST">
                @csrf {{-- Metode PUT untuk operasi update --}}
                <div class="mb-3">
                    <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                    <input
                        type="text"
                        class="form-control"
                        id="namaRuangan"
                        name="namaRuangan"
                        placeholder="Masukkan Nama Ruangan..."
                        aria-describedby="defaultFormControlHelp"
                        value="{{ $ruangan->nama_ruangan }}"
                    />
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
