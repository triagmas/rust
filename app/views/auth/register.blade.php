@extends('template.default')


@section('title')
    Регистрация
@stop

@section('container')

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Регистрация</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('url' => 'register')) }}
                        @if($errors->any())
                        	<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                            </div>
                        @endif
                            <fieldset>
                                <div class="form-group">
                                    {{ Form::label('fname', 'Имя')}}
                                    {{ Form::text('first_name', '', array('class' => 'form-control', 'placeholder' => 'Имя')) }}                                   
                                </div>
                                <div class="form-group">
                                    {{ Form::label('lname', 'Фамилия')}}
                                    {{ Form::text('last_name', '', array('class' => 'form-control', 'placeholder' => 'Фамилия')) }}                                   
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email', 'E-mail')}}
                                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'E-mail', 'autofocus' => 'autofocus')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password', 'Пароль')}}
                                    {{ Form::password('password', '', array('class' => 'form-control', 'placeholder' => 'Пароль', 'autofocus' => 'autofocus')) }} 
                                </div>
                                	{{ Form::submit('Зарегистрироваться', array('class' => 'btn btn-success')) }}
                                    {{ HTML::link('/', 'Отмена', array('class' => 'btn btn-danger'))}}
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

@stop