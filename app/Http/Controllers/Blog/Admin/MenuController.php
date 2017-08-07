<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/23
 * Time: 19:20
 */

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCreateRequest;
use App\Models\Menus;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menus::all();
        return view('blog.admin.menu-index', compact('menus'));
    }

    public function create()
    {
        return view('blog.admin.menu-create');
    }

    public function store(MenuCreateRequest $request)
    {
        $data = $request->except('_token');
        Menus::create($data);
        return redirect('admin/menu/index')->with('message', '新建成功');
    }

    public function edit($id)
    {
        $menu = Menus::find($id);
        return view('blog.admin.menu-edit', compact('menu'));
    }

    public function update(MenuCreateRequest $request, $id)
    {
        $data = $request->except('_token');
        Menus::where('id', $id)->update($data);
        return redirect('admin/menu/index')->with('message', '修改成功');
    }

    public function delete($id)
    {
        $menu = Menus::find($id);
        $menu->delete();
        return redirect('admin/menu/index')->with('message', '新建成功');
    }
}