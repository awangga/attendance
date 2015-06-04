<?php

class HomeController extends BaseController {

	public function showHome() {
        if(Cookie::get('domain_hash')) {
            $domain = Domain::find(Cookie::get('domain_hash'));
            $homepage = $domain->homepage ? $domain->homepage : $domain->domain;
            return View::make('home')->withHomepage($homepage);
        }else{
        	$user_now = Profile::where('user_agent',$_SERVER['HTTP_USER_AGENT'])->where('remote_addr',$_SERVER['REMOTE_ADDR'])->first();
            return View::make('home')->with('user_now',$user_now);
        }
	}

}
