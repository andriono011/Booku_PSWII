<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Coupons;
use Session;
use Str;
use DB;

/**
 * ProductController
 *
 * PHP version 7
 *
 * @category ProductController
 * @package  ProductController
 * @author   BookuShoop@gmail.com
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */
class ProductController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->data['q'] = null;

		$this->data['categories'] = Category::parentCategories()
			->orderBy('name', 'asc')
			->get();
		
		$this->data['minPrice'] = Product::min('price');
		$this->data['maxPrice'] = Product::max('price');

		$this->data['buku'] = AttributeOption::whereHas(
			'attribute',
			function ($query) {
					$query->where('code', 'buku')
						->where('is_filterable', 1);
			}
		)
		->orderBy('name', 'asc')->get();

		$this->data['sizes'] = AttributeOption::whereHas(
			'attribute',
			function ($query) {
				$query->where('code', 'size')
					->where('is_filterable', 1);
			}
		)->orderBy('name', 'asc')->get();
								
		$this->data['sorts'] = [
			url('products') => 'Default',
			url('products?sort=price-asc') => 'Harga - Terendah ke Tinggi',
			url('products?sort=price-desc') => 'Harga - Tinggi ke Terendah',
			url('products?sort=created_at-desc') => 'Terbaru',
			url('products?sort=created_at-asc') => 'Terpopuler',
		];

		$this->data['selectedSort'] = url('products');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request request param
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$products = Product::active();

		$products = $this->_searchProducts($products, $request);
		$products = $this->_filterProductsByPriceRange($products, $request);
		$products = $this->_filterProductsByAttribute($products, $request);
		$products = $this->_sortProducts($products, $request);

		$this->data['products'] = $products->paginate(9);
		return $this->loadTheme('products.index', $this->data);
	}

	/**
	 * Search products
	 *
	 * @param array   $products array of products
	 * @param Request $request  request param
	 *
	 * @return \Illuminate\Http\Response
	 */
	private function _searchProducts($products, $request)
	{
		if ($q = $request->query('q')) {
			$q = str_replace('-', ' ', Str::slug($q));
			
			$products = $products->whereRaw('MATCH(name, slug, short_description, description) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);

			$this->data['q'] = $q;
		}

		if ($categorySlug = $request->query('category')) {
			$category = Category::where('slug', $categorySlug)->firstOrFail();

			$childIds = Category::childIds($category->id);
			$categoryIds = array_merge([$category->id], $childIds);

			$products = $products->whereHas(
				'categories',
				function ($query) use ($categoryIds) {
					$query->whereIn('categories.id', $categoryIds);
				}
			);
		}

		return $products;
	}

	/**
	 * Filter products by price range
	 *
	 * @param array   $products array of products
	 * @param Request $request  request param
	 *
	 * @return \Illuminate\Http\Response
	 */
	private function _filterProductsByPriceRange($products, $request)
	{
		$lowPrice = null;
		$highPrice = null;

		if ($priceSlider = $request->query('price')) {
			$prices = explode('-', $priceSlider);

			$lowPrice = !empty($prices[0]) ? (float)$prices[0] : $this->data['minPrice'];
			$highPrice = !empty($prices[1]) ? (float)$prices[1] : $this->data['maxPrice'];

			if ($lowPrice && $highPrice) {
				$products = $products->where('price', '>=', $lowPrice)
					->where('price', '<=', $highPrice)
					->orWhereHas(
						'variants',
						function ($query) use ($lowPrice, $highPrice) {
							$query->where('price', '>=', $lowPrice)
								->where('price', '<=', $highPrice);
						}
					);

				$this->data['minPrice'] = $lowPrice;
				$this->data['maxPrice'] = $highPrice;
			}
		}

		return $products;
	}

	/**
	 * Filter products by attribute
	 *
	 * @param array   $products array of products
	 * @param Request $request  request param
	 *
	 * @return \Illuminate\Http\Response
	 */
	private function _filterProductsByAttribute($products, $request)
	{
		if ($attributeOptionID = $request->query('option')) {
			$attributeOption = AttributeOption::findOrFail($attributeOptionID);

			$products = $products->whereHas(
				'ProductAttributeValues',
				function ($query) use ($attributeOption) {
					$query->where('attribute_id', $attributeOption->attribute_id)
						->where('text_value', $attributeOption->name);
				}
			);
		}

		return $products;
	}

	/**
	 * Sort products
	 *
	 * @param array   $products array of products
	 * @param Request $request  request param
	 *
	 * @return \Illuminate\Http\Response
	 */
	private function _sortProducts($products, $request)
	{
		if ($sort = preg_replace('/\s+/', '', $request->query('sort'))) {
			$availableSorts = ['price', 'created_at'];
			$availableOrder = ['asc', 'desc'];
			$sortAndOrder = explode('-', $sort);

			$sortBy = strtolower($sortAndOrder[0]);
			$orderBy = strtolower($sortAndOrder[1]);

			if (in_array($sortBy, $availableSorts) && in_array($orderBy, $availableOrder)) {
				$products = $products->orderBy($sortBy, $orderBy);
			}

			$this->data['selectedSort'] = url('products?sort='. $sort);
		}
		
		return $products;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param string $slug product slug
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug)
	{
		$product = Product::active()->where('slug', $slug)->first();

		if (!$product) {
			return redirect('products');
		}

		if ($product->configurable()) {
			$this->data['buku'] = ProductAttributeValue::getAttributeOptions($product, 'buku')->pluck('text_value', 'text_value');
			$this->data['sizes'] = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
		}

		$this->data['product'] = $product;

		return $this->loadTheme('products.show', $this->data);
	}

	/**
	 * Quick view product.
	 *
	 * @param string $slug product slug
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function quickView($slug)
	{
		$product = Product::active()->where('slug', $slug)->firstOrFail();
		if ($product->configurable()) {
			$this->data['buku'] = ProductAttributeValue::getAttributeOptions($product, 'buku')->pluck('text_value', 'text_value');
			$this->data['sizes'] = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
		}

		$this->data['product'] = $product;
		
		return $this->loadTheme('products.quick_view', $this->data);
	}

	public function applyCoupon(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			// echo "<pre>";print_r($data);die;
			
			$couponCount = Coupons::where('coupon_code', $data['coupon_code'])->count();
			if($couponCount ==0){
				return redirect()->back()->with('flash_message_error', 'Kode kupon tidak ada');
			}else{
				// echo "Success";die;
				$couponDetails = Coupons::where('coupon_code',$data['coupon_code'])->first();
				//Coupon Status
				if($couponDetails->status==0){
					return redirect()->back()->with('flash_message_error', 'Kode kupon tidak aktif');
				}
				//Check Coupon Expiry date
				$expiry_date = $couponDetails->expiry_date;
				$current_date = date('Y-m-d');
				if($expiry_date < $current_date){
					return redirect()->back()->with('flash_message_error', 'Kode Kupon Kedaluwarsa');
				}
				//Coupon is ready for Discount
				$_session_id = Session::get('session_id');
				$userCart = DB::table('cart')->where(['session_id'=>$_session_id])->get();
				$item->price = 0;
				foreach($userCart as $item){
					$item->price = $item->price + ($item->price*$item->quantity);
				}
				//Check if coupon amount is fixed or percent
				if($couponDetails->amount_type=="Fixed"){
					$couponAmount = $couponDetails->price;
				}else{
					$couponAmount = $item->price * ($couponDetails->price/100);
				}
				//Add Coupon in Session
				Session::put('CouponAmount', $couponAmount);
				Session::put('CouponCode', $data['coupon_code']);
				return redirect()->back()->with('flash_message_success', 'Kode Kupon Berhasil Diterapkan. Anda Telah menggunakan Kupon');
			}
		}
	}
}
