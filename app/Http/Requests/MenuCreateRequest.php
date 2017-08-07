<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuCreateRequest extends FormRequest
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
            'name' => 'required',
            'type' => 'required',
            'path' => 'required',
            'sort' => 'required',
            'active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请填写菜单名称',
            'type.required' => '请选择菜单分类',
            'path.required' => '请填写菜单路径',
            'sort.required' => '请填写菜单排序',
            'active.required' => '请选择是否激活',
        ];
    }
}
