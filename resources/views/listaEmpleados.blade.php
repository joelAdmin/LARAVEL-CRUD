@extends('layout.base')
@section('content')
    <div class="container-fluid" id="container-wrapper">
      @include('datatable.empleados')
      {{-- esto es una funcion personalisada o macro --}}
      {!! Html::modal('modal', 'fa fa-edit', 'Editar Empleado', null, 100) !!}
      {!! Html::modal('modalNew', 'fa fa-plus', 'Nuevo Empleado', null, 100) !!}
    </div>
@endsection