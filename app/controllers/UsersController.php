<?php

class UsersController extends BaseController {
	//////////////////////////////
	public function getVklogin() {
		$code = Input::get('code');
		//OAuth::setHttpClient('CurlClient');
		$vk = OAuth::consumer('Vkontakte','http://localhost/study_barter/public/users/vklogin');
		//var_dump($code);
		if (!empty($code)) {

			$token = $vk->requestAccessToken($code);
			$result = json_decode( $vk->request('users.get?lang=ru&fields=photo_100,photo_200'), true );
			$result = $result['response'][0];
			
			//echo "<pre>";
			//var_dump($result);
			//echo "</pre>";
			//die();

			if ( $user = User::where('vk_id','=',$result['uid'])->first() ) {
				//die(var_dump($result));
				

				$member = Member::where('user_id','=',$user->id)->first();

				$member->name = $result['first_name'];
				$member->surname = $result['last_name'];
				$member->avatar_url = $result['photo_100'];
				$member->avatar_url_big = $result['photo_200'];
				$member->save();

				Auth::login($user);
				return Redirect::to('/');
			} else {
				$user = new User();

				$user->vk_id = $result['uid'];
				$user->is_active = 1;
				$user->save();

				$member = new Member();
				$member->user_id = $user->id;
				$member->name = $result['first_name'];
				$member->surname = $result['last_name'];
				$member->avatar_url = $result['photo_100'];
				$member->avatar_url_big = $result['photo_200'];
				$member->save();

				Auth::login($user);
				Log::info("User [{$result['first_name']}] successfully logged in.");
				return Redirect::to('/');
			} 



		} else {
			$url = $vk->getAuthorizationUri();
			return Redirect::to((string)$url );
		}
	}


	//////////////////////////////
	public function getRegister() {
	    return View::make('register');
	}	
	public function getLogin() {
	    return View::make('login');
	}
	public function postLogin() {
	   	$creds = array(
	        'password' => Input::get('password'),
	        'is_active'  => 1,
	    );
	   	$username = Input::get('username');
	    if (strpos($username, '@')) {
	        $creds['email'] = $username;
	    } else {
	        $creds['username'] = $username;
	    }
	    if (Auth::attempt($creds, Input::has('remember'))) {
	        Log::info("User [{$username}] successfully logged in.");
	        return Redirect::intended();
	    } else {
	        Log::info("User [{$username}] failed to login.");
	    }

	    $alert = "Неверная комбинация имени (email) и пароля, либо учетная запись еще не активирована.";

	    return Redirect::back()->withAlert($alert);

	}
	public function getLogout() {
	    Auth::logout();
	    return Redirect::to('/');
	}
	public function postRegister() {
	    $rules = User::$validation;
    	$validation = Validator::make(Input::all(), $rules);
	    if ($validation->fails()) {
	        return Redirect::to('/register')->withErrors($validation)->withInput();
	    }
	    $user = new User();
   		$user->fill(Input::all());
    	$id = $user->register();
    	$member = new Member();
		$member->user_id = $id;
		$member->save();
		$redir = action('IndexController@getIndex');
    	return $this->getMessage("Регистрация почти завершена. Вам необходимо подтвердить e-mail, указанный при регистрации, перейдя по ссылке в письме.",$redir, "Завершение регистрации");

	}
	public function getActivate($userId, $activationCode) {
	    $user = User::find($userId);
	    if (!$user) {
	        return $this->getMessage("Неверная ссылка на активацию аккаунта.",false,"Неверная ссылка");
	    }

	    if ($user->activate($activationCode)) {

	        Auth::login($user);
	        $redir = action('IndexController@getIndex');
	        return $this->getMessage("Аккаунт активирован",$redir, "Аккаунт активирован");
	    }

	    return $this->getMessage("Неверная ссылка на активацию аккаунта, либо учетная запись уже активирована.");
	}
	protected function getMessage($message, $redirect = false,$title = 'Отчет') {
	    return View::make('message', array(
	    	'title'   => $title,
	        'message'   => $message,
	        'redirect'  => $redirect,
	    ));
	}

}
