@extends('template.default')

@section('container')

	<h2>Админка</h2>
	{{ HTML::link('logout', 'Выйти', array('class' => 'btn btn-warning')) }}

@stop