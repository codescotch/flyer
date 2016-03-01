<?php

// this global helpers file can be very useful!
// NOTE: this isn't a class...don't be silly and add public/private before function decs

/**
 * Pass through message sent from controller to flash message generator method.
 *
 * Made this a global function (rather than inside controllers) since it will be used all over the place
 * Made default param values null so they aren't required
 * NOTE: added to to composer.json: "files": [ "app/helpers.php" ]
 * IMPORTANT: always remember to composer dump-autoload after making changes to composer.json
 *
 * @param null $title
 * @param null $message
 * @return \App\Http\Flash|mixed
 */
function flash($title = null, $message = null)
{
	// method to fetch Flash class from container
	$flash = app('App\Http\Flash');

	if (func_num_args() == 0)
	{
		// returns $flash instance and continues with $flash()->success() or whatever method was specified
		return $flash;
	}

	// default if you call flash() with just title and message (e.g. not flash()->success($t, $m))
	return $flash->info($title, $message);
}

/**
 * The path to a given flyer.
 *
 * @param App\Flyer $flyer
 * @return string
 */
function flyer_path(App\Flyer $flyer)
{
	return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}

// link_to('Delete?', $post, 'DELETE')
// link_to('Delete?', '/photos/1/delete', 'DELETE')
function link_to($body, $path, $type)
{
	// can't reference a function in HEREDOC
	$csrf = csrf_field();

	// e.g. an eloquent model
	if (is_object($path))
	{
		$action = '/' . $path->getTable();
		// do we need to append the id to the action?
		if (in_array($type, ['PUT', 'PATCH', 'DELETE']))
		{
			$action .= '/' . $path->getKey();
		}
	}
	else
	{
		$action = $path;
	}

	return <<<EOT
		<form method="POST" action="{$action}">
			<input type='hidden' name='_method' value='{$type}'>
			$csrf
			<button type="submit">{$body}</button>
		</form>
EOT;

}