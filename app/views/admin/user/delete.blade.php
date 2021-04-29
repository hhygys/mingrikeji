@extends('layout.layout')
@section('title','删除用户')
@section('content')
    <div class="admin-content">
        <!-- 用户上方区域，增删... -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">后台</strong> / <small>用户管理</small>
            </div>
        </div>
        <form  method="post" action="/adm/user/delete-user">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <h1  style="text-align: center"> 删除用户</h1>
            <p style="text-align: center">将要删除id为:{{$user->id}}<br/>用户名为:{{$user->username}}<br/>类型为:@if($user->type==1)
                    <a>管理员</a>
                @else
                    <a>普通用户</a>
                @endif
                的用户？</p>
            <p></p>
            <div class="form-group">
                <input type="hidden" class="form-control" id="exampleInputName" placeholder="" name="id"
                       value={{$user->id}}>
                <input type="hidden" class="form-control" id="exampleInputName" placeholder="" name="username"
                       value={{$user->username}}>

            </div>
            <div  style="text-align: center">
                <a href="/adm/user">
                    <button type="button" class="btn btn-secondary ">取消</button>
                </a>
                <button type="submit" class="btn btn-danger ">提交</button>
            </div>
        </form>
    </div>
@endsection