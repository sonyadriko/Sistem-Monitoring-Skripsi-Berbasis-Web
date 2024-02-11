@extends('layout.master')

@section('title')
Tambah Mata Kuliah Pendukung
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-GLhlTQ8iN17EtM8Ckdo3hxJY98p+KBg0qD/I9z2QFmW6qq5CIK5BA/1EL86W39SK" crossorigin="anonymous">

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Manajemen</a></li>
      <li class="breadcrumb-item active" aria-current="page">Mata Kuliah Pendukung</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card mb-4">
            <h5 class="card-header">Mata Kuliah Pendukung</h5>
            <div class="card-body">
                <form action="{{route('mata-kuliah.store')}}" method="POST"enctype="multipart/form-data" id="mataKuliahForm">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="nama_mata_kuliah" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="nama_mata_kuliah" name="nama_mata_kuliah" placeholder="Masukan Mata Kuliah..." aria-describedby="defaultFormControlHelp" />
                        </div>
                        @error('nama_mata_kuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                            {{-- <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button> --}}
                            <button type="submit" class="btn btn-primary" onclick="$('#submitBtn').click();">Submit</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>

@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
    // Attach a click event to the submit button
    $('#submitBtn').click(function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Perform the AJAX request
        $.ajax({
            url: "{{ route('mata-kuliah.store') }}",
            method: "POST",
            data: $('#mataKuliahForm').serialize(),
            success: function (data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        // Redirect after success
                        window.location.href = "{{ route('bimbingan-mhs.index') }}";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while processing your request.'
                });
            }
        });
    });
});

</script>

