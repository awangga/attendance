<?php

class Profile extends Eloquent {

	protected $fillable = array('first_name', 'last_name', 'email', 'phone_number', 'remote_addr', 'user_agent');
    protected $softDelete = true;

	public function user() {
		return $this->hasOne('User');
	}

}
