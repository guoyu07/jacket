<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/17
 * Time: 22:46
 */

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleEditRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\BlogService;
use Illuminate\Http\Request;



class ArticleController extends Controller
{
    protected $service;
    protected $article;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $articles = Article::all();
        return view('blog.admin.article-index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('blog.admin.article-create', compact('categories'));
    }

    public function store(ArticleCreateRequest $request)
    {
        $data = $request->articleData();
        $data['cover'] = $this->service->upload($request->file('cover'));
        $article = Article::create($data);
        $tags = $request->get('tags');
        $tagsArr = explode(',', $tags);
        foreach ($tagsArr as $item) {
            $tag = Tag::where('name', $item)->first();
            if (! $tag) {
                $tag = Tag::create([
                    'name' => $item,
                ]);
            }
            $tag->articles()->attach($article->id);
        }
        return redirect()->to('admin/article/index')->with('message', '新建成功');
    }


    public function edit(Request $request, $id)
    {
        $categories = Category::all();
        $article  = Article::find($id);
        $tagArr = $article->tags()->pluck('name')->toArray();
        $tags = implode(',', $tagArr);
        return view('blog.admin.article-edit', compact('categories', 'article', 'tags'));
    }

    public function update(ArticleEditRequest $request, $id)
    {
        $data = $request->articleData();
        if ($request->file('cover')) {
            $data['cover'] = $this->service->upload($request->file('cover'));
        }
        $tags = $request->get('tags');
        $tagsArr = explode(',', $tags);
        $article = Article::find($id);
        $article->tags()->detach();
        foreach ($tagsArr as $item) {
            $tag = Tag::where('name', $item)->first();
            if (! $tag) {
                $tag = Tag::create([
                    'name' => $item,
                ]);
            }
            $tag->articles()->attach($id);
        }
        $article->update($data);
        return redirect()->to('admin/article/index')->with('message', '更新成功');

    }

    public function delete(Request $request, $id)
    {
        $article = Article::find($id);
        $article->tags()->detach();
        $res = $article->delete();
        if ($res) {
            return redirect()->to('admin/article/index')->with('message', '删除成功');
        }
    }
}