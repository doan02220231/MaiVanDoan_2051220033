<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CategoryPost;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryControler;
use App\Http\Controllers\SendmailController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::post('/save-cart-thue', [\App\Http\Controllers\CartPetController::class, 'save_cart_thue']);
// Route::post('/calculate-price', [\App\Http\Controllers\CartPetController::class, 'calculatePrice']);
// Route::get('/delete-thue/{session_id_thue}', [\App\Http\Controllers\CartPetController::class, 'delete_thue']);
// Route::post('/update-cart-thue', [\App\Http\Controllers\CartPetController::class, 'update_cart_thue']);
Route::post('/save-rating-thue', [\App\Http\Controllers\CheckoutThueController::class, 'saveRatingThue']);
Route::post('/update-pet-status', [\App\Http\Controllers\CheckoutThueController::class, 'update_tinh_trang']);
Route::get('/delete-combo/{session_id_combo}', [\App\Http\Controllers\CartPetController::class, 'delete_combo']);
Route::post('/add-to-cart-combo', [\App\Http\Controllers\CartPetController::class, 'add_to_cart_combo']);
// Route::get('/gio-hang-thue', [\App\Http\Controllers\CartPetController::class, 'gio_hang_thue']);
//// Combo thuê pet
// Route::get('/san-pham-combo/', [\App\Http\Controllers\petController::class, 'show_combo']);
Route::get('/add-combo', [\App\Http\Controllers\PetController::class, 'add_combo']);
Route::post('/update-combo/{combo_id}', [\App\Http\Controllers\petController::class, 'update_combo']);
Route::get('/edit-combo/{combo_id}', [\App\Http\Controllers\petController::class, 'edit_combo']);
Route::get('/delete-combo/{combo_id}', [\App\Http\Controllers\PetController::class, 'del_combo']);
Route::get('/unactive-combo/{combo_id}', [\App\Http\Controllers\petController::class, 'unactive_combo']);
Route::get('/active-combo/{combo_id}', [\App\Http\Controllers\petController::class, 'active_combo']);
Route::get('/all-combo', [\App\Http\Controllers\PetController::class, 'all_combo']);
Route::post('/save-combo', [\App\Http\Controllers\PetController::class, 'save_combo']);
// add-pet-gallery select-pet-gallery
Route::get('/add-pet-gallery/{pet_id}', [\App\Http\Controllers\GalleryControler::class, 'add_pet_gallery']);
Route::post('/select-pet-gallery', [\App\Http\Controllers\GalleryControler::class, 'select_pet_gallery']);
Route::post('/insert-pet-gallery/{pro_id}', [\App\Http\Controllers\GalleryControler::class, 'insert_pet_gallery']);
Route::post('/quickview-thue', [\App\Http\Controllers\PetController::class,'quickview']);

//////// cart 
Route::post('/update-mua-ban', [\App\Http\Controllers\CartPetController::class, 'update_mua_ban']);
Route::post('/update-suc-khoe', [\App\Http\Controllers\CartPetController::class, 'update_suc_khoe']);
/// Check out Thuee
Route::get('/checkout-thue', [\App\Http\Controllers\CheckoutThueController::class, 'checkout_thue']);
Route::post('/conform-order-thue', [\App\Http\Controllers\CheckoutThueController::class, 'conform_order_thue']);
Route::get('/history-thue', [\App\Http\Controllers\CheckoutThueController::class, 'history_thue']);
Route::get('/view-history-order-thue/{order_thue_code}', [\App\Http\Controllers\CheckoutThueController::class, 'view_history_order_thue']);

Route::get('/manage-order-thue', [\App\Http\Controllers\CheckoutThueController::class, 'manage_order_thue']);
Route::get('/view-order-thue/{order_thue_code}', [\App\Http\Controllers\CheckoutThueController::class,'view_order_thue']);
Route::post('/update-tinh-trang', [\App\Http\Controllers\CheckoutThueController::class, 'update_tinh_trang']);
// Frontend
Route::get('/',[HomeController::class,'index']);
Route::get('/trang-chu', [HomeController::class,'index']);
Route::post('/tim-kiem', [HomeController::class,'search']);
Route::post('/autocomplete-ajax', [HomeController::class,'autocomplete_ajax']);

//Liên hệ trang 
Route::get('/lien-he',[ContactController::class,'lien_he']);
Route::get('/information',[ContactController::class,'information']);
Route::post('/save-info/{}',[ContactController::class,'save_info']);
Route::post('/update-info/{info_id}',[ContactController::class,'update_info']);

//danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{slug_category_product}', [CategoryProduct::class,'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_slug}', [BrandProduct::class,'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_slug}', [ProductController::class,'details_product']);
Route::get('/tags-t/{product_tag}', [ProductController::class,'tags_t']);
Route::post('/quickview', [ProductController::class,'quickview']);
//bình luận
Route::post('/load-comment', [ProductController::class,'load_comment']);
Route::post('/send-comment', [ProductController::class,'send_comment']);
Route::get('/comment', [ProductController::class,'list_comment']);
Route::post('/allow-comment', [ProductController::class,'allow_comment']);
Route::post('/reply-comment', [ProductController::class,'reply_comment']);
Route::post('/insert-rating', [ProductController::class,'insert_rating']);


//Backend
Route::get('/admin', [AdminController::class,'index']);
Route::get('/dashboard', [AdminController::class,'show_dashboard']);
Route::get('/logout', [AdminController::class,'logout']);
Route::post('/admin-dashboard', [AdminController::class,'dashboard']);
Route::post('/filter-by-date', [AdminController::class,'filter_by_date']);
Route::post('/dashboard-filter', [AdminController::class,'dashboard_filter']);
Route::post('/days-order', [AdminController::class,'days_order']);
//login-customer-google
Route::get('/login-customer-google', [AdminController::class,'login_customer_google']);

/////// cart add-to-cart-thue
Route::post('/save-cart-thue', [\App\Http\Controllers\CartPetController::class, 'save_cart_thue']);
Route::post('/calculate-price', [\App\Http\Controllers\CartPetController::class, 'calculatePrice']);
Route::get('/delete-thue/{session_id_thue}', [\App\Http\Controllers\CartPetController::class, 'delete_thue']);
Route::post('/update-cart-thue', [\App\Http\Controllers\CartPetController::class, 'update_cart_thue']);
Route::post('/add-to-cart-thue', [\App\Http\Controllers\CartPetController::class, 'add_cart_ajax_thue']);
Route::get('/gio-hang-thue', [\App\Http\Controllers\CartPetController::class, 'gio_hang_thue']);
//// Thue PET

Route::get('/del-pet', [\App\Http\Controllers\CartPetController::class, 'del_pet']);
Route::post('/update-qty-thue', [\App\Http\Controllers\CartPetController::class, 'update_qty_thue']);
Route::get('/add-pet', [\App\Http\Controllers\PetController::class, 'add_pet']);
Route::get('/all-pet', [\App\Http\Controllers\PetController::class, 'all_pet']);
Route::post('/save-pet', [\App\Http\Controllers\PetController::class, 'save_pet']);

Route::get('/edit-pet/{pet_id}', [\App\Http\Controllers\petController::class, 'edit_pet']);
Route::get('/delete-pet/{pet_id}', [\App\Http\Controllers\petController::class, 'delete_pet']);
Route::get('/unactive-pet/{pet_id}', [\App\Http\Controllers\petController::class, 'unactive_pet']);
Route::get('/active-pet/{pet_id}', [\App\Http\Controllers\petController::class, 'active_pet']);
Route::post('/update-pet/{pet_id}', [\App\Http\Controllers\petController::class, 'update_pet']);
Route::get('/san-pham-thue/', [\App\Http\Controllers\petController::class, 'show_product_thue']);
Route::get('/chi-tiet-thue/{pet_id}', [\App\Http\Controllers\petController::class, 'show_details_thue']);
// Route::get('/san-pham-thue/', [PetController::class,'show_product_thue']);
// routes/web.php

Route::post('/calculate-price', [App\Http\Controllers\PetController::class, 'calculatePrice'])->name('calculate.price');
Route::post('/check-coupon-thue', [\App\Http\Controllers\petController::class, 'check_coupon_thue']);
Route::post('/apply-coupon', [PetController::class, 'applyCoupon'])->name('apply.coupon');


//category product
Route::get('/add-category-product', [CategoryProduct::class,'add_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class,'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class,'delete_category_product']);
Route::get('/all-category-product', [CategoryProduct::class,'all_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class,'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class,'active_category_product']);

Route::post('/save-category-product', [CategoryProduct::class,'save_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class,'update_category_product']);
//prodcut_tag
Route::post('/product-tabs', [CategoryProduct::class,'product_tabs']);

//send Mail
Route::get('/send-mail', [SendmailController::class,'send_mail']);
Route::get('/send-coupon-vip/{coupon_code}', [SendmailController::class,'send_coupon_vip']);
Route::get('/send-coupon/{coupon_code}', [SendmailController::class,'send_coupon']);
Route::get('/mail-exemple', [SendmailController::class,'mail_exemple']);
Route::get('/quen-mat-khau', [SendmailController::class,'quen_mat_khau']);
Route::get('/update-new-pass', [SendmailController::class,'update_new_pass']);
Route::post('/revover-pass', [SendmailController::class,'revover_pass']);
Route::post('/reset-new-pass', [SendmailController::class,'reset_new_pass']);


//brand product
Route::get('/add-brand-product', [BrandProduct::class,'add_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class,'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class,'delete_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class,'all_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class,'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class,'active_brand_product']);

Route::post('/save-brand-product', [BrandProduct::class,'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class,'update_brand_product']);

//product
Route::get('/add-product', [ProductController::class,'add_product']);
Route::get('/edit-product/{product_id}', [ProductController::class,'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class,'delete_product']);
Route::get('/all-product', [ProductController::class,'all_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class,'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class,'active_product']);

Route::post('/save-product', [ProductController::class,'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class,'update_product']);

//coupon-product
Route::post('/check-coupon', [CartController::class,'check_coupon']);
Route::get('/unset-coupon', [CouponController::class,'unset_coupon']);
//coupon-admin
Route::get('/insert-coupon', [CouponController::class,'insert_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class,'delete_coupon']);
Route::get('/list-coupon', [CouponController::class,'list_coupon']);
Route::post('/insert-coupon-code', [CouponController::class,'insert_coupon_code']);
Route::get('/edit-coupon/{coupon_id}', [CouponController::class,'edit_coupon']);
Route::post('/update-coupon-code/{coupon_id}', [CouponController::class,'update_coupon_code']);

//cart
Route::post('/save-cart', [CartController::class,'save_cart']);
Route::post('/add-cart-ajax', [CartController::class,'add_cart_ajax']);
Route::post('/update-cart', [CartController::class,'update_cart']);
Route::get('/gio-hang', [CartController::class,'gio_hang']);
Route::get('/del-product/{session_id}',[CartController::class,'del_product']);
Route::get('/del-all-product',[CartController::class,'del_all_product']);

//Delivery
Route::get('/delivery', [DeliveryController::class,'delivery']);
Route::post('/select-delivery', [DeliveryController::class,'select_delivery']);
Route::post('/insert-delivery', [DeliveryController::class,'insert_delivery']);
Route::post('/select-feeship', [DeliveryController::class,'select_feeship']);
Route::post('/update-delivery', [DeliveryController::class,'update_delivery']);

//checkout

Route::post('/conform-order', [CheckoutController::class,'conform_order']);
Route::get('/login-checkout', [CheckoutController::class,'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class,'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class,'add_customer']);
Route::post('/login-customer', [CheckoutController::class,'login_customer']);
Route::get('/checkout', [CheckoutController::class,'checkout']);
// Route::get('/payment', [CheckoutController::class,'payment']);
// Route::post('/save-checkout-customer', [CheckoutController::class,'save_checkout_customer']);
Route::post('/calculate-fee', [CheckoutController::class,'calculate_fee']);
Route::get('/del-fee', [CheckoutController::class,'del_fee']);
Route::post('/select-delivery-home', [CheckoutController::class,'select_delivery_home']);
//cổng thanh toán
Route::post('/vnpay-payment', [CheckoutController::class,'vnpay_payment']);
Route::post('/momo-payment', [CheckoutController::class,'momo_payment']);
//Order
Route::get('/history', [OrderController::class,'history']);
Route::get('/view-history-order/{order_code}', [OrderController::class,'view_history_order']);
Route::get('/manage-order', [OrderController::class,'manage_order']);
Route::get('/view-order/{order_code}', [OrderController::class,'view_order']);
Route::get('/print-order/{checkout_code}', [OrderController::class,'print_order']);
Route::post('/update-order-qty', [OrderController::class,'update_order_qty']);
Route::post('/update-qty', [OrderController::class,'update_qty']);

//banner
Route::get('/manage-slider', [SliderController::class,'manage_slider']);
Route::get('/add-slider', [SliderController::class,'add_slider']);
Route::post('/insert-slider', [SliderController::class,'insert_slider']);
Route::get('/unactive-slider/{slide_id}', [SliderController::class,'unactive_slider']);
Route::get('/inctive-slider/{slide_id}', [SliderController::class,'active_slider']);
Route::get('/delete-slider/{slide_id}', [SliderController::class,'delete_slider']);
Route::get('/edit-slider/{slide_id}', [SliderController::class,'edit_slider']);
Route::post('/update-slider/{slide_id}', [SliderController::class,'update_slider']);

//category post
Route::get('/edit-category-post/{category_post_id}', [CategoryPost::class,'edit_category_post']);

Route::get('/add-category-post', [CategoryPost::class,'add_category_post']);
Route::get('/all-category-post', [CategoryPost::class,'all_category_post']);
Route::post('/save-category-post', [CategoryPost::class,'save_category_post']);
Route::post('/update-category-post/{post_id}', [CategoryPost::class,'update_category_post']);
Route::get('/delete-category-post/{post_id}', [CategoryPost::class,'delete_category_post']);
//Ẩn hiện category  post
Route::get('/unactive-category-post/{category_post_id}', [CategoryPost::class,'unactive_category_post']);
Route::get('/active-category-post/{category_post_id}', [CategoryPost::class,'active_category_post']);

//post
Route::get('/add-post', [PostController::class,'add_post']);
Route::get('/all-post', [PostController::class,'all_post']);
Route::post('/save-post', [PostController::class,'save_post']);
Route::get('/delete-post/{post_id}', [PostController::class,'delete_post']);
Route::get('/edit-post/{post_id}', [PostController::class,'edit_post']);
Route::post('/update-post/{post_id}', [PostController::class,'update_post']);
//bài viết
Route::get('/danh-muc-bai-viet/{post_slug}', [PostController::class,'danh_muc_bai_viet']);
Route::get('/bai-viet/{post_slug}', [PostController::class,'bai_viet']);
//Ẩn hiện  post
Route::get('/unactive-post/{post_id}', [PostController::class,'unactive_post']);
Route::get('/active-post/{post_id}', [PostController::class,'active_post']);

//gallery
Route::get('/add-gallery/{product_id}', [GalleryControler::class,'add_gallery']);
Route::post('/select-gallery', [GalleryControler::class,'select_gallery']);
Route::post('/insert-gallery/{pro_id}', [GalleryControler::class,'insert_gallery']);
Route::post('/update-gallery-name', [GalleryControler::class,'update_gallery_name']);
Route::post('/delet-gallery', [GalleryControler::class,'delet_gallery']);
Route::post('/update-gallery-image', [GalleryControler::class,'update_gallery_image']);



