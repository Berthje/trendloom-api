<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BrandCouponController;
use App\Http\Controllers\BrandLanguageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryCouponController;
use App\Http\Controllers\CategoryLanguageController;
use App\Http\Controllers\CategoryMediaController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCouponController;
use App\Http\Controllers\ProductLanguageController;
use App\Http\Controllers\ProductMediaController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'getAllCustomers']);
    Route::get('/{id}', [CustomerController::class, 'getCustomerById']);
    Route::get('/{id}/addresses', [CustomerController::class, 'getAddressesByCustomerId']);
    Route::get('/{customerId}/wishlist/products', [WishlistController::class, 'getProducts']);
    Route::post('/', [CustomerController::class, 'createCustomer']);
    Route::put('/{id}', [CustomerController::class, 'updateCustomer']);
    Route::delete('/{id}', [CustomerController::class, 'deleteCustomer']);
});

/*
|--------------------------------------------------------------------------
| Address Routes
|--------------------------------------------------------------------------
*/


Route::prefix('addresses')->group(function () {
    Route::get('/', [AddressController::class, 'getAllAddresses']);
    Route::get('/{id}', [AddressController::class, 'getAddressById']);
    Route::post('/', [AddressController::class, 'createAddress']);
    Route::put('/{id}', [AddressController::class, 'updateAddress']);
    Route::delete('/{id}', [AddressController::class, 'deleteAddress']);
});

/*
|--------------------------------------------------------------------------
| Brand Routes
|--------------------------------------------------------------------------
*/

Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'getAllBrands']);
    Route::get('/{id}', [BrandController::class, 'getBrandById']);
    Route::post('', [BrandController::class, 'createBrand']);
    Route::put('/{id}', [BrandController::class, 'updateBrand']);
    Route::delete('/{id}', [BrandController::class, 'deleteBrand']);
});

/*
|--------------------------------------------------------------------------
| Brand Coupons Routes
|--------------------------------------------------------------------------
*/

Route::prefix('brand-coupons')->group(function () {
    Route::get('/', [BrandCouponController::class, 'getAllBrandCoupons']);
    Route::get('/{id}', [BrandCouponController::class, 'getBrandCouponById']);
    Route::post('/', [BrandCouponController::class, 'createBrandCoupon']);
    Route::put('/{id}', [BrandCouponController::class, 'updateBrandCoupon']);
    Route::delete('/{id}', [BrandCouponController::class, 'deleteBrandCoupon']);
});

/*
|--------------------------------------------------------------------------
| Brand Language Routes
|--------------------------------------------------------------------------
*/
Route::prefix('brand-languages')->group(function () {
    Route::get('/', [BrandLanguageController::class, 'getAllBrandLanguages']);
    Route::get('/{id}', [BrandLanguageController::class, 'getBrandLanguageById']);
    Route::post('/', [BrandLanguageController::class, 'createBrandLanguage']);
    Route::put('/{id}', [BrandLanguageController::class, 'updateBrandLanguage']);
    Route::delete('/{id}', [BrandLanguageController::class, 'deleteBrandLanguage']);
});

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'getAllCategories']);
    Route::get('/{id}', [CategoryController::class, 'getCategoryById']);
    Route::get('/{id}/products', [CategoryController::class, 'getProductsByCategoryId']);
    Route::post('/', [CategoryController::class, 'createCategory']);
    Route::put('/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('/{id}', [CategoryController::class, 'deleteCategory']);
});

/*
|--------------------------------------------------------------------------
| Category Coupon Routes
|--------------------------------------------------------------------------
*/

Route::prefix('category-coupons')->group(function () {
    Route::get('/', [CategoryCouponController::class, 'getAllCategoryCoupons']);
    Route::get('/{id}', [CategoryCouponController::class, 'getCategoryCouponById']);
    Route::post('/', [CategoryCouponController::class, 'createCategoryCoupon']);
    Route::put('/{id}', [CategoryCouponController::class, 'updateCategoryCoupon']);
    Route::delete('/{id}', [CategoryCouponController::class, 'deleteCategoryCoupon']);
});

/*
|--------------------------------------------------------------------------
| Category Language Routes
|--------------------------------------------------------------------------
*/

Route::prefix('category-languages')->group(function () {
    Route::get('/', [CategoryLanguageController::class, 'getAllCategoryLanguages']);
    Route::get('/{id}', [CategoryLanguageController::class, 'getCategoryLanguageById']);
    Route::post('/', [CategoryLanguageController::class, 'createCategoryLanguage']);
    Route::put('/{id}', [CategoryLanguageController::class, 'updateCategoryLanguage']);
    Route::delete('/{id}', [CategoryLanguageController::class, 'deleteCategoryLanguage']);
});

/*
|--------------------------------------------------------------------------
| Category Media Routes
|--------------------------------------------------------------------------
*/
Route::prefix('category-media')->group(function () {
    Route::get('/', [CategoryMediaController::class, 'getAllCategoryMedias']);
    Route::get('/{id}', [CategoryMediaController::class, 'getCategoryMediaById']);
    Route::post('/', [CategoryMediaController::class, 'createCategoryMedia']);
    Route::put('/{id}', [CategoryMediaController::class, 'updateCategoryMedia']);
    Route::delete('/{id}', [CategoryMediaController::class, 'deleteCategoryMedia']);
});

/*
|--------------------------------------------------------------------------
| Coupon Routes
|--------------------------------------------------------------------------
*/

Route::prefix('coupons')->group(function () {
    Route::get('/', [CouponController::class, 'getAllCoupons']);
    Route::get('/{id}', [CouponController::class, 'getCouponById']);
    Route::post('/', [CouponController::class, 'createCoupon']);
    Route::put('/{id}', [CouponController::class, 'updateCoupon']);
    Route::delete('/{id}', [CouponController::class, 'deleteCoupon']);
});

/*
|--------------------------------------------------------------------------
| Language Routes
|--------------------------------------------------------------------------
*/

Route::prefix('languages')->group(function () {
    Route::get('/', [LanguageController::class, 'getAllLanguages']);
    Route::get('/{id}', [LanguageController::class, 'getLanguageById']);
    Route::post('/', [LanguageController::class, 'createLanguage']);
    Route::put('/{id}', [LanguageController::class, 'updateLanguage']);
    Route::delete('/{id}', [LanguageController::class, 'deleteLanguage']);
});

/*
|--------------------------------------------------------------------------
| Order Routes
|--------------------------------------------------------------------------
*/

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'getAllOrders']);
    Route::get('/{id}', [OrderController::class, 'getOrderById']);
    Route::get('/{order_id}/items', [OrderController::class, 'getOrderItemsByOrderId']);
    Route::post('/', [OrderController::class, 'createOrder']);
    Route::put('/{id}', [OrderController::class, 'updateOrder']);
    Route::put('/{id}/cancel', [OrderController::class, 'cancelOrder']);
});

/*
|--------------------------------------------------------------------------
| Order Item Routes
|--------------------------------------------------------------------------
*/

Route::prefix('order-items')->group(function () {
    Route::get('/', [OrderItemController::class, 'getAllOrderItems']);
    Route::get('/{id}', [OrderItemController::class, 'getOrderItemById']);
    Route::post('/', [OrderItemController::class, 'createOrderItem']);
    Route::put('/{id}', [OrderItemController::class, 'updateOrderItem']);
    Route::delete('/{id}', [OrderItemController::class, 'deleteOrderItem']);
});

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'getAllProducts']);
    Route::get('/{id}', [ProductController::class, 'getProductById']);
    Route::post('/', [ProductController::class, 'createProduct']);
    Route::put('/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
});

/*
|--------------------------------------------------------------------------
| Product Coupon Routes
|--------------------------------------------------------------------------
*/

Route::prefix('product-coupons')->group(function () {
    Route::get('/', [ProductCouponController::class, 'getAllProductCoupons']);
    Route::get('/{id}', [ProductCouponController::class, 'getProductCouponById']);
    Route::post('/', [ProductCouponController::class, 'createProductCoupon']);
    Route::put('/{id}', [ProductCouponController::class, 'updateProductCoupon']);
    Route::delete('/{id}', [ProductCouponController::class, 'deleteProductCoupon']);
});

/*
|--------------------------------------------------------------------------
| Product Language Routes
|--------------------------------------------------------------------------
*/

Route::prefix('product-languages')->group(function () {
    Route::get('/', [ProductLanguageController::class, 'getAllProductLanguages']);
    Route::get('/{id}', [ProductLanguageController::class, 'getProductLanguageById']);
    Route::post('/', [ProductLanguageController::class, 'createProductLanguage']);
    Route::put('/{id}', [ProductLanguageController::class, 'updateProductLanguage']);
    Route::delete('/{id}', [ProductLanguageController::class, 'deleteProductLanguage']);
});

/*
|--------------------------------------------------------------------------
| Product Media Routes
|--------------------------------------------------------------------------
*/

Route::prefix('product-media')->group(function () {
    Route::get('/', [ProductMediaController::class, 'getAllProductMedia']);
    Route::get('/{id}', [ProductMediaController::class, 'getProductMediaById']);
    Route::post('/', [ProductMediaController::class, 'createProductMedia']);
    Route::put('/{id}', [ProductMediaController::class, 'updateProductMedia']);
    Route::delete('/{id}', [ProductMediaController::class, 'deleteProductMedia']);
});

/*
|--------------------------------------------------------------------------
| Product Size Routes
|--------------------------------------------------------------------------
*/

Route::prefix('product-sizes')->group(function () {
    Route::get('/', [ProductSizeController::class, 'getAllProductSizes']);
    Route::get('/{id}', [ProductSizeController::class, 'getProductSizeById']);
    Route::post('/', [ProductSizeController::class, 'createProductSize']);
    Route::put('/{id}', [ProductSizeController::class, 'updateProductSize']);
    Route::delete('/{id}', [ProductSizeController::class, 'deleteProductSize']);
});

/*
|--------------------------------------------------------------------------
| Product Stock Routes
|--------------------------------------------------------------------------
*/

Route::prefix('product-stock')->group(function () {
    Route::get('/', [ProductStockController::class, 'getAllProductStocks']);
    Route::get('/{id}', [ProductStockController::class, 'getProductStockById']);
    Route::post('/', [ProductStockController::class, 'createProductStock']);
    Route::put('/{id}', [ProductStockController::class, 'updateProductStock']);
    Route::delete('/{id}', [ProductStockController::class, 'deleteProductStock']);
});

/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
*/

Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'getAllRoles']);
    Route::get('/{id}', [RoleController::class, 'getRoleById']);
    Route::post('/', [RoleController::class, 'createRole']);
    Route::put('/{id}', [RoleController::class, 'updateRole']);
    Route::delete('/{id}', [RoleController::class, 'deleteRole']);
});

/*
|--------------------------------------------------------------------------
| Wishlist Routes
|--------------------------------------------------------------------------
*/

Route::prefix('wishlists')->group(function () {
    Route::get('/', [WishlistController::class, 'getAllWishlists']);
    Route::get('/{id}', [WishlistController::class, 'getWishlistById']);
    Route::post('/', [WishlistController::class, 'createWishlist']);
    Route::put('/{id}', [WishlistController::class, 'updateWishlist']);
    Route::delete('/{id}', [WishlistController::class, 'deleteWishlist']);
});
