@extends('adminlte::page')
@section('title', 'Inicio')

@section('content_header')
    <h1>Bienvenido!</h1>
@stop

@section('content')
/////////////////////////////////
    @extends('layouts.app')

@section('content')
<h1>Dashboard</h1>
<button id="openModal" class="btn btn-primary">Abrir Modal</button>
@endsection

@extends('modales.SuperAdmin.usuario_modal')

@push('scripts')
<script>
$(document).ready(function(){
    $('#openModal').click(function(){
        $('#miModal').modal('show');
    });
});
</script>
@endpush

@stop

