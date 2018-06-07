@extends('base.global')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Editar Perfil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ '/usuarios' }}">Usuários</a></li>
                    <li class="breadcrumb-item active">Editar perfil</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                @foreach($user as $users)  
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{ url('storage/users/' . $userid->id . '/' .$userid->image) }}"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $userid->name }}</h3>

                        <p class="text-muted text-center">{{ $userid->type }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>E-mail:</b> <a class="float-right">{{ $userid->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Criado:</b> <a class="float-right">{{ $userid->created_at }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Alterado:</b> <a class="float-right">{{ $userid->updated_at }}</a>
                            </li>
                        </ul>
                        @if ($userid->type !== 'admin' and Auth::User()->type == 'admin' ) 
                        <a href="{{ url('usuarios/delete', $userid->id) }}" class="btn btn-danger btn-block"><b>Deletar</b></a>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Informações</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" action="{{ url('/usuarios/store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Nome</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" placeholder="Nome" name="name" value="{{ $userid->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="user" class="col-sm-2 control-label" >Usuário</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="user" placeholder="usuário" name="user" disabled="" value="{{ $userid->user}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">E-mail</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ $userid->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Senha</label>

                                        <div class="col-sm-10">
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
                                        <label for="type" class="col-sm-6 control-label">Tipo</label>
                                        @if(Auth::User()->type == 'admin')
                                        <div class="col-sm-3">
                                            <select class="form-control select2" style="width: 100%;" name="type" id="type">
                                                @if($userid->type == 'admin')
                                                <option value="admin" selected="selected">Admin</option>
                                                <option value="user">Autor</option>
                                                @else
                                                <option value="admin">Admin</option>
                                                <option value="user" selected="selected">Autor</option>
                                                @endif
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                    <input type="hidden" name="id" id="id" value="{{ $userid->id }}">
                                    @break  
                                    @endforeach
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
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
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection