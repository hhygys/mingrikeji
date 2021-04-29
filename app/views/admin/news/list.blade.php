@extends('layout.layout')
@section('title','新闻管理')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <!-- 新闻上方区域，增删... -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">后台</strong> / <small>新闻管理</small>
            </div>
        </div>
        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <button type="button" class="am-btn am-btn-default"
                                onclick="window.location.href='/adm/news/add-news'">
                            <span class="am-icon-plus"></span> 新增
                        </button>
                        <button type="button" class="am-btn am-btn-default" onclick="delallnews1()">
                            <span class="am-icon-trash-o"></span> 删除
                        </button>
                    </div>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    <select id="select" onchange="selchangenews1()">
                        <option value="2" @if($options == 2)selected@endif>所有类别</option>
                        <option value="1" @if($options == 1)selected@endif>国内新闻</option>
                        <option value="0" @if($options == 0)selected@endif>国际新闻</option>
                    </select>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-input-group am-input-group-sm">
                    <input type="text" id="search" name="search" class="am-form-field"
                           value="@if(isset($search)){{$search}}@endif">
                    <span class="am-input-group-btn">
                        <button class="am-btn am-btn-default" type="button" onclick="selchangenews1()">搜索</button>
                    </span>
                </div>
            </div>
        </div>
        <!-- 新闻上方区域，增删...结束 -->

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-check"><input type="checkbox" id="selnewsAll"/></th>
                            <th class="table-id">ID</th>
                            <th>标题</th>
                            <th class="am-hide-sm-only">作者</th>
                            <th class="am-hide-sm-only">类型</th>
                            <th class="am-hide-sm-only">修改日期</th><!--am-hide-sm-only  宽屏幕显示 窄屏幕隐藏-->
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $v)
                            <from>
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                                <tr>
                                    <td><input type="checkbox" name="newslist" value="{{$v->id}}"/></td>
                                    <td>{{$v->id}}</td>
                                    <td><a href="/front/newsdetail/{{$v->id}}">{{$v->title}}</a></td>
                                    <td>{{$v->publisher}}</td>
                                    <td>
                                        @if($v->type==1)
                                            <a>国内新闻</a>
                                        @else
                                            <a>国外新闻</a>
                                        @endif
                                    </td>
                                    <td>{{$v->updated_at}}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <input type="hidden" value="{{$v->title}}"/>
                                                <input type="hidden" value="{{$v->id}}"/>
                                                <button type="button"
                                                        class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                                        onclick="window.location.href='/adm/news/edit-news/{{$v->id}}'">
                                                    <span class="am-icon-pencil-square-o"></span> 编辑
                                                </button>

                                                <button type="button"
                                                        class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                        onclick="delonenews1(this)">
                                                    <span class="am-icon-trash-o"></span> 删除
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </from>
                        @endforeach
                        </tbody>
                    </table>
                    <ul class="am-pagination">
                        {{$news->links()}}
                    </ul>
                    <hr/>
                </form>
            </div>

            <script>
                //下拉框
                function selchangenews1() {
                    var options = $("#select option:selected").val();
                    var search = $("#search").val();

                    location.href = "/adm/news?options=" + options + "&search=" + search;
                }
                //删除新闻
                function delonenews1(obj) {
                    var id = $(obj).prev().prev().val();
                    var title = $(obj).prev().prev().prev().val();
                    var mymessage = confirm("确定要删除 " + title + " 新闻么？");
                    if (mymessage) {
                        data = {
                            'id': id,
                            '_token': $("#_token").val()
                        };
                        $.post('/adm/news/delone-news', data, function (data) {
                            if (data.success) {
                                location.href = "/adm/news";
                            } else {
                                alert(data.msg);
                            }
                        }, 'json');
                    }
                }

                //删除所选新闻
                function delallnews1() {
                    var dau = document.getElementsByName("newslist");
                    var mymessage = confirm("确定要删除这些新闻么？");
                    var arr = new Array();
                    for (var i = 0; i < dau.length; i++) {
                        if (dau[i].checked) {
                            arr.push(dau[i].value);
                        }
                    }
                    if (mymessage) {
                        for (var i = 0; i < dau.length; i++) {
                            data = {
                                'id': arr,
                                '_token': $("#_token").val()
                            };
                            $.post('/adm/news/delall-news', data, function (data) {
                                if (data.success) {
                                    location.href = "/adm/news";
                                } else {
                                    alert(data.msg);
                                }
                            }, 'json');
                        }
                    }
                }
            </script>
@endsection
