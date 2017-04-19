<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// 网站根
Route::get('/','IndexController@index');



//前台用户注册
	Route::get('/Home/User/register','Home\UserController@register');
	Route::post('/Home/User/register','Home\UserController@register');
//前台注册ajax验证
	Route::post('/Home/User/ajax','Home\UserController@ajax');
//前台用户密码找回
	Route::controller('/Home/Retrieve','Home\RetrieveController');
//前台用户登录
	Route::post('/Home/User/login','Home\UserController@login');



// 用户个人中心
	Route::controller('/Home/User','Home\UserController');
// 前台关于用户鱼塘的路由 
    Route::controller('/Home/Fish','Home\FishController');
//前台商品
    Route::controller('/Home/Goods','Home\GoodsController');
//前台关于拍卖的路由
	Route::controller('/Home/Auction','Home\AuctionController');
//前台商品的留言信息
	Route::controller('/Home/Talk','Home\TalkController'); 
// 前台关于塘主管理鱼塘的路由
	Route::controller('/Home/Control','Home\ControlController');
// 前台关于消息通知的路由	 
    Route::controller('/Home/Tongzhi','Home\TongzhiController');
// 前台拍卖搜索
    Route::controller('/Home/Sousuo','Home\SousuoController');     




//后台用户登录界面
	Route::get('/Admin/User/login','Admin\UserController@login');
//后台用户提交登录
	Route::post('/Admin/User/login','Admin\UserController@login');
// 后台验证码
	Route::get('/code', 'Codecontroller@index');
//后台管理(经过中间件 session中id 和权限判断)开始
	Route::group(['middleware' => 'login'],function(){
		//后台首页 开始
			Route::controller('/Admin/parent','Admin\ParentController');
		//后台首页 结束

	    //后台用户管理 开始 
       		Route::controller('/Admin/User','Admin\UserController');
	    //后台用户管理 结束

        //后台商品分类管理 开始
			Route::any('/Admin/Cate/add','Admin\CateController@add');
			Route::get('/Admin/Cate/index','Admin\CateController@index');
			Route::post('/Admin/Cate/delete','Admin\CateController@delete');
			Route::post('/Admin/Cate/edit','Admin\CateController@edit');
        //后台商品分类管理 结束
        
        //后台商品管理 开始
       		Route::controller('/Admin/Goods','Admin\GoodsController');
        //后台商品管理 结束
       	
       	//后台 前台消息管理  
       		Route::controller('/Admin/Tongzhi','Admin\TongzhiController');

       	// 后台 前台轮播图管理
			Route::controller('/Admin/Lunbo','Admin\LunboController');

		//后台 前台友情链接
			Route::controller('/Admin/Friendlink','Admin\FriendlinkController');

		//后台 前台网站配置
			Route::controller('/Admin/Config','Admin\ConfigController');

		//后台鱼塘管理 开始 
       		Route::controller('/Admin/Yutang','Admin\YutangController');
	    //后台鱼塘管理 结束

       	//后台 拍卖物品管理 开始
			Route::controller('/Admin/Sale','Admin\SaleController');	
		//后台 拍卖物品管理 结束

		//后台 广告管理 开始
			Route::controller('/Admin/Ad','Admin\AdController');
		//后台 广告管理 结束

		//后台商品评论管理 开始  
       		Route::controller('/Admin/TalkGoods','Admin\TalkGoodsController');
       	//后台商品评论管理 结束 

       	//后台 前台订单管理 开始
			Route::controller('/Admin/Order','Admin\OrderController');
       	//后台 前台订单管理 结束
			
	});
//后台管理(经过中间件 session中id 和权限判断)结束





   











