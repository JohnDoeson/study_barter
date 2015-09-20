<?php
class Member extends Eloquent{

	protected $table = 'members';

	static function currentUsername () {
		if (Auth::check()) {
			$id = Auth::user()->id;
			if ($member = Member::where('user_id','=',$id)->first()) {
				
				if (!empty($member->name)) {
					return $member->name;
				} else {
					return Auth::user()->username;
				}
			} else {
				return 'Unknown';
			}
			

		} else {
			return 'Unknown';
		}

	}


}
