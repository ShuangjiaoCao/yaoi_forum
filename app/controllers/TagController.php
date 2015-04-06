<?php

class TagController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth', array('only' => array('create', 'store', 'edit', 'update', 'destroy')));
		$this->beforeFilter('csrf', array('only' => array('store', 'update', 'destroy')));
	}

	public function posts($id)
	{
		$tag = Tag::find($id);
		$posts = $tag->posts()->orderBy('updated_at', 'desc')->paginate(15);
		return View::make('articles.specialTags')->with('tag', $tag)->with('posts', $posts);
	}

	/**
	 * Display a listing of the resource.
	 * GET /tag
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('tags.list')->with('tags', Tag::where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tag/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tag
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /tag/{id}
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
	 * GET /tag/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('tags.edit')->with('tag', Tag::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tag/{id}
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
			Tag::find($id)->update(Input::only('name'));
			return Redirect::back()->with('message', array('type' => 'success', 'content' => '修改成功'));
		} else {
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tag = Tag::find($id);
		$tag->count = 0;
		$tag->save();
		foreach ($tag->posts as $posts) {
			$tag->posts()->detach($posts->id);
		}
		return Redirect::back();
	}
}