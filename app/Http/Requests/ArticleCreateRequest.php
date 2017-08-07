<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest
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
            'title' => 'required',
            'category_id' => 'required',
            'desc'  => 'required',
            'tags' => 'required',
            'cover' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题必须填写',
            'category_id.required' => '请选择分类',
            'desc.required' => '描述必须填写',
            'tags.required' => '标签必须填写',
            'cover.required' => '封面图必须上传',
            'content.required' => '内容必须填写',
        ];
    }

    public function articleData()
    {
        return [
            'title' => $this->get('title'),
            'category_id'  => $this->get('category_id'),
            'desc'  => $this->get('desc'),
            'content' => $this->get('editormd_id-html-code'),
            'markdown_content' => $this->get('content'),
            'user_id' => $this->user()->id,
            'votes' => 0,
        ];
    }
}
