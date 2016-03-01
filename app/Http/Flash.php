<?php

namespace App\Http;

// as always...start by thinking about what you want to be able to write
// $flash->message('Hello');
// $flash->error('Error!');
// $flash->success('Success!');
// $flash->aside('Small message off to the side');
// $flash->overlay('You must close me manually');

class Flash
{
	/**
	 * Create a flash message.
	 *
	 * @param $title
	 * @param $message
	 * @param $type
	 * @param string $key
	 * @return mixed
	 */
	private function create($title, $message, $type, $key = 'flash_message')
	{
		// Jeff says ok to do it like this vs $this->session() since it's always in the Http context
		session()->flash($key, [
			'title'   => $title,
			'message' => $message,
			'type'    => $type
		]);
	}

	/**
	 * Info message with short delay.
	 *
	 * @param $title
	 * @param $message
	 * @return mixed
	 */
	public function info($title, $message)
	{
		return $this->create($title, $message, 'info');
	}

	/**
	 * Success message with short delay.
	 *
	 * @param $title
	 * @param $message
	 * @return mixed
	 */
	public function success($title, $message)
	{
		return $this->create($title, $message, 'success');
	}

	/**
	 * Error message with short delay.
	 *
	 * @param $title
	 * @param $message
	 * @return mixed
	 */
	public function error($title, $message)
	{
		return $this->create($title, $message, 'error');
	}

	/**
	 * Overlay message with default type success.
	 *
	 * @param $title
	 * @param $message
	 * @param string $type
	 * @return mixed
	 */
	public function overlay($title, $message, $type = 'success')
	{
		return $this->create($title, $message, $type, 'flash_message_overlay');
	}
}