<?php

class HomeController extends BaseController {

	public function getIndex() {
        if(Cookie::get('domain_hash')) {
            $domain = Domain::find(Cookie::get('domain_hash'));
            $homepage = $domain->homepage ? $domain->homepage : $domain->domain;
            return View::make('home')->withHomepage($homepage);
        }else{
        	if($this->_profileExists()){
	        	$profile = $this->_getProfile() ;
	        	$started = $this->_isTodayStarted(); 
	            return View::make('home')->with('profile',$profile)->with('started',$started);
            }else return Output::push(array(
							'path' => 'login',
							'messages' => array('success' => _('Please Login to Your Account')),
							)); 
        }
	}
	
	public function postIndex()
	{
        $attend = new Attend;
        $attend->user_id = $this->_getUserId();
        $attend->remote_addr = $_SERVER['REMOTE_ADDR'];
        $attend->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $attend->save();
        $started = $this->_isTodayStarted(); 
        if($started == 0){
	        return Output::push(array(
							'path' => '/',
							'errors' => 'Attendace Stopped',
							//'messages' => array('success' => _('Time Stopped')),
							));
        }else return Output::push(array(
							'path' => '/',
							'messages' => array('success' => _('Attendace Started')),
							));
        
	}
	
	private function _getUserId(){
		$profile = $this->_getProfile();
		$user = User::where('profile_id',$profile->id)->first();
	    return $user->id;
	}
	
	private function _getProfile(){
		$profile = Profile::where('user_agent',$_SERVER['HTTP_USER_AGENT'])->where('remote_addr',$_SERVER['REMOTE_ADDR'])->first();
		return $profile;
	}
	
	private function _profileExists(){
		$profile = Profile::where('user_agent',$_SERVER['HTTP_USER_AGENT'])->where('remote_addr',$_SERVER['REMOTE_ADDR'])->exists();
		return $profile;
	}
	
	private function _getTodayAttend($user_id){
		$attends = DB::select('select * from attends where user_id = ? and date(created_at) = CURDATE()', array($user_id));
		return $attends;
	}
	
	private function _isTodayStarted(){
		$user_id = $this->_getUserId();
		$attends = $this->_getTodayAttend($user_id);
		$started = count($attends) % 2;
		return $started;
	}

}
