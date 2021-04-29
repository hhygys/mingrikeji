@extends('layout.layout')
@section('title','用户管理')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <!-- 用户上方区域，增删... -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">后台</strong> / <small>用户管理</small>
            </div>
        </div>
        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <button type="button" class="am-btn am-btn-default"
                                onclick="window.location.href='/adm/user/add-user'">
                            <span class="am-icon-plus"></span> 新增
                        </button>
                        <button type="button" class="am-btn am-btn-default" onclick="delalluser1(this)" id="nowname"
                                value="{{Auth::user()->id}}">
                            <span class="am-icon-trash-o"></span> 删除
                        </button>
                    </div>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    <select id="select" onchange="selchange1()">
                        <option value="2" @if($options == 2) selected @endif>所有类别</option>
                        <option value="1" @if($options == 1) selected @endif>管理员</option>
                        <option value="0" @if($options == 0) selected @endif>普通用户</option>
                    </select>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-input-group am-input-group-sm">
                    <input type="text" id="search" name="search" class="am-form-field"
                           value="@if(isset($search)){{$search}}@endif">
                    <span class="am-input-group-btn">
                        <button class="am-btn am-btn-default" type="button" onclick="selchange1()">搜索</button>
                    </span>
                </div>
            </div>
        </div>
        <!-- 用户上方区域，增删...结束 -->
        <!-- 用户区域 -->
        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox" id="seluserAll"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-type">用户类型</th>
                        <th class="table-author am-hide-sm-only">用户名</th>
                        <th class="table-author am-hide-sm-only">邮箱</th>
                        <th class="table-date am-hide-sm-only">修改日期</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $v)
                        <form>
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                            <tr>
                                <td><input type="checkbox" name="userlist" value="{{$v->id}}"/></td>
                                <td>{{$v->id}}</td>
                                <td>@if($v->type == 1)管理员@else普通用户@endif</td>
                                <td class="am-hide-sm-only">{{$v->username}}</td>
                                <td class="am-hide-sm-only">{{$v->email}}</td>
                                <td class="am-hide-sm-only">{{$v->updated_at}}</td>
                                <td>

                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <input type="hidden" value="{{Auth::user()->username}}"/>
                                            <input type="hidden" value="{{$v->username}}"/>
                                            <input type="hidden" value="{{$v->id}}"/>
                                            <button type="button"
                                                    class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                                    onclick="window.location.href='/adm/user/edit-user/{{$v->id}}'">
                                                <span class="am-icon-pencil-square-o"></span> 编辑
                                            </button>

                                            {{--                                            <button type="button"--}}
                                            {{--                                                    class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"--}}
                                            {{--                                                    onclick="window.location.href='/adm/user/delete-user/{{$v->id}}'">--}}
                                            {{--                                                <span class="am-icon-trash-o"></span> 删除--}}
                                            {{--                                            </button>--}}
                                            <button type="button"
                                                    class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                    onclick="delone1(this)">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>
                <ul class="am-pagination">
                    {{$users->links()}}
                </ul>
                <hr/>
            </div>
            <script>
                function selchange1() {
                    var options = $("#select option:selected").val();
                    var search = $("#search").val();

                    location.href = "/adm/user?options=" + options + "&search=" + search;
                }

                function delone1(obj) {
                    var id = $(obj).prev().prev().val();
                    var username = $(obj).prev().prev().prev().val();
                    var authname = $(obj).prev().prev().prev().prev().val();
                    if (authname == username) {
                        alert("不能删除当前登录用户");
                        return;
                    }
                    var mymessage = confirm("确定要删除 " + username + " 用户么？");
                    if (mymessage) {
                        data = {
                            'id': id,
                            'logname': authname,
                            'username': username,
                            '_token': $("#_token").val()
                        };
                        $.post('/adm/user/delone-user', data, function (data) {
                            if (data.success) {
                                window.location.href = "/adm/user";
                            } else {
                                alert(data.msg);
                            }
                        }, 'json');
                    }
                }

                //删除所选用户
                function delalluser1(obj) {
                    var dau = document.getElementsByName("userlist");
                    var arr = new Array();
                    for (var i = 0; i < dau.length; i++) {
                        if (dau[i].checked) {
                            arr.push(dau[i].value);
                            if (dau[i].value == $(obj).val()) {
                                alert("不能删除当前登录用户哦(✿◡‿◡)");
                                return;
                            }
                        }
                    }
                    var mymessage = confirm("确定要删除这些用户么？");
                    if (mymessage) {
                        for (var i = 0; i < dau.length; i++) {
                            data = {
                                'id': arr,
                                '_token': $("#_token").val()
                            };
                            $.post('/adm/user/delall-user', data, function (data) {
                                if (data.success) {
                                    location.href = "/adm/user";
                                } else {
                                    alert(data.msg);
                                }
                            }, 'json');
                        }
                    }
                }
            </script>
@endsection
