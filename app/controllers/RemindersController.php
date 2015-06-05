<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Output::push(array(
							'path' => 'password/remind',
							'messages' => array('fail' => _('Unable to find user')),
							));

			case Password::REMINDER_SENT:
				return Output::push(array(
							'path' => 'password/remind',
							'messages' => array('success' => _('Password recovery request has been sent to email')),
							));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return Output::push(array(
					'path' => 'password/remind',
					'messages' => array('fail' => _('Invalid password')),
					));
			case Password::INVALID_TOKEN:
				return Output::push(array(
					'path' => 'password/remind',
					'messages' => array('fail' => _('Invalid token')),
					));
			case Password::INVALID_USER:
				return Output::push(array(
							'path' => 'password/remind',
							'messages' => array('fail' => _('Unable to find user')),
							));

			case Password::PASSWORD_RESET:
				return Output::push(array(
						'path' => 'login',
						'messages' => array('success' => _('Password has been reset')),
						));
		}
	}

}
