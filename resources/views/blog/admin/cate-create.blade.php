@extends('blog.admin.layout')

@section('title')
    首页
@stop

@section('page-header')
    <section class="content-header">
        <h1>
            文章
            <small>新建分类</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/index"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="/admin/cate/index"><i class="fa fa-book"></i> 分类</a></li>
            <li class="active">新建分类</li>
        </ol>
    </section>
@stop

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <form action="/admin/cate/store" role="form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="name" class="control-label">分类名称</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
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
