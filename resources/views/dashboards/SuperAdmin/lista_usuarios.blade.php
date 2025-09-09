@extends('adminlte::page')
@section('title', 'Inicio')


@section('content_header')
    <div class="d-flex justify-content-between align-items-center mt-3 ml-3 mr-3">
        <h1>Lista de usuarios</h1>
        <button id="openModal" class="btn btn-success mr-2">Nuevo usuario</button>
    </div>
@stop
@section('content')
    @extends('layouts.app')

@section('content')
    <main class="mt-5 ml-5 mr-5">
        <table class="table table-hover">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </main>

@endsection

@extends('modales.SuperAdmin.usuario_modal')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const storeUserUrl = "{{ route('superadmin.usuarios.store') }}";
        const listUserUrl = "{{ route('superadmin.usuarios.list') }}";
    </script>
    <script src="{{ asset('js/SuperAdmin/ajax-sa.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#openModal').click(function() {
                $('#miModal').modal('show');
            });
        });
    </script>
@endpush

@stop
