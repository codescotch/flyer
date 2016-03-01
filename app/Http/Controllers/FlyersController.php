<?php

namespace App\Http\Controllers;

use App\Flyer;
use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
//use App\Http\Controllers\Traits\AuthorizesUsers;
//use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlyersController extends Controller
{
	// trait - this was the first way we handled verifying the correct user / flyer
	// very useful if you want to perform certain operations in different places
	// traits are similar classes, but only intended to share a group of reusable methods across classes
	// they can't be instantiated on their own, but serve to reduce limitations of single inheritance
	// http://php.net/language.oop5.traits
	// NOTE: this could also be accomplished with a request class (e.g. AddPhotoRequest)
	//use AuthorizesUsers;

	public function __construct()
	{
		$this->middleware('auth', ['except' => 'show']);
		$this->user = \Auth::user();
	}

	public function index()
	{
		return view('flyers.create');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('flyers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * NOTE: function will only execute if validation passes
	 *
	 * @param FlyerRequest $request
	 * @return mixed
	 */
	public function store(FlyerRequest $request)
	{
		$flyer = $this->user->publish(
			new Flyer($request->all())
		);
		// can do this because we made it a global function (app/helpers.php)
		flash()->success('Success!', 'Your flyer has been created.');
		return redirect(flyer_path($flyer));
	}

	/**
	 * Show a given flyer.
	 *
	 * @param $zip
	 * @param $street
	 * @return mixed
	 */
	public function show($zip, $street)
	{
		$flyer = Flyer::locatedAt($zip, $street);

		return view('flyers.show', compact('flyer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
	
}
