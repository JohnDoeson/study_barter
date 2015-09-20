@extends('layout')
@section('title') Профиль @stop
@section('headExtra')
<script type="text/javascript" src="{{ URL::asset('libs/js/profile.js') }}"></script>
@stop
@section('content')
	<div class="container">
		<input id="ajaxURL" type="hidden" value="{{ $ajax_url }}">
		@if ($errors->all())
	        <div class="alert alert-danger">
	            @foreach ($errors->all() as $error)
	            <p>{{ $error }}</p>
	            @endforeach
	        </div>
	    @endif
	    <h1>Мой профиль<sup>Реп.({{$rep}})</sup></h1>
	    @if($is_vk)
	    	<div class="alert alert-warning">
	    		<p>Для того чтобы изменить имя, фамилию, аватар, просто отредактируйте свой профиль Vkontakte</p>
	    	</div>
	    @endif
	    <div class="row">
	    	<div class="col-md-2">
	    		@if(!empty($avatar_url_big))
	    			<img src="{{$avatar_url_big}}" class="img-responsive" alt="Responsive image">
	    		@endif
	    	</div>
		    <div class="col-md-10">
			    <div class="form-group">
		        	<label class="col-sm-2 control-label" for="formGroupName">Имя</label>
		        	<div class="col-sm-10">
			        	@if($is_vk)
			        		<p>{{ $name }}</p>
			        	@else
			        		<input value="{{ $name }}" class="form-control" type="text" id="formGroupName" placeholder="Ваше мя">
			        	@endif
		        	</div>
		        </div>
		        <div class="form-group">
		        	<label class="col-sm-2 control-label" for="formGroupSurname">Фамилия</label>
		        	<div class="col-sm-10">
		        		@if($is_vk)
		        			<p>{{ $surname }}</p>
		        		@else
		        			<input value="{{ $surname }}" class="form-control" type="text" id="formGroupSurname" placeholder="Ваша фамилия">
		        		@endif
		        	</div>
		        </div>
		        <div class="form-group">
		        	<label class="col-sm-2 control-label" for="formGroupSurname">Населенный пункт</label>
		        	<div class="col-sm-10">
		        		<div class="col-sm-5" style="padding: 0px;" >
			        		<select name="region" id="regionSelect" class="form-control select select-primary select-block mbl">
			        			<option value="0">Не выбран</option>
							    @foreach($all_regions as $region)
							    <option @if($region_id == $region['id']) selected @endif value="{{ $region['id'] }}">{{ $region['name'] }}</option>
							    @endforeach
							</select>
						</div>
						<div class="col-sm-5" id="cityWrapper">

							@if(!empty($regions_cities) && $city_id!=0)
								<select name="city" id="citySelect" class="form-control select select-primary select-block mbl">
			        				<option value="0">Не выбран</option>
							    	@foreach($regions_cities as $city)
							    		<option @if($city_id == $city['id']) selected @endif value="{{ $city['id'] }}">{{ $city['name'] }}</option>
							    	@endforeach
								</select>
							@endif
						</div>
		        	</div>
		        </div>


		    </div>
		</div>	
	</div>
@stop