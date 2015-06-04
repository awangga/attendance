<?php
class Domain extends Eloquent {

	protected $fillable = array('id', 'user_id', 'name', 'domain', 'web_service', 'prefix', 'description', 'homepage', 'title', 'theme', 'allow_registration');
    public $incrementing = false;
    protected $softDelete = true;

	public function user() {
		return $this->belongsTo('User');
	}

}