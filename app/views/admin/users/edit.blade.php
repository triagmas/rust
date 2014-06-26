@extends('template.admin')

@section('page_name')
	Редактирование пользователя
@stop

@section('container')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Редактирование пользователя {{ $user->first_name }} {{ $user->last_name }}</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('action' => array('App\Controllers\Admin\UsersController@postEdit', $user->id))) }}
                            <fieldset>
                               	<div class="form-group">
                                    {{ Form::label('status_lb', 'Статус')}}
                                    <span class="form-control">
                                    	@if($user->activated) 
                                    	<span class="label label-success">Active</span>
										@else 
										<span class="label label-default">Not active</span>
                                    	@endif	
                                    </span>               
                                </div>
   								<div class="form-group">
                                    {{ Form::label('created_at_lb', 'Создан')}}
                                    {{ Form::text('created_at', $user->created_at, array('class' => 'form-control', 'disabled' => 'disabled')) }}               
                                </div>
                                <div class="form-group">
                                    {{ Form::label('updated_at_lb', 'Обновлен')}}
                                    {{ Form::text('updated_at', $user->updated_at, array('class' => 'form-control', 'disabled' => 'disabled')) }}               
                                </div>
                                <div class="form-group">
                                    {{ Form::label('last_login_lb', 'Обновлен')}}
                                    {{ Form::text('last_login', $user->last_login, array('class' => 'form-control', 'disabled' => 'disabled')) }}               
                                </div>
                                <div class="form-group">
                                    {{ Form::label('fname', 'Имя')}}
                                    {{ Form::text('first_name', $user->first_name, array('class' => 'form-control', 'placeholder' => 'Имя')) }}                                   
                                </div>
                                <div class="form-group">
                                    {{ Form::label('lname', 'Фамилия')}}
                                    {{ Form::text('last_name', $user->last_name, array('class' => 'form-control', 'placeholder' => 'Фамилия')) }}                                   
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email', 'E-mail')}}
                                    {{ Form::text('email', $user->email, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
                                </div>
                                	{{ Form::submit('Создать', array('class' => 'btn btn-success')) }}
                                    {{ HTML::link('/', 'Отмена', array('class' => 'btn btn-danger'))}}
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

@stop
