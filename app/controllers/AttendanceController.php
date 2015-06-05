<?php

class AttendanceController extends \BaseController {

	/**
	 * Instantiate a new OnlinePhonesController instance.
	 */
	public function __construct() {

		$this->beforeFilter('auth');

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$status = Auth::user()->status;
		if($status == 2){
			$online_phone = OnlinePhone::all();
		}elseif($status == 3){
			$attends = $this->_getTodayAttend(Auth::user()->id);
		}else{
			$sip_server = Domain::find(Cookie::get('domain_hash'))->sip_server;
			$online_phone = OnlinePhone::whereSipServer($sip_server)->get();
		}

		return View::make('attendance.index')->with('attends', $attends);
	}
	
	private function _haveOnlinePhone($sip_server){
		$results = DB::select('select sip_server from domains where deleted_at IS NULL and sip_server = ?', array($sip_server));
		if($results){
				return TRUE;
			}else return FALSE;
		
	}
	
	private function _getTodayAttend($user_id){
		$attends = DB::select('select * from attends where user_id = ? and date(created_at) = CURDATE()', array($user_id));
		return $attends;
	}


}
