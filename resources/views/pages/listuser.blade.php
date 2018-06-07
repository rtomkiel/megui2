@extends('base.global')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuários</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/usuarios') }}">Usuários</a></li>
                    <li class="breadcrumb-item active">Todos</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<!-- Success alert -->
<div class="modal" tabindex="-1" role="dialog" id="success">
    <div class="modal-dialog" role="document">
        <div class="modal-content alert-success">
            <div class="modal-header">
                <h5><i class="icon fa fa-check"></i> Alerta!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-content alert-success">
                <p class="text-center text-bold">Usuário removido com sucesso!</p>
            </div>
        </div>   
    </div>
</div>
<!-- Success alert -->


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <div class="card">
                       <a href="{{ url('/usuarios/novo') }}" class="btn btn-success btn-block"><b>Criar novo</b></a>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($users as $users)
            <div class="col-md-4">

                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header @if ($users->type == 'admin') bg-primary @else bg-warning @endif">
                        <div class="widget-user-image ">
                            <img class="img-circle elevation-2" src="{{ url('storage/users/' . $users->id . '/' .$users->image) }}" alt="Imagem de {{ $users->name }}">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{ $users->name }}</h3>
                        <h5 class="widget-user-desc">{{ $users->type }}</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="mailto:{{ $users->email }}" class="nav-link">
                                    {{ $users->email }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    Criado em:  <span class="float-right">{{ $users->created_at }}</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link">
                                    Alterado em:  <span class="float-right">{{ $users->updated_at }}</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('usuarios', $users->id) }}/perfil" class="nav-link float-left bg-warning">
                                    Editar
                                </a>
                                @if ($users->type == 'user')
                                <a href="{{ url('usuarios/delete', $users->id) }}" class="nav-link float-right bg-danger">
                                    Excluir
                                </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection

@section('customjs')
@if (session('success'))
{{ session('success')}}
<script>
$(function() {
    $('#success').modal('show');
});
</script>
@endif
@endsection