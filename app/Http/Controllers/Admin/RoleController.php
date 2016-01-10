<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::all();

		return view('admin.roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(RoleRequest $request)
	{
		$role = new Role();

		$role->name = $request->input("name");

		$role->save();

		return redirect()->action('Admin\RoleController@index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$role = Role::findOrFail($id);

		return view('admin.roles.show', compact('role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::findOrFail($id);

		return view('admin.roles.edit', compact('role'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(RoleRequest $request, $id)
	{
		$role = Role::findOrFail($id);

		$role->name = $request->input("name");

		$role->save();

		return redirect()->action('Admin\RoleController@index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$role = Role::findOrFail($id);
		$role->delete();

		return redirect()->action('Admin\RoleController@index')->with('message', 'Item deleted successfully.');
	}

}
