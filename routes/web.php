<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => ''], function () {
    Route::get('/', 'PageController@loginPage')->name('loginPage');
    Route::get('register', 'PageController@register')->name('register');
    Route::get('forget-password', 'PageController@forgetPassword')->name('forgetPasswordPage');
    Route::post('/create', 'UserController@register')->name('create');
    Route::post('postlogin', 'UserController@login')->name('login');
    Route::get('reset-password/{token}', 'PageController@resetPasswordPage')->name('resetPasswordPage');
    Route::post('reset', 'UserController@resetPassword')->name('resetPassword');
    Route::post('forget', 'UserController@forgetPassword')->name('forgetPassword');
    Route::get('logout', 'UserController@logout')->name('logout');

});

Route::group(['prefix' => 'user', 'middleware' => ['user']], function () {
    Route::get('', 'Main\PageController@dashboard')->name('dashboard');
    Route::get('profile/{username}', 'Main\PageController@profile')->name('profile');
    Route::get('people', 'Main\PageController@users')->name('people');
    Route::get('add/{id}', 'FriendController@friendRequest')->name('addRequest');
    Route::get('accept/{username}', 'FriendController@getAccept')->name('acceptRequest');
    Route::get('decline/{username}', 'FriendController@declineRequest')->name('declineRequest');
    Route::get('deletepost/{postId}', 'PostController@deletePost')->name('delete.post');
    Route::get('deletecomment/{commentId}', 'CommentController@deleteComment')->name('delete.comment');
    Route::get('delete/reply/{commentId}', 'CommentController@deleteReply')->name('delete.reply');
    Route::get('like/{postId}', 'PostController@getlikes')->name('post.like');
    Route::get('usersetting', 'Main\PageController@userSetting')->name('userSetting');
    Route::get('message', 'Main\PageController@messaging')->name('message.chat');
    Route::get('post/{id}','Main\PageController@singlePost')->name('singlePost');
    Route::post('add', 'FriendController@friendRequest')->name('friendRequest');
    Route::post('createpost', 'PostController@createPost')->name('createPost');
    Route::post('createpost/image', 'PostController@createPostImage')->name('postImage');
    Route::post('delete/{username}', 'FriendController@deleteFriend')->name('deleteFriend');
    Route::post('editpost/{postId}', 'PostController@editPost')->name('edit.post');
    Route::post('comment/create/{post}', 'CommentController@addPostComment')->name('comment.post');
    Route::post('edit/comment/{comment}', 'CommentController@editComment')->name('edit.comment');
    Route::post('reply/comment/{comment}', 'CommentController@replyComment')->name('reply.comment');
    Route::post('edit/reply/{commentId}', 'CommentController@editReply')->name('edit.reply');
    Route::post('user/changepassword', 'UserController@changePassword')->name('changePassword');
    Route::get('like/{commentId}', 'CommentController@getlikes')->name('comment.like');


    Route::get('/contacts' , 'ChatController@getAllContact');
});


Route::get('/search', 'SearchController@getResults')->name('search.result');

Route::get('/test',function(){
    $notifications=auth()->user()->unreadNotifications;
    foreach($notifications as $notification){
        dd($notification->data['user']['name']);
    }
});
Route::get('/markAsRead', function () { 
    auth()->user()->unreadNotifications->markAsRead();
});
