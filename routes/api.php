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
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\JwtAuthController;
use App\Http\Controllers\ProductFrontController;
use App\Http\Controllers\CategoryFrontController;
use App\Http\Controllers\BrandFrontController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Public Routes - No Authentication Required
|--------------------------------------------------------------------------
*/

Route::get('/translations', [TranslationController::class, 'getTranslation']);

Route::prefix('brands')->group(function () {
    Route::get('/', [BrandFrontController::class, 'getAllBrands']);
    Route::get('/{id}', [BrandFrontController::class, 'getBrandById']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryFrontController::class, 'getAllCategories']);
    Route::get('/{id}', [CategoryFrontController::class, 'getCategoryById']);
    Route::get('/{id}/products', [CategoryFrontController::class, 'getProductsByCategoryId']);
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductFrontController::class, 'getAllProducts']);
    Route::get('/{id}', [ProductFrontController::class, 'getProductById']);
});

Route::prefix('customers')->group(function () {
    Route::post('/', [CustomerController::class, 'createCustomer']);
});

Route::prefix('brand-coupons')->group(function () {
    Route::get('/', [BrandCouponController::class, 'getAllBrandCoupons']);
    Route::get('/{id}', [BrandCouponController::class, 'getBrandCouponById']);
});

Route::prefix('brand-languages')->group(function () {
    Route::get('/', [BrandLanguageController::class, 'getAllBrandLanguages']);
    Route::get('/{id}', [BrandLanguageController::class, 'getBrandLanguageById']);
});

Route::prefix('category-coupons')->group(function () {
    Route::get('/', [CategoryCouponController::class, 'getAllCategoryCoupons']);
    Route::get('/{id}', [CategoryCouponController::class, 'getCategoryCouponById']);
});

Route::prefix('category-languages')->group(function () {
    Route::get('/', [CategoryLanguageController::class, 'getAllCategoryLanguages']);
    Route::get('/{id}', [CategoryLanguageController::class, 'getCategoryLanguageById']);
});

Route::prefix('category-media')->group(function () {
    Route::get('/', [CategoryMediaController::class, 'getAllCategoryMedias']);
    Route::get('/{id}', [CategoryMediaController::class, 'getCategoryMediaById']);
});

Route::prefix('coupons')->group(function () {
    Route::get('/', [CouponController::class, 'getAllCoupons']);
    Route::get('/{id}', [CouponController::class, 'getCouponById']);
});

Route::prefix('languages')->group(function () {
    Route::get('/', [LanguageController::class, 'getAllLanguages']);
    Route::get('/{id}', [LanguageController::class, 'getLanguageById']);
});

Route::prefix('product-languages')->group(function () {
    Route::get('/', [ProductLanguageController::class, 'getAllProductLanguages']);
    Route::get('/{id}', [ProductLanguageController::class, 'getProductLanguageById']);
});

Route::prefix('product-media')->group(function () {
    Route::get('/', [ProductMediaController::class, 'getAllProductMedia']);
    Route::get('/{id}', [ProductMediaController::class, 'getProductMediaById']);
});

Route::prefix('product-coupons')->group(function () {
    Route::get('/', [ProductCouponController::class, 'getAllProductCoupons']);
    Route::get('/{id}', [ProductCouponController::class, 'getProductCouponById']);
});

Route::prefix('product-sizes')->group(function () {
    Route::get('/', [ProductSizeController::class, 'getAllProductSizes']);
    Route::get('/{id}', [ProductSizeController::class, 'getProductSizeById']);
});

Route::prefix('product-stock')->group(function () {
    Route::get('/', [ProductStockController::class, 'getAllProductStocks']);
    Route::get('/{id}', [ProductStockController::class, 'getProductStockById']);
});

Route::post('/register', [JwtAuthController::class, 'register']);
Route::post('/login', [JwtAuthController::class, 'login']);

Route::group(["middleware" => ["auth:api", "auth.csrf.jwt"]], function () {
    Route::get("profile", [JwtAuthController::class, "profile"]);
    Route::get("refresh", [JwtAuthController::class, "refreshToken"]);
    Route::get("logout", [JwtAuthController::class, "logout"]);
});

/*
|--------------------------------------------------------------------------
| Protected Routes - Authentication Required (Customer or Admin)
|--------------------------------------------------------------------------
*/

Route::group(["middleware" => ["auth:api", "auth.csrf.jwt"]], function () {
    Route::prefix('customers')->group(function () {
        Route::get('/{id}', [CustomerController::class, 'getCustomerById']);
        Route::get('/{id}/addresses', [CustomerController::class, 'getAddressesByCustomerId']);
        Route::get('/{id}/wishlist/products', [WishlistController::class, 'getProducts']);
        Route::put('/{id}', [CustomerController::class, 'updateCustomer']);
        Route::delete('/{id}', [CustomerController::class, 'deleteCustomer']);
    });

    Route::prefix('addresses')->group(function () {
        Route::get('/{id}', [AddressController::class, 'getAddressById']);
        Route::post('/', [AddressController::class, 'createAddress']);
        Route::put('/{id}', [AddressController::class, 'updateAddress']);
        Route::delete('/{id}', [AddressController::class, 'deleteAddress']);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/{id}', [OrderController::class, 'getOrderById']);
        Route::get('/{id}/order-items', [OrderController::class, 'getOrderItemsByOrderId']);
        Route::post('/', [OrderController::class, 'createOrder']);
        Route::put('/{id}', [OrderController::class, 'updateOrder']);
        Route::put('/{id}/cancel', [OrderController::class, 'cancelOrder']);
    });

    Route::prefix('order-items')->group(function () {
        Route::get('/{id}', [OrderItemController::class, 'getOrderItemById']);
        Route::post('/', [OrderItemController::class, 'createOrderItem']);
        Route::put('/{id}/order-items/{orderItemId}', [OrderItemController::class, 'updateOrderItem']);
        Route::delete('/{id}/order-items/{orderItemId}', [OrderItemController::class, 'deleteOrderItem']);
    });

    Route::prefix('wishlists')->group(function () {
        Route::get('/{id}', [WishlistController::class, 'getWishlistById']);
        Route::post('/', [WishlistController::class, 'createWishlist']);
        Route::put('/{id}', [WishlistController::class, 'updateWishlist']);
        Route::delete('/{id}', [WishlistController::class, 'deleteWishlist']);
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Backoffice) - Only Admin Can Access
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'getAllCustomers']);
    });

    Route::prefix('addresses')->group(function () {
        Route::get('/', [AddressController::class, 'getAllAddresses']);
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'getAllRoles']);
        Route::get('/{id}', [RoleController::class, 'getRoleById']);
        Route::post('/', [RoleController::class, 'createRole']);
        Route::put('/{id}', [RoleController::class, 'updateRole']);
        Route::delete('/{id}', [RoleController::class, 'deleteRole']);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'getAllOrders']);
    });

    Route::prefix('brands')->group(function () {
        Route::post('', [BrandController::class, 'createBrand']);
        Route::put('/{id}', [BrandController::class, 'updateBrand']);
        Route::delete('/{id}', [BrandController::class, 'deleteBrand']);
    });

    Route::prefix('brand-coupons')->group(function () {
        Route::post('/', [BrandCouponController::class, 'createBrandCoupon']);
        Route::put('/{id}', [BrandCouponController::class, 'updateBrandCoupon']);
        Route::delete('/{id}', [BrandCouponController::class, 'deleteBrandCoupon']);
    });

    Route::prefix('brand-languages')->group(function () {
        Route::post('/', [BrandLanguageController::class, 'createBrandLanguage']);
        Route::put('/{id}', [BrandLanguageController::class, 'updateBrandLanguage']);
        Route::delete('/{id}', [BrandLanguageController::class, 'deleteBrandLanguage']);
    });

    Route::prefix('categories')->group(function () {
        Route::post('/', [CategoryController::class, 'createCategory']);
        Route::put('/{id}', [CategoryController::class, 'updateCategory']);
        Route::delete('/{id}', [CategoryController::class, 'deleteCategory']);
    });

    Route::prefix('category-coupons')->group(function () {
        Route::post('/', [CategoryCouponController::class, 'createCategoryCoupon']);
        Route::put('/{id}', [CategoryCouponController::class, 'updateCategoryCoupon']);
        Route::delete('/{id}', [CategoryCouponController::class, 'deleteCategoryCoupon']);
    });

    Route::prefix('category-languages')->group(function () {
        Route::post('/', [CategoryLanguageController::class, 'createCategoryLanguage']);
        Route::put('/{id}', [CategoryLanguageController::class, 'updateCategoryLanguage']);
        Route::delete('/{id}', [CategoryLanguageController::class, 'deleteCategoryLanguage']);
    });

    Route::prefix('category-media')->group(function () {
        Route::post('/', [CategoryMediaController::class, 'createCategoryMedia']);
        Route::put('/{id}', [CategoryMediaController::class, 'updateCategoryMedia']);
        Route::delete('/{id}', [CategoryMediaController::class, 'deleteCategoryMedia']);
    });

    Route::prefix('coupons')->group(function () {
        Route::post('/', [CouponController::class, 'createCoupon']);
        Route::put('/{id}', [CouponController::class, 'updateCoupon']);
        Route::delete('/{id}', [CouponController::class, 'deleteCoupon']);
    });

    Route::prefix('languages')->group(function () {
        Route::post('/', [LanguageController::class, 'createLanguage']);
        Route::put('/{id}', [LanguageController::class, 'updateLanguage']);
        Route::delete('/{id}', [LanguageController::class, 'deleteLanguage']);
    });

    Route::prefix('order-items')->group(function () {
        Route::get('/', [OrderItemController::class, 'getAllOrderItems']);
    });

    Route::prefix('products')->group(function () {
        Route::post('/', [ProductController::class, 'createProduct']);
        Route::put('/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
    });

    Route::prefix('product-coupons')->group(function () {
        Route::post('/', [ProductCouponController::class, 'createProductCoupon']);
        Route::put('/{id}', [ProductCouponController::class, 'updateProductCoupon']);
        Route::delete('/{id}', [ProductCouponController::class, 'deleteProductCoupon']);
    });

    Route::prefix('product-languages')->group(function () {
        Route::post('/', [ProductLanguageController::class, 'createProductLanguage']);
        Route::put('/{id}', [ProductLanguageController::class, 'updateProductLanguage']);
        Route::delete('/{id}', [ProductLanguageController::class, 'deleteProductLanguage']);
    });

    Route::prefix('product-media')->group(function () {
        Route::post('/', [ProductMediaController::class, 'createProductMedia']);
        Route::put('/{id}', [ProductMediaController::class, 'updateProductMedia']);
        Route::delete('/{id}', [ProductMediaController::class, 'deleteProductMedia']);
    });

    Route::prefix('product-sizes')->group(function () {
        Route::post('/', [ProductSizeController::class, 'createProductSize']);
        Route::put('/{id}', [ProductSizeController::class, 'updateProductSize']);
        Route::delete('/{id}', [ProductSizeController::class, 'deleteProductSize']);
    });

    Route::prefix('product-stock')->group(function () {
        Route::post('/', [ProductStockController::class, 'createProductStock']);
        Route::put('/{id}', [ProductStockController::class, 'updateProductStock']);
        Route::delete('/{id}', [ProductStockController::class, 'deleteProductStock']);
    });

    Route::prefix('wishlists')->group(function () {
        Route::get('/', [WishlistController::class, 'getAllWishlists']);
    });
});
