<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::getAllCategories();

		return view('admin.categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$arrCategories = Category::getAllParentCategory();

		return view('admin.categories.create', compact('arrCategories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(CategoryRequest $request)
	{
        $inputData = $request->all();
		$category = new Category();

		$category->updateCategory($inputData);

		return redirect()->action('Admin\CategoryController@index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = Category::getCategoryById($id);

		return view('admin.categories.show', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = Category::getCategoryById($id);
        $arrCategories = Category::getAllParentCategory($category);

		return view('admin.categories.edit', compact('category', 'arrCategories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(CategoryRequest $request, $id)
	{
        $inputData = $request->all();
		$category = Category::getCategoryById($id);
        $category->updateCategory($inputData);

		return redirect()->action('Admin\CategoryController@index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Category::deleteCategory($id);

		return redirect()->action('Admin\CategoryController@index')->with('message', 'Item deleted successfully.');
	}

}
