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

Route::get('/customers', [CustomerController::class, 'getAllCustomers']);
Route::get('/customers/{id}', [CustomerController::class, 'getCustomerById']);
Route::get('/customers/{id}/addresses', [CustomerController::class, 'getAddressesByCustomerId']);
Route::post('/customers', [CustomerController::class, 'createCustomer']);
Route::put('/customers/{id}', [CustomerController::class, 'updateCustomer']);
Route::delete('/customers/{id}', [CustomerController::class, 'deleteCustomer']);

/*
|--------------------------------------------------------------------------
| Address Routes
|--------------------------------------------------------------------------
*/

Route::get('/addresses', [AddressController::class, 'getAllAddresses']);
Route::get('/addresses/{id}', [AddressController::class, 'getAddressById']);
Route::post('/addresses', [AddressController::class, 'createAddress']);
Route::put('/addresses/{id}', [AddressController::class, 'updateAddress']);
Route::delete('/addresses/{id}', [AddressController::class, 'deleteAddress']);

/*
|--------------------------------------------------------------------------
| Brand Routes
|--------------------------------------------------------------------------
*/

Route::get('/brands', [BrandController::class, 'getAllBrands']);
Route::get('/brands/{id}', [BrandController::class, 'getBrandById']);
Route::post('/brands', [BrandController::class, 'createBrand']);
Route::put('/brands/{id}', [BrandController::class, 'updateBrand']);
Route::delete('/brands/{id}', [BrandController::class, 'deleteBrand']);

/*
|--------------------------------------------------------------------------
| Brand Coupons Routes
|--------------------------------------------------------------------------
*/

Route::get('/brand-coupons', [BrandCouponController::class, 'getAllBrandCoupons']);
Route::get('/brand-coupons/{id}', [BrandCouponController::class, 'getBrandCouponById']);
Route::post('/brand-coupons', [BrandCouponController::class, 'createBrandCoupon']);
Route::put('/brand-coupons/{id}', [BrandCouponController::class, 'updateBrandCoupon']);
Route::delete('/brand-coupons/{id}', [BrandCouponController::class, 'deleteBrandCoupon']);

/*
|--------------------------------------------------------------------------
| Brand Language Routes
|--------------------------------------------------------------------------
*/

Route::get('/brand-languages', [BrandLanguageController::class, 'getAllBrandLanguages']);
Route::get('/brand-languages/{id}', [BrandLanguageController::class, 'getBrandLanguageById']);
Route::post('/brand-languages', [BrandLanguageController::class, 'createBrandLanguage']);
Route::put('/brand-languages/{id}', [BrandLanguageController::class, 'updateBrandLanguage']);
Route::delete('/brand-languages/{id}', [BrandLanguageController::class, 'deleteBrandLanguage']);

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/

Route::get('/categories', [CategoryController::class, 'getAllCategories']);
Route::get('/categories/{id}', [CategoryController::class, 'getCategoryById']);
Route::get('/categories/{id}/products', [CategoryController::class, 'getProductsByCategoryId']);
Route::post('/categories', [CategoryController::class, 'createCategory']);
Route::put('/categories/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('/categories/{id}', [CategoryController::class, 'deleteCategory']);


/*
|--------------------------------------------------------------------------
| Categories Coupon Routes
|--------------------------------------------------------------------------
*/

Route::get('/categories-coupons', [CategoryCouponController::class, 'getAllCategoriesCoupons']);
Route::get('/categories-coupons/{id}', [CategoryCouponController::class, 'getCategoriesCouponById']);
Route::post('/categories-coupons', [CategoryCouponController::class, 'createCategoriesCoupon']);
Route::put('/categories-coupons/{id}', [CategoryCouponController::class, 'updateCategoriesCoupon']);
Route::delete('/categories-coupons/{id}', [CategoryCouponController::class, 'deleteCategoriesCoupon']);

/*
|--------------------------------------------------------------------------
| Category Language Routes
|--------------------------------------------------------------------------
*/

Route::get('/category-languages', [CategoryLanguageController::class, 'getAllCategoryLanguages']);
Route::get('/category-languages/{id}', [CategoryLanguageController::class, 'getCategoryLanguageById']);
Route::post('/category-languages', [CategoryLanguageController::class, 'createCategoryLanguage']);
Route::put('/category-languages/{id}', [CategoryLanguageController::class, 'updateCategoryLanguage']);
Route::delete('/category-languages/{id}', [CategoryLanguageController::class, 'deleteCategoryLanguage']);

/*
|--------------------------------------------------------------------------
| Category Media Routes
|--------------------------------------------------------------------------
*/

Route::get('/category-media', [CategoryMediaController::class, 'getAllCategoryMedias']);
Route::get('/category-media/{id}', [CategoryMediaController::class, 'getCategoryMediaById']);
Route::post('/category-media', [CategoryMediaController::class, 'createCategoryMedia']);
Route::put('/category-media/{id}', [CategoryMediaController::class, 'updateCategoryMedia']);
Route::delete('/category-media/{id}', [CategoryMediaController::class, 'deleteCategoryMedia']);

/*
|--------------------------------------------------------------------------
| Coupon Routes
|--------------------------------------------------------------------------
*/

Route::get('/coupons', [CouponController::class, 'getAllCoupons']);
Route::get('/coupons/{id}', [CouponController::class, 'getCouponById']);
Route::post('/coupons', [CouponController::class, 'createCoupon']);
Route::put('/coupons/{id}', [CouponController::class, 'updateCoupon']);
Route::delete('/coupons/{id}', [CouponController::class, 'deleteCoupon']);

/*
|--------------------------------------------------------------------------
| Language Routes
|--------------------------------------------------------------------------
*/

Route::get('/languages', [LanguageController::class, 'getAllLanguages']);
Route::get('/languages/{id}', [LanguageController::class, 'getLanguageById']);
Route::post('/languages', [LanguageController::class, 'createLanguage']);
Route::put('/languages/{id}', [LanguageController::class, 'updateLanguage']);
Route::delete('/languages/{id}', [LanguageController::class, 'deleteLanguage']);

/*
|--------------------------------------------------------------------------
| Order Routes
|--------------------------------------------------------------------------
*/

Route::get('/orders', [OrderController::class, 'getAllOrders']);
Route::get('/orders/{id}', [OrderController::class, 'getOrderById']);
Route::get('/orders/{order_id}/items', [OrderController::class, 'getOrderItemsByOrderId']);
Route::post('/orders', [OrderController::class, 'createOrder']);
Route::put('/orders/{id}', [OrderController::class, 'updateOrder']);
Route::put('/orders/{id}/cancel', [OrderController::class, 'cancelOrder']);

/*
|--------------------------------------------------------------------------
| Order Item Routes
|--------------------------------------------------------------------------
*/

Route::get('/order-items', [OrderItemController::class, 'getAllOrderItems']);
Route::get('/order-items/{id}', [OrderItemController::class, 'getOrderItemById']);
Route::post('/order-items', [OrderItemController::class, 'createOrderItem']);
Route::put('/order-items/{id}', [OrderItemController::class, 'updateOrderItem']);
Route::delete('/order-items/{id}', [OrderItemController::class, 'deleteOrderItem']);

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products/{id}', [ProductController::class, 'getProductById']);
Route::post('/products', [ProductController::class, 'createProduct']);
Route::put('/products/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);

/*
|--------------------------------------------------------------------------
| Product Coupon Routes
|--------------------------------------------------------------------------
*/

Route::get('/product-coupons', [ProductCouponController::class, 'getAllProductCoupons']);
Route::get('/product-coupons/{id}', [ProductCouponController::class, 'getProductCouponById']);
Route::post('/product-coupons', [ProductCouponController::class, 'createProductCoupon']);
Route::put('/product-coupons/{id}', [ProductCouponController::class, 'updateProductCoupon']);
Route::delete('/product-coupons/{id}', [ProductCouponController::class, 'deleteProductCoupon']);

/*
|--------------------------------------------------------------------------
| Product Language Routes
|--------------------------------------------------------------------------
*/

Route::get('/product-languages', [ProductLanguageController::class, 'getAllProductLanguages']);
Route::get('/product-languages/{id}', [ProductLanguageController::class, 'getProductLanguageById']);
Route::post('/product-languages', [ProductLanguageController::class, 'createProductLanguage']);
Route::put('/product-languages/{id}', [ProductLanguageController::class, 'updateProductLanguage']);
Route::delete('/product-languages/{id}', [ProductLanguageController::class, 'deleteProductLanguage']);

/*
|--------------------------------------------------------------------------
| Product Media Routes
|--------------------------------------------------------------------------
*/

Route::get('/product-media', [ProductMediaController::class, 'getAllProductMedia']);
Route::get('/product-media/{id}', [ProductMediaController::class, 'getProductMediaById']);
Route::post('/product-media', [ProductMediaController::class, 'createProductMedia']);
Route::put('/product-media/{id}', [ProductMediaController::class, 'updateProductMedia']);
Route::delete('/product-media/{id}', [ProductMediaController::class, 'deleteProductMedia']);

/*
|--------------------------------------------------------------------------
| Product Size Routes
|--------------------------------------------------------------------------
*/

Route::get('/product-sizes', [ProductSizeController::class, 'getAllProductSizes']);
Route::get('/product-sizes/{id}', [ProductSizeController::class, 'getProductSizeById']);
Route::post('/product-sizes', [ProductSizeController::class, 'createProductSize']);
Route::put('/product-sizes/{id}', [ProductSizeController::class, 'updateProductSize']);
Route::delete('/product-sizes/{id}', [ProductSizeController::class, 'deleteProductSize']);

/*
|--------------------------------------------------------------------------
| Product Stock Routes
|--------------------------------------------------------------------------
*/

Route::get('/product-stocks', [ProductStockController::class, 'getAllProductStocks']);
Route::get('/product-stocks/{id}', [ProductStockController::class, 'getProductStockById']);
Route::post('/product-stocks', [ProductStockController::class, 'createProductStock']);
Route::put('/product-stocks/{id}', [ProductStockController::class, 'updateProductStock']);
Route::delete('/product-stocks/{id}', [ProductStockController::class, 'deleteProductStock']);

/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
*/

Route::get('/roles', [RoleController::class, 'getAllRoles']);
Route::get('/roles/{id}', [RoleController::class, 'getRoleById']);
Route::post('/roles', [RoleController::class, 'createRole']);
Route::put('/roles/{id}', [RoleController::class, 'updateRole']);
Route::delete('/roles/{id}', [RoleController::class, 'deleteRole']);

/*
|--------------------------------------------------------------------------
| Wishlist Routes
|--------------------------------------------------------------------------
*/

Route::get('/wishlists', [WishlistController::class, 'getAllWishlists']);
Route::get('/wishlists/{id}', [WishlistController::class, 'getWishlistById']);
Route::post('/wishlists', [WishlistController::class, 'createWishlist']);
Route::put('/wishlists/{id}', [WishlistController::class, 'updateWishlist']);
Route::delete('/wishlists/{id}', [WishlistController::class, 'deleteWishlist']);
