<?php

class Profile extends Eloquent {

	protected $fillable = array('first_name', 'last_name', 'email', 'website', 'address');
    protected $softDelete = true;

	public function user() {
		return $this->hasOne('User');
	}

}
