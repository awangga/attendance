<?php

class LoginController extends BaseController {

	public function getIndex() {
        $success = Session::get('success');
        if($success == 'email-confirmation::messages.confirmed' || $success == 'Your email is confirmed'){
            Event::fire('logger',array(array('email_confirmation','',2)));
        }

		return View::make('login.index');
	}

	public function postIndex() {
		$input = Input::only('username', 'password', 'remember');

		$rules = array(
			'username' => 'required|min:3',
			'password'  => 'required|min:6',
		);
		$v = Validator::make($input, $rules);
		if ($v->fails()) {
			return Output::push(array('path' => 'login', 'errors' => $v));
		}

		// check login with username or email and domain_id for user elseif for admin
		if (Auth::attempt(array(
		'username' => $input['username'], 
		'password' => $input['password'], 
		'domain_id' => Cookie::get('domain_hash')), 
		$input['remember']) || Auth::attempt(array(
		'email' => $input['username'], 
		'password' => $input['password'], 
		'domain_id' => Cookie::get('domain_hash')), 
		$input['remember'])) {
			//check ban status
			if (Auth::user()->flag_banned == 1){
				Auth::logout();
				return Output::push(array(
					'path' => 'login',
					'messages' => array('fail' => _('You are banned'))
				));
			}
			//set cookie domain hash
			if(!$this->_checkDcp()) {
				Auth::logout();
				return Output::push(array(
					'path' => 'login',
					'messages' => array('fail' => _('You are not allowed login from this site'))
				));
			}
			$cookie = $this->_setCookie();
			$this->_updateProfile();
			

			return Redirect::to('')->with('success', _('You have successfully logged in'))->withCookie($cookie);
		}elseif(Auth::attempt(array('username' => $input['username'], 'password' => $input['password'], 'status' => 3 ), $input['remember']) || Auth::attempt(array('email' => $input['username'], 'password' => $input['password'], 'status' => 3 ), $input['remember'])){
			//check ban status
			if (Auth::user()->flag_banned == 1){
				Auth::logout();
				return Output::push(array(
					'path' => 'login',
					'messages' => array('fail' => _('You are banned'))
				));
			}
			//set cookie domain hash
			if(!$this->_checkDcp()) {
				Auth::logout();
				return Output::push(array(
					'path' => 'login',
					'messages' => array('fail' => _('Please login to your admin site'))
				));
			}
			$cookie = $this->_setCookie();
			$this->_updateProfile();
			return Redirect::to('')->with('success', _('You have successfully logged in'))->withCookie($cookie);
		} else {
            Event::fire('logger', array(array('login_failed',array('username'=>$input['username']),3)));
			return Output::push(array(
				'path' => 'login',
				'messages' => array('fail' => _('Invalid username or password'))
				));
		}
		
	}

	public function getLogout() {
		Auth::logout();
		return Output::push(array(
			'path' => 'login',
			'messages' => array('success' => _('You have been logged out'))
			));
	}


	private function _setCookie(){
		if(Auth::user()->status == 4){
			$cookie = Cookie::make('domain_hash',Auth::user()->domain_id);
		}else{
			$cookie = Cookie::forget('domain_hash');
		}

		return $cookie;
	}
	
	private function _updateProfile(){
		$profile_id = Auth::user()->profile_id;
		$profile = Profile::find($profile_id);
		$profile->remote_addr = $_SERVER['REMOTE_ADDR'];
		$profile->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$profile->save();
	}

	private function _checkDcp(){
		$ret = TRUE;
		if(Auth::user()->status == 4) {
			if (Auth::user()->domain->domain != Request::getHttpHost()) {
				$ret = FALSE;
			}
		}elseif(Auth::user()->status == 3){
			$ret = TRUE;
		}

		return $ret;

	}
}
