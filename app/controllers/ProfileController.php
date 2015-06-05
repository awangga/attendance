<?php

class ProfileController extends BaseController {

	/**
	 * Instantiate a new DashboardController instance.
	 */
	public function __construct() {

		$this->beforeFilter('auth');

	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$profile = Profile::find(Auth::user()->profile_id);

		return View::make('profile.index')->with('profile', $profile);

	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

		$input = Input::only('first_name', 'last_name', 'website');

		$rules = array(
			'first_name' => 'required',
		);
		$v = Validator::make($input, $rules);
		if ($v->fails()) {
			return Output::push(array('path' => 'profile', 'errors' => $v, 'input' => TRUE));
		}

		if ($id && Auth::user()->profile_id == $id) {
			$profile = Profile::find($id);
			$profile->first_name = $input['first_name']; 
			$profile->last_name = $input['last_name']; 
			$profile->phone_number = $input['website']; 
			$profile->save();

			return Output::push(array(
				'path' => 'profile',
				'errors' => 'Profile has been saved',
				'messages' => array('success', _('Profile has been saved')),
				'input' => TRUE
				));
		} else {
			return Output::push(array(
				'path' => 'profile',
				'errors' => 'Unable to update profile',
				'messages' => array('fail', _('Unable to update profile')),
				'input' => TRUE
				));
		}

	}

}
