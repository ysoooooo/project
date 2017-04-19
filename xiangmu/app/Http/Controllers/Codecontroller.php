<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Codecontroller extends Controller
{
    public function index()
    {
        //生成验证码图片的Builder对象，配置相应属性
          $builder = new CaptchaBuilder;
          //可以设置图片宽高及字体
          $builder->build($width = 160, $height = 40, $font = null);
          //获取验证码的内容
          $phrase = $builder->getPhrase();

          //把内容存入session
          // Session::flash('milkcaptcha', $phrase);
          session(['code'=>$phrase]);
          //生成图片
          header("Cache-Control: no-cache, must-revalidate");
          header('Content-Type: image/jpeg');
          $builder->output();
          }
    }



