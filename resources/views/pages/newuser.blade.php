@extends('base.global')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Criar usuário</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ '/usuarios' }}">Usuários</a></li>
                    <li class="breadcrumb-item active">Novo perfil</li>
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
                <p class="text-center text-bold">Usuário criado com sucesso!</p>
            </div>
        </div>   
    </div>
</div>
<!-- Success alert -->

<!-- Error alert -->
<div class="modal" tabindex="-1" role="dialog" id="error">
    <div class="modal-dialog" role="document">
        <div class="modal-content alert-danger alert-dismissable">
            <div class="modal-header">
                <h5><i class="icon fa fa-ban"></i> Alerta!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-content alert-danger alert-dismissable">
                <p class="text-center text-bold">Ocorreu um erro inesperado!</p>
            </div>
            
        </div>   
    </div>
</div>
<!-- Error alert -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-sm-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Informações</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" action="{{ url('/usuarios/novo/store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Nome</label>

                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name" placeholder="Nome" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Usuário</label>

                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name" placeholder="usuário" name="user">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">E-mail</label>

                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Senha</label>

                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" id="password"  name="password" placeholder="Senha">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        
                                        <label class="col-sm-6 control-label" for="image">Imagem de perfil</label>
                                        <div class="input-group col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" id="image" name="image">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Tipo</label>

                                        <div class="col-sm-2">
                                            <select class="form-control select2" style="width: 100%;" name="type" id="type">
                                                @if (Auth::User()->type == 'admin')
                                                <option value="admin" selected="selected">Admin</option>
                                                <option value="autor">User</option>
                                                @else
                                                <option value="admin">Admin</option>
                                                <option value="autor" selected="selected">Autor</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-12">
                                            <a href="{{ url('/usuarios')}}"><button type="button" class="btn btn-secondary">Cancelar</button></a>
                                            <button type="submit" class="btn btn-danger float-right">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4"></div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection

@section('customjs')
@if (session('success'))
{{ session('success')}}
<script>
$(function() {
    $('#success').modal('show');
});
</script>
@elseif (session('error'))
{{ session('error')}}
<script>
$(function() {
    $('#error').modal('show');
});
</script>
@else

@endif
@endsection