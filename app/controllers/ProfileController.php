<?php

class ProfileController extends BaseController {

	public function postCities() {
		if (Input::get('salt') === 'tyRd23Cv321ll') {
			DB::setFetchMode(PDO::FETCH_ASSOC);
			$cities = DB::table('city')->where('region_id','=',Input::get('reg_id'))->get();
			//var_dump($cities);
			echo "<select name='city' id='citySelect' class='form-control select select-primary select-block mbl'>";
			echo "<option value='0'>Не выбран</option>";
			foreach ($cities as $city) {
				echo "<option value='".$city['id']."'>".$city['name']."</option>";
			}
			echo "</select>";
		}
	}
	public function getProfile($id) {
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$member = DB::table('members')
			->where('members.id','=',$id)
			->leftjoin('region','members.region_id','=','region.id')
			->leftjoin('city','members.city_id','=','city.id')
			->select(DB::raw('members.id, members.user_id, members.avatar_url, members.avatar_url_big, members.name, members.surname,members.rep, city.name as city_name, region.name as region_name, city.id as city_id, region.id as region_id'))
			->get();

		
		//echo "<pre>";
		//var_dump($regions);
		//echo "</pre>";
        //die();
		if (!empty($member)) {
			$member = $member[0];
			$member['ajax_url'] = action('ProfileController@postCities');
			$member['all_regions'] = DB::table('region')->get();
			$member['regions_cities'] = DB::table('city')->where('region_id','=',$member['region_id'])->get();

			if (Auth::check()) {
				if ($member['user_id'] === Auth::user()->id) {
					if (Auth::user()->vk_id != 0) {
					$member['is_vk'] = true;
					} else {
						$member['is_vk'] = false;
					}
					return View::make('profile-edit',$member);
				}
				

			} else {
				return View::make('profile',$member);
			}



		}
	    
	    
	}
	static function currentUserProfile () {
		if (Auth::check()) {
			$id = Auth::user()->id;

			$member = Member::where('user_id','=',$id)->first()->id;


			$profileUrl = action(
		        'ProfileController@getProfile',
		        array(
		            'id' => $member
		        )
		    );


			return $profileUrl;
		} else {
			return false;
		}


	}

}
