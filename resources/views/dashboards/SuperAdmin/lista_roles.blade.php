@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista de roles</h1>
        <button id="openModal" class="btn btn-success mt-2">Nuevo rol</button>
    </div>
@stop

@section('content')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre Rol</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody id="listaRoles"></tbody>
    </table>
    @include('modales.SuperAdmin.rol_modal')
@stop

@push('js')
    <script>
        const listRolUrl = "{{route('admin.listRolJson')}}";
        console.log('Jquery esta funcionando');
        $('#openModal').click(function() {
            console.log('clic');
            $('#miModal').modal('show');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/SuperAdmin/ajax-sa.js') }}"></script>
@endpush
