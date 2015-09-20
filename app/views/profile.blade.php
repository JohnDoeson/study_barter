@extends('layout')
@section('title')
	Профиль
@stop
@section('content')
	<div class="container">
		@if ($errors->all())
	        <div class="alert alert-danger">
	            @foreach ($errors->all() as $error)
	            <p>{{ $error }}</p>
	            @endforeach
	        </div>
	    @endif
	    <h1>Профиль</h1>
	    
		
	</div>
@stop