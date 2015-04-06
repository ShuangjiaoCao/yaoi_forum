<?php

class CharakterController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth', array('only' => array('create', 'store', 'edit', 'update', 'destroy')));
		$this->beforeFilter('csrf', array('only' => array('store', 'update', 'destroy')));
	}

	public function posts($id)
	{
		$charakter = Charakter::find($id);
		$posts = $charakter->posts()->orderBy('updated_at', 'desc')->paginate(15);
		return View::make('articles.specialTags')->with('tag', $charakter)->with('posts', $posts);
	}

	/**
	 * Display a listing of the resource.
	 * GET /charakter
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('tags.list')->with('charakters', Charakter::where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /charakter/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /charakter
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /charakter/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /charakter/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('tags.edit')->with('charakter', Charakter::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /charakter/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'name' => array('required', 'regex:/^\w+$/'),
		);
		$validator = Validator::make(Input::only('name'), $rules);
		if ($validator->passes()) {
			charakter::find($id)->update(Input::only('name'));
			return Redirect::back()->with('message', array('type' => 'success', 'content' => '修改成功'));
		} else {
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /charakter/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$charakter = Charakter::find($id);
		$charakter->count = 0;
		$charakter->save();
		foreach ($charakter->posts as $posts) {
			$charakter->posts()->detach($posts->id);
		}
		return Redirect::back();
	}
}