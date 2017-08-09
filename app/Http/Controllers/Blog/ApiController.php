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
use App\Models\Category;
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
            $category = Category::find($category_id);
        }
        $articles = $builder->paginate(10);
        return response()->json([
            'status' => true,
            'result' => $articles,
        ]);
    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        $article = Article::with(['category', 'user', 'tags'])->find($id);
        $prev = Article::where('id', '<', $id)->max('id');
        $next = Article::where('id', '>', $id)->min('id');
        if ($prev) {
            $prev_article = Article::findOrFail($prev);
        } else {
            $prev_article = '';
        }
        if ($next) {
            $next_article = Article::findOrFail($next);
        } else {
            $next_article = '';
        }
        return response()->json([
            'status' => true,
            'result' => [
                'article' => $article,
                'prev'    => $prev_article,
                'next'    => $next_article,
            ],
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