@extends('template.admin')

@section('title')
    Администрирование
@stop

@section('page_name')
    Рабочий стол
@stop

@section('container')

	<h2>Админка</h2>
	{{ HTML::link('logout', 'Выйти', array('class' => 'btn btn-warning')) }}

@stop