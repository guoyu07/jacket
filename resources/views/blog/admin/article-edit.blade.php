@extends('blog.admin.layout')

@section('title')
    首页
@stop
@section('css')
    {!! editor_css() !!}
@stop

@section('page-header')
    <section class="content-header">
        <h1>
            文章
            <small>编辑文章</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/index"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="/admin/article/index"><i class="fa fa-book"></i> 文章</a></li>
            <li class="active">编辑文章</li>
        </ol>
    </section>
@stop

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <form action="/admin/article/update/{{$article->id}}" role="form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="title" class="control-label">标题</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{old('title', $article->title)}}">
                        </div>
                        <div class="form-group">
                            <label for="category" class="control-label">分类</label>
                            <select name="category_id" id="category" class="form-control">
                                <option value="">请选择</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{old('category_id', $article->category_id ) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="desc" class="control-label">描述</label>
                            <input type="text" name="desc" id="desc" class="form-control" value="{{old('desc', $article->desc)}}">
                        </div>
                        <div class="form-group">
                            <label for="tags" class="control-label">标签</label>
                            <input type="text" name="tags" id="tags" class="form-control" value="{{old('tags', $tags)}}">
                        </div>
                        <img src="{{$article->cover}}" style="max-height: 200px" class="img-thumbnail" alt=""><br>
                        <div class="form-group">
                            <label for="cover" class="control-label">封面图</label>
                            <input type="file" name="cover" id="cover" accept="image/*" class="form-control" value="{{old('cover')}}">
                        </div>
                        <div class="form-group">
                            <label for="myEditor" class="control-label">正文</label>
                            <div id="editormd_id">
                                <textarea name="content" style="display: none">{{old('content', $article->markdown_content)}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success">提交</button>
                        <button type="reset" class="btn btn-warning">撤销</button>
                        <button type="button" class="btn btn-default pull-right" onclick="window.history.back()">返回</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop

@section('script')
    {!! editor_js() !!}
@stop