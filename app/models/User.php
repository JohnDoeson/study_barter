<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	protected $fillable = array('username', 'email', 'password');

	public static $validation = array(
	    'email'     => 'required|email|unique:users',
	    'username'  => 'required|alpha_num|unique:users',
	    'password'  => 'required|confirmed|min:6',
	);
	public function register() {
	    $this->password = Hash::make($this->password);
	    $this->activation_code = $this->generateCode();
	    $this->is_active = false;
	    $this->vk_id = false;
	    $this->save();
	 
	    Log::info("User [{$this->email}] registered. Activation code: {$this->activationCode}");
	 
	    $this->sendActivationMail();
	 
	    return $this->id;
	}
	protected function generateCode() {
	    return Str::random(); // По умолчанию длина случайной строки 16 символов
	}
	public function sendActivationMail() {
	    $activationUrl = action(
	        'UsersController@getActivate',
	        array(
	            'userId' => $this->id,
	            'activationCode'    => $this->activation_code,
	        )
	    );
	 
	    $that = $this;
	    Mail::send('emails/activation',
	        array('activationUrl' => $activationUrl),
	        function ($message) use($that) {
	            $message->to($that->email)->subject('Спасибо за регистрацию!');
	        }
	    );
	    //var_dump($activationUrl);
	}
	public function activate($activationCode) {
	    if ($this->is_active) {
	        return false;
	    }
	 
	    if ($activationCode != $this->activation_code) {
	        return false;
	    }
	    $this->activation_code = '';
	    $this->is_active = true;
	    $this->save();
	 
	    Log::info("User [{$this->email}] successfully activated");
	 
	    return true;
	}


}
