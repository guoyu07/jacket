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
use App\Models\Link;
use App\Models\Menus;
use App\Models\Tag;
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

    public function recommend()
    {
        $articles = Article::where('is_recommend', 1)
            ->orderBy('id', 'desc')
            ->select(['title','id', 'votes'])
            ->take(5)
            ->get();
        return response()->json([
            'status' => true,
            'result' => $articles,
        ]);
    }

    public function popularity()
    {
        $articles = Article::orderBy('votes', 'desc')
            ->select(['title','id', 'votes'])
            ->take(5)
            ->get();
        return response()->json([
            'status' => true,
            'result' => $articles,
        ]);
    }

    public function tags()
    {
        $tags = Tag::with('articles')->get();
        $tags->each(function ($item) {
            $item->count = $item->articles->count();
        });
        return response()->json([
            'status' => true,
            'result' => $tags,
        ]);

    }

    public function links()
    {
        $links = Link::all();
        return response()->json([
            'status' => true,
            'result' => $links,
        ]);
    }

    public function vote()
    {
        $id = request()->get('id');
        $article = Article::find($id);
        $article->votes += 1;
        $article->save();
        return response()->json([
            'status' => true,
            'result' => 'success',
        ]);
    }
}