<?php namespace Amelia\Shop\Http\Controllers;

use Amelia\Shop\Http\Requests\Products\CreateProductRequest;
use Amelia\Shop\Http\Requests\Products\DeleteProductRequest;
use Amelia\Shop\Http\Requests\Products\UpdateProductRequest;
use Amelia\Shop\Repositories\ProductRepository;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Routing\Controller;

/**
 * Class ProductController
 *
 * @package amelia/shop
 * @resource("products")
 */
class ProductController extends Controller {

	/**
	 * @var \Amelia\Shop\Repositories\ProductRepository
	 */
	protected $product;

	/**
	 * Make a new controller instance with injected repositories
	 *
	 * @param \Amelia\Shop\Repositories\ProductRepository $product
	 */
	public function __construct(ProductRepository $product) {
		$this->product = $product;
	}

	/**
	 * Show a product by slug.
	 *
	 * @param $slug
	 * @return \Illuminate\View\View
	 */
	public function show($slug) {
		$products = $this->product->get($slug);
		return view("shop::products.show", compact("products"));
	}

	/**
	 * Show all products, paginated.
	 *
	 * @param \Illuminate\Contracts\Config\Repository $config
	 * @return \Illuminate\View\View
	 */
	public function index(Config $config) {
		$products = $this->product->paginate($config->get("shop::pagination.products", 25));
		return view("shop::products.index", compact("products"));
	}

	/**
	 * Create a Product.
	 *
	 * @param \Amelia\Shop\Http\Requests\Products\CreateProductRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function create(CreateProductRequest $request) {
		$this->product->create($request->all());
		return redirect()->back();
	}

	/**
	 * Update a product
	 *
	 * @param int                                                $id
	 * @param \Amelia\Shop\Http\Requests\Products\UpdateProductRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id, UpdateProductRequest $request) {
		$this->product->update($id, $request->all());
		return redirect()->back();
	}


	/**
	 * Delete a product.
	 *
	 * @param                                                          $id
	 * @param \Amelia\Shop\Http\Requests\Products\DeleteProductRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id, DeleteProductRequest $request) {
		$this->product->delete($id);
		return redirect()->back();
	}
}
