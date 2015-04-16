<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admincontroller
	 *
	 * @return Response
	 */

	public function tags() {
		return View::make('admin.tags.list')
		->with('circles', Circle::where('count', '>', '0')->orderBy('count','desc')->orderBy('updated_at', 'desc')->paginate(20))
		->with('charakters', Charakter::where('count', '>', '0')->orderBy('count','desc')->orderBy('updated_at', 'desc')->paginate(20))
		->with('cps', Cp::where('count', '>', '0')->orderBy('count','desc')->orderBy('updated_at', 'desc')->paginate(20))
		->with('tags', Tag::where('count', '>', '0')->orderBy('count','desc')->orderBy('updated_at', 'desc')->paginate(20));
		
	}


	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admincontroller/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admincontroller
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admincontroller/{id}
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
	 * GET /admincontroller/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admincontroller/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admincontroller/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}