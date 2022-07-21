<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompleteUserInfo;
use App\Http\Controllers\messageController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\postController;
use App\Http\Controllers\productController;
use App\Http\Controllers\commentController;
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout',[AuthController::class,'logout']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//***************for posts**************************
Route::get('post/{userEmail}', [postController::class, 'index']);
Route::post('/edit-post-reactions-like/{id}', [postController::class,'editLike']);
Route::post('/edit-post-reactions-dislike/{id}', [postController::class,'editDisLike']);
Route::post('/add-likePost', [postController::class,'saveLikedPost']);
Route::post('removeLike/{id}/{userEmail}', [postController::class, 'removeLike']);
Route::post('/add-dislikePost', [postController::class,'saveDislikedPost']);
Route::post('removeDislike/{id}/{userEmail}', [postController::class, 'removeDislike']);
//***************************for complete CompanyInformation**************************************** */
Route::post('completeCompantRegister', [CompanyController::class, 'addCpmpanyInfo']);
Route::get('getCompanyInfo/{CompanyEmail}', [CompanyController::class, 'getCompanyInfo']);
Route::get('getCompanyCategory/{Industry}', [CompanyController::class, 'getCompanyCategory']);
Route::get('getCompanyPage/{CompanyId}', [CompanyController::class, 'getCompanyPage']);
Route::get('productPage/{CompanyId}/{Productid}/{userName}', [CompanyController::class, 'productPage']);
/**************************** Change Password and City**************************** */
Route::post('ChangePassword', [CompanyController::class, 'ChangePassword']);
Route::post('ChangeLocation', [CompanyController::class, 'ChangeLocation']);
Route::get('getUserInfo/{userEmail}', [CompanyController::class, 'getUserInfo']);
/* ***************For User ************** */
Route::post('/UpdatePhotoUser/{userEmail}', [CompleteUserInfo::class,'UpdateUserPhoto']);
Route::post('/UpdateUserPhotoInPosts/{userEmail}', [CompleteUserInfo::class,'UpdateUserPhotoInPosts']);
/************************************Dashboard Company *************************************************************** */
Route::post('addPost', [postController::class, 'addPost']);
Route::post('addProduct', [productController::class, 'addProduct']);
Route::get('getProducts/{CompanyEmail}', [productController::class, 'getProducts']);
Route::post('UpdateCumpanyInfo/{CompanyId}', [productController::class, 'UpdateCumpanyInfo']);
Route::get('getpostDashbard/{CompanyEmail}', [postController::class, 'postDashbard']);
Route::get('productInformation/{Productid}', [CompanyController::class, 'productInformation']);
Route::post('UpdateproductInformation/{Productid}', [CompanyController::class, 'UpdateproductInformation']);
Route::delete('deleteProduct/{Productid}', [CompanyController::class, 'deleteProduct']);
Route::get('getPostForUpdate/{postId}', [postController::class, 'getPostForUpdate']);
Route::post('UpdateAddvertismentInformation/{postId}', [postController::class, 'UpdateAddvertismentInformation']);
Route::delete('deleteAddvertisment/{Postid}', [CompanyController::class, 'deleteAddvertisment']);
/****************************Messages******************************** */
Route::get('messages/{fromId}/{toId}', [messageController::class, 'index']);
Route::get('IsReadMessage/{fromId}/{toId}', [messageController::class, 'IsReadMessage']);
Route::get('messagesList/{toId}', [messageController::class, 'indexlist']);
Route::get('messagesList2/{fromEmail}', [messageController::class, 'indexlist2']);
Route::post('sendMessage', [messageController::class, 'sendMessage']);
Route::get('listCompany', [messageController::class, 'listCompany']);
Route::get('listCompany', [messageController::class, 'listCompany']);
Route::get('getUserPhoto/{useremail}', [messageController::class, 'getUserPhoto']);
/******************************testing************************************ */
Route::post('test', [messageController::class, 'test']);
/******************************For Orders************************ */
Route::post('insertTheOrder',[ordersController::class,'insert']);
Route::delete('deleteOrder/{userName}/{productId}',[ordersController::class,'deleteOrder']);
Route::delete('deleteOrderInTable/{id}',[ordersController::class,'deleteOrderInTable']);
Route::get('getDashBoardOrders/{companyEmail}',[ordersController::class,'getDashBoardOrders']);
Route::get('getOrdersForUser/{UserEmail}',[ordersController::class,'getOrdersForUser']);
Route::post('UpdateStatus',[ordersController::class,'UpdateStatus']);
/*******************************for Theme************************************ */
Route::post('/UpdateTheme/{id}', [CompleteUserInfo::class,'UpdateTheme']);
/********************************For Comment***************************************** */
Route::post('insertComment/{postId}',[commentController::class,'addComment']);
Route::get('getComments/{postId}',[commentController::class,'getComments']);
