@extends('layout.layout')
@section('title','编辑新闻')
@section('content')
    <!-- sidebar end -->
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <input type="hidden" name="id" id="id" value="{{$news->id}}" />
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新闻管理</strong> /
                    <small>News</small></div>
            </div>

            <hr>
            <!--修改密码弹出层start-->

            <div class="am-popup-inner">
                <div class="am-popup-hd">
                    <h4 class="am-popup-title">修改新闻</h4>
                    <span data-am-modal-close
                          class="am-close">&times;</span>
                </div>
                <div class="am-popup-bd">
                    <form class="am-form" id="id" action="/adm/news/edit-news/{{$news->id}}" method="post">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                        <div class="am-form-group">
                            <label for="new-head">新闻标题:</label>
                            <input type="text" class="admin-form-text" name="title" id="title" placeholder="请输入新闻标题" value="{{$news->title}}" >
                        </div>
                        <div class="am-form-group">
                            <label for="new-publisher">新闻作者:</label>
                            <input type="text" class="admin-form-text" name="publisher" id="publisher" value="{{$news->publisher}}" readonly>
                        </div>
                        <div class="am-form-group">
                            <label for="new-body">新闻内容:</label></td>
                            <textarea  class="admin-form-text" name="content" id="content"  placeholder="请输入新闻内容 " style="height: 200px;"></textarea>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">新闻类别</div>
                            <div class="am-u-sm-8 am-u-md-10">
                                <div class="am-btn-group" data-am-button>
                                    <label class="am-btn am-btn-default am-btn-xs">
                                        <input type="radio" name="type" id="option1" value="0"> 国际新闻
                                    </label>
                                    <label class="am-btn am-btn-default am-btn-xs">
                                        <input type="radio" name="type" id="option2" value="1"> 国内新闻
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="am-form-group" align="center">
                            <!--加隐藏框存ID -->
                            <input type="button" onclick="editNews1()" class="am-btn am-btn-primary" value="修改" />
                            <input type="button" onclick="history.go(-1)" value="取消" class="am-btn am-btn-primary"/>
                        </div><!--modal(close) 使用amazeui的方法-->
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!--修改密码弹出层end-->
        <!-- content end -->
@endsection
<script >
    function editNews1() {
        var type = 2;
        var types = document.getElementsByName("type");
        for(var i=0; i<types.length; i++){
            if(types[i].checked){
                type = types[i].value;
                break;
            }
        }
        if(type != "1" && type != "0"){
            alert("请选择新闻类别");
            return;
        }
        data = {
            'id': $("#id").val(),
            'title': $("#title").val(),
            'publisher': $("#publisher").val(),
            'content': $("#content").val(),
            'type': type,
            '_token': $("#_token").val()
        };
        $.post('/adm/news/edit-news', data, function (data) {
            if (data.success) {
                alert(data.msg);
                location.href="/adm/news";
            } else {
                alert(data.msg);
            }
        }, 'json');
    }
</script>