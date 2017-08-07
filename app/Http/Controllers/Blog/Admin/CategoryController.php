<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/23
 * Time: 18:57
 */

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\CateCreateRequest;
use App\Models\Category;
use App\Models\Menus;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('blog.admin.cate-index', compact('categories'));
    }

    public function create()
    {
        return view('blog.admin.cate-create');
    }

    public function store(CateCreateRequest $request)
    {
        $data = $request->except('_token');
        $category = Category::create($data);
        Menus::create([
            'name' => $category->name,
            'type' => 'category',
            'path' => 'category',
            'sort' => Menus::max('sort') + 1,
            'param' => $category->id,
            'active' => 0,
        ]);
        return redirect()->to('admin/cate/index')->with('message', '新建成功');
    }

    public function edit($id)
    {
        $cate = Category::find($id);
        return view('blog.admin.cate-edit', compact('cate'));
    }
    public function update(CateCreateRequest $request, $id)
    {
        $data = $request->except('_token');
        $category = Category::find($id);
        $menu = Menus::where('name', $category->name)->where('type', 'category')->first();
        if ($menu) {
            $menu->update($data);
        }
        $category->update($data);
        return redirect()->to('admin/cate/index')->with('message', '修改成功');
    }

    public function delete($id)
    {
        $cate = Category::find($id);
        $menu = Menus::where('name', $cate->name)->where('type', 'category')->first();
        if ($menu) {
            $menu->delete();
        }
        $cate->delete();
        return redirect()->to('admin/cate/index')->with('message', '删除成功');
    }
}