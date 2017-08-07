@extends('blog.admin.layout')

@section('title')
    首页
@stop

@section('css')
    <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css">
@stop

@section('page-header')
    <section class="content-header">
        <h1>
            首页
            <small>控制中心</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/index"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">控制中心</li>
        </ol>
    </section>
@stop

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <a href="/admin/menu/create" class="btn btn-success"><i class="fa fa-plus"></i> 增加</a>
                </div>
                <div class="box-body">
                    <table id="cate_table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>类型</th>
                            <th>路径</th>
                            <th>排序</th>
                            <th>是否激活</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->type}}</td>
                                <td>{{$menu->path}}</td>
                                <td>{{$menu->sort}}</td>
                                <td>
                                    @if ($menu->active)
                                        是
                                        @else
                                        否
                                    @endif
                                </td>
                                <td>{{$menu->created_at}}</td>
                                <td>
                                    <a href="{{url("admin/menu/edit/{$menu->id}")}}" class="btn btn-primary">编辑</a>
                                    <form style="display: inline-block" action="{{url("admin/menu/delete/{$menu->id}")}}" method="post">
                                        {!! csrf_field() !!}
                                        <button class="btn btn-danger" onclick="return confirm('你确定要删除吗？')">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop

@section('script')
    <!-- DataTables -->
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $('#cate_table').dataTable();
    </script>
@stop