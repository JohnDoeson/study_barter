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
	    <h1>Мой профиль</h1>
	    <h4 class="rep">Репутация: {{$rep}}</h4>
	    @if($is_vk)
	    	<div class="alert alert-warning">
	    		<p>Для того чтобы изменить имя, фамилию, аватар, просто отредактируйте свой профиль Vkontakte</p>
	    	</div>
	    @endif
	    <div class="row">
	    	<div class="col-md-2">
	    		@if(!empty($avatar_url_big))
	    			<img src="{{$avatar_url_big}}" class="img-responsive" alt="Responsive image">
	    		@else
	    		   <a href="#" onclick="document.getElementById('fileID').click(); return false;" />
	    		   <img  src="http://placehold.it/400x400" alt="" class="img-responsive load_img">
	    		   </a>
                <input type="file" id="fileID" style="visibility: hidden;" />
	    		@endif
	    	</div>
		    <div class="col-md-10">
		  
			    <div class="form-group ">
		        	<label class="col-sm-3 control-label" for="formGroupName">Имя</label>
		        	<div class="col-sm-9 profile_group">
			        	@if($is_vk)
			        		<p>{{ $name }}</p>
			        	@else
			        		<input value="{{ $name }}" class="form-control" type="text" id="formGroupName" placeholder="Ваше мя">
			        	@endif
		        	</div>
		        </div>
		        <div class="form-group ">
		        	<label class="col-sm-3 control-label" for="formGroupSurname">Фамилия</label>
		        	<div class="col-sm-9 profile_group">
		        		@if($is_vk)
		        			<p>{{ $surname }}</p>
		        		@else
		        			<input value="{{ $surname }}" class="form-control" type="text" id="formGroupSurname" placeholder="Ваша фамилия" >
		        		@endif
		        	</div>
		        </div>
		        <div class="form-group ">
		        	<label class="col-sm-3 control-label" for="formGroupSurname">Населенный пункт</label>
		        	<div class="col-sm-9 profile_group">
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
		        
		            <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Обо мне</label>
                    <div class="col-sm-9 profile_group">
                        <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    </div>
		    </div>
		    
		
		</div>	
	</div>
	
<!--	Выбор профессии-->
<section class="profile_skills">
    <div class="container prof_select">
        <div class="row skills">
            <div class="col-md-6 text-center">
                <h3>Умею:</h3>
                    <select multiple="multiple" class="form-control multiselect multiselect-info">
                      <option value="0">JavaScript</option>
                      <option value="1" >CSS3</option>
                      <option value="2" >HTML5</option>
                      <option value="3" >PHP</option>
                      <option value="4">MySQL</option>
                    </select>
                      <div id="slider" onclick="getPercent(this);"><p class="percent">--</p></div>
                      <button class="btn btn-success form-control margin">Добавить</button>
                <table class="table table-hover  table-bordered">
                     <thead>
                         <td>Умение</td>
                         <td>Навык</td>
                     </thead>
                    <tr>
                           <td class="vert_mid cell_skill">Javascript</td>
                           <td>
                               <a href="#" class="cross"><span class="fui-cross"></span></a>
                               <div>
                                  <label class="skill_value" for="">10%</label>
                                   <div class="progress">
                                         <div class="progress-bar progress-bar-danger" style="width: 10%;"></div> 
                                    </div>
                               </div>
                          </td>
                     </tr>
                     
                      <tr>
                           <td class="vert_mid cell_skill">Javascript</td>
                           <td>
                               <a href="#" class="cross"><span class="fui-cross"></span></a>
                               <div>
                                  <label class="skill_value" for="">50%</label>
                                   <div class="progress">
                                         <div class="progress-bar progress-bar-warning" style="width: 50%;"></div> 
                                    </div>
                               </div>
                          </td>
                     </tr>
                     
                      <tr>
                           <td class="vert_mid cell_skill">Javascript</td>
                           <td>
                               <a href="#" class="cross"><span class="fui-cross"></span></a>
                               <div>
                                  <label class="skill_value" for="">60%</label>
                                   <div class="progress">
                                         <div class="progress-bar progress-bar-success" style="width: 60%;"></div> 
                                    </div>
                               </div>
                          </td>
                     </tr>
                </table>
            </div>
            <div class="col-md-6 text-center">
                <h3>Хочу выучить:</h3>
                    <select multiple="multiple" class="form-control multiselect multiselect-info">
                      <option value="0">JavaScript</option>
                      <option value="1" >CSS3</option>
                      <option value="2" >HTML5</option>
                      <option value="3" >PHP</option>
                      <option value="4">MySQL</option>
                    </select>
                      <div id="slider2" onclick="getPercent(this);"><p class="percent">--</p></div>
                      <button class="btn btn-success form-control margin">Добавить</button>
                <table class="table table-hover  table-bordered">
                     <thead>
                         <td>Умение</td>
                         <td>Навык</td>
                     </thead>
                      <tr>
                           <td class="vert_mid cell_skill">Javascript</td>
                           <td>
                              <a href="#" class="cross"><span class="fui-cross"></span></a>
                               <div>
                                  
                                  <label class="skill_value" for="">10%</label>
                                   <div class="progress">
                                         <div class="progress-bar progress-bar-danger" style="width: 10%;"></div> 
                                    </div>
                               </div>
                          </td>
                     </tr>
                      <tr>
                           <td class="vert_mid cell_skill">Javascript</td>
                           <td>
                               <a href="#" class="cross"><span class="fui-cross"></span></a>
                               <div>
                                  <label class="skill_value" for="">50%</label>
                                   <div class="progress">
                                         <div class="progress-bar progress-bar-warning" style="width: 50%;"></div> 
                                    </div>
                               </div>
                          </td>
                     </tr>
                     
                       <tr>
                           <td class="vert_mid cell_skill">Javascript</td>
                           <td>
                               <a href="#" class="cross"><span class="fui-cross"></span></a>
                               <div>
                                  <label class="skill_value" for="">60%</label>
                                   <div class="progress">
                                         <div class="progress-bar progress-bar-success" style="width: 60%;"></div> 
                                    </div>
                               </div>
                          </td>
                     </tr>
                </table>
            </div>
        </div>
    </div>
    
    
</section>
<script>


//var func = $(".ui-slider-range").on('mouseout',function(){
//    var sliderWidth = parseInt($("#slider").css("width"));
//    var percent = parseInt($(this).css("width"))/sliderWidth*100;
//    console.log(percent.toFixed()+"%");
//    
//  console.log($(this)[0]);
//    
//})




</script>
@stop