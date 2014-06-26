@extends('template.admin')

@section('page_name')
Пользователи
@stop

{{-- Web site Title --}}
@section('title')
Пользователи
@stop

{{-- Content --}}
@section('container')
<div class="row">
<ul class="nav nav-pills">
  <li class="active"><a href="{{ action('App\Controllers\Admin\UsersController@getCreate') }}">Добавить пользователя</a></li>
  <li><a href="#">Test</a></li>
  <li><a href="#">test</a></li>
</ul>
                      
                        @if($errors->any())
                        <div>
                        	<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                            </div>
                        </div>    
                        @endif

                        @if ($message = Session::get('success'))
                        <div>
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>Успех</h4>
                                {{ $message }}
                            </div>
                        </div>    
                        @endif

	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>Пользователь</th>
				<th>Статус</th>
				<th>Опции</th>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td><a href="">{{ $user->email }}</a></td>
						<td>@if ($user->activated=='1')
							<span class="label label-default">Active</span>
						 @else
						 	<span class="label label-default">Deactive</span>
						 @endif
						 </td>

						<td>
							<div class="btn-group">
							  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
							    Действие <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
							  		<li><a href="#">Сбросить пароль</a></li>
							  	<li class="divider"></li>
								@if ($user->status != 'Suspended')
									<li><a href="#">Деактивировать</a></li>
								@else
									<li><a href="#">Активировать</a></li>
								@endif
								@if ($user->status != 'Banned')
									<li><a href="#">Забанить</a></li>
								@else
									<li><a href="#">Снять бан</a></li>
								@endif
							  </ul>
							</div>


							<button class="btn btn-primary btn-xs" type="button" onClick="location.href='{{ action('App\Controllers\Admin\UsersController@getEdit', array($user->id)) }}'"><span class="glyphicon glyphicon-pencil"></span></button> 



							<a class="btn btn-danger confirModal btn-xs" data-token="{{ Session::getToken() }}" data-method="delete" data-href="{{ action('App\Controllers\Admin\UsersController@getDelete', array($user->id)) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


@stop