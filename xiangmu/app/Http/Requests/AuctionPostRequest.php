<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AuctionPostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:30',
            'dprice' => 'required',
            'keyword' => 'required',
            'stime' => 'required',
            'ltime' => 'required',
            'pic[]' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.max' => '标题不能超过10个字',
            'dprice.required' => '密码不能为空',
            'keyword.required' => '拍卖摘要不能为空',
            'stime.required' => '请输入正确的拍卖时间',
            'ltime.required' => '请输入正确的结束时间',
            'pic[].required' => '图片不能为空',
        ];
    }
}
