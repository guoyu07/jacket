@extends('blog.admin.layout')

@section('title')
    首页
@stop

@section('page-header')
    <section class="content-header">
        <h1>
            菜单
            <small>编辑菜单</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/index"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="/admin/menu/index"><i class="fa fa-book"></i> 菜单</a></li>
            <li class="active">编辑菜单</li>
        </ol>
    </section>
@stop

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <form action="/admin/menu/update/{{$menu->id}}" role="form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="name" class="control-label">菜单名称</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name', $menu->name)}}">
                        </div>
                        <div class="form-group">
                            <label for="type" class="control-label">菜单分类</label>
                            <select name="type" id="type" class="form-control">
                                <option value="category" {{old('type', $menu->type) == 'category' ? 'selected' : ''}}>分类</option>
                                <option value="module" {{old('type', $menu->type) == 'module' ? 'selected' : ''}}>模块</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="path" class="control-label">菜单路径</label>
                            <input type="text" name="path" id="path" class="form-control" value="{{old('path', $menu->path)}}">
                        </div>
                        <div class="form-group">
                            <label for="sort" class="control-label">菜单排序</label>
                            <input type="number" name="sort" id="sort" class="form-control" value="{{old('sort', $menu->path)}}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">是否激活</label><br>
                            <input type="radio" name="active" value="1" {{old('active', $menu->active) === 1 ? 'checked' : ''}}>是
                            <input type="radio" name="active" value="0" {{old('active', $menu->active) === 0 ? 'checked' : ''}}>否

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
