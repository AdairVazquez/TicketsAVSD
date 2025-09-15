@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista de usuarios</h1>
        <button id="openModal" class="btn btn-success mt-2">Nuevo usuario</button>
    </div>

@stop

@section('content')
    <nav>
        <ul class="pagination" id="paginacion"></ul>
    </nav>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody id="listaUsu"></tbody>
    </table>

    @include('modales.SuperAdmin.usuario_modal') {{-- modal ya presente en DOM --}}
@stop

@push('js')
    <script>
        const obtUser = "{{ route('admin.listUsuOne', ':id') }}";
        const storeUserUrl = "{{ route('superadmin.usuarios.store') }}";
        const editUserUrl = "{{ route('superadmin.usuarios.edit', ['id' => ':id']) }}";
        const deleteUserUrl = "{{ route('superadmin.usuarios.delete', ['id' => ':id']) }}"

        const listUserUrl = "{{ route('superadmin.usuarios.list') }}";
        console.log('Jquery esta funcionando');
        $('#openModal').click(function() {
            console.log('clic');
            $('#miModal').modal('show');
        });
        $(document).on('click', '.editUsu', function() {
            let id = $(this).data('id');
            console.log('Editar usuario con ID:', id);

            obtenerUsu(id); // ahora sí recibe el id
            $('#actUs').modal('show');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/SuperAdmin/ajax-sa.js') }}"></script>
@endpush
