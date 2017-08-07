<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/23
 * Time: 19:17
 */

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menus;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function menu()
    {
        $menus = Menus::select(['id', 'name', 'type', 'path', 'param', 'active'])->get();
        return response()->json([
            'status' => true,
            'result' => $menus,
        ]);
    }

    public function lists(Request $request)
    {
        $category_id = $request->get('category_id');
        $builder = Article::with(['category', 'user', 'tags']);
        if ($category_id) {
            $builder = $builder->where('category_id', $category_id);
        }
        $articles = $builder->paginate(2);
        return response()->json([
            'status' => true,
            'result' => $articles,
        ]);
    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        $article = Article::with(['category', 'user', 'tags'])->find($id);
        return response()->json([
            'status' => true,
            'result' => $article,
        ]);
    }
}