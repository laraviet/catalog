<?php namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    public function index()
	{
		$products = Product::getAllProduct(IS_PAGINATE);

		return view('admin.products.index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $endChildCategories = Category::getAllEndChildrenCategory();

		return view('admin.products.create', compact('endChildCategories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(ProductRequest $request)
	{
        $inputData = $request->all();
		$product = new Product();

        $product->updateProduct($inputData);

		return redirect()->action('Admin\ProductController@index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = Product::findOrFail($id);

		return view('admin.products.show', compact('product'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product = Product::findOrFail($id);
        $endChildCategories = Category::getAllEndChildrenCategory();

		return view('admin.products.edit', compact('product', 'endChildCategories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(ProductRequest $request, $id)
	{
        $inputData = $request->all();
		$product = Product::findOrFail($id);

        $product->updateProduct($inputData);

		return redirect()->action('Admin\ProductController@index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Product::deleteProduct($id);

		return redirect()->action('Admin\ProductController@index')->with('message', 'Item deleted successfully.');
	}

    public function dashboard()
    {
        $products = Product::getAllProduct(IS_PAGINATE);

        return view('admin.products.dashboard', compact('products'));
    }

    public function dashboardCat($categoryId)
    {
        $products = Category::getProductByCatIds($categoryId);

        return view('admin.products.dashboard', compact('products'));
    }

}
