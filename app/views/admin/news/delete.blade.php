@extends('layout.layout')
@section('title','删除新闻')
@section('content')
    <div class="admin-content">
        <!-- 用户上方区域，增删... -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">后台</strong> / <small>新闻管理</small>
            </div>
        </div>
        <form  method="post" action="/adm/news/delete-news">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <h1  style="text-align: center"> 删除新闻</h1>
            <p style="text-align: center">将要删除id为:{{$news->id}}<br/>标题为:{{$news->title}}<br/>
                作者为:{{$news->publisher}}
                <br/>类型为:
                @if($news->type==1)
                    <a>国内新闻</a>
                @else
                    <a>国外新闻</a>
                @endif的新闻？</p>
            <p></p>
            <div class="form-group">
                <input type="hidden" class="form-control" id="exampleInputName" placeholder="" name="id"
                       value={{$news->id}}>
                <input type="hidden" class="form-control" id="exampleInputName" placeholder="" name="title"
                       value={{$news->title}}>
                <input type="hidden" class="form-control" id="exampleInputName" placeholder="" name="publisher"
                       value={{$news->publisher}}>
            </div>
            <div  style="text-align: center">
                <a href="/adm/news">
                    <button type="button" class="btn btn-secondary ">取消</button>
                </a>
                <button type="submit" class="btn btn-danger ">提交</button>
            </div>
        </form>
    </div>
@endsection