@extends('template.auth')

@section('title')
    Войти
@stop

@section('container')

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Введите логин и пароль</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('url' => 'login')) }}
                        @if($errors->any())
                        	<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>Ошибка</h4>
                                {{ $errors->first('login', ':message') }}
                            </div>
                        @endif

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>Успех</h4>
                                {{ $message }}
                            </div>
                        @endif

                            <fieldset>
                                <div class="form-group">
                                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'E-mail', 'autofocus' => 'autofocus')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::password('password', '', array('class' => 'form-control', 'placeholder' => 'Пароль', 'autofocus' => 'autofocus')) }} 
                                </div>
                                <div class="checkbox">
                                	{{ Form::label('remember', 'Помни меня') }}
                                    {{ Form::checkbox('remember-me', 'Помни меня')}}    
                                </div>
                                	{{ Form::submit('Войти', array('class' => 'btn btn-lg btn-success btn-block')) }}
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

@stop