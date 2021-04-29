@extends('layout.layout')
@section('title','添加新闻')
@section('content')
    <!-- sidebar end -->
    <div class="admin-content">
        <div class="admin-content-body">
                <div class="am-cf am-padding am-padding-bottom-0">
                    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新闻管理</strong> /
                        <small>News</small></div>
                </div>

                <hr>

                <div class="am-popup-inner">
                    <div class="am-popup-hd">
                        <h4 class="am-popup-title">新增新闻</h4>
                        <span data-am-modal-close
                              class="am-close">&times;</span>
                    </div>
                    <div class="am-popup-bd">
                        <form class="am-form" id="fm-add-news" action="/admin/news/add-news" method="post">
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                            <div class="am-form-group">
                                <label for="new-head">新闻标题:</label>
                                <input type="text" class="admin-form-text" required="required"
                                       minlength="3" name="title" id="title" placeholder="请输入新闻标题"
                                       data-validation-message="新闻标题至少要有3个字符">
                            </div>
                            <div class="am-form-group">
                                <label for="new-head">新闻作者:</label>
                                <input type="text" class="admin-form-text" required="required"
                                       minlength="1" name="publisher" id="publisher" placeholder="请输入新闻作者"
                                       data-validation-message="新闻作者至少要有1个字符">
                            </div>
                            <div class="am-form-group">
                                <label for="new-body">新闻内容:</label></td>
                                <textarea class="admin-form-text" name="content" required="required"
                                          id="content" minlength="3" placeholder="请输入新闻内容 "
                                          data-validation-message="新闻内容至少要有3个字符" style="height: 200px;"></textarea>
                            </div>
                            <div class="am-form-group">
                                <!--<label for="type">用户类型:</label></td>-->
                                <label><input type="radio" id="option1" name="type" value="0">国外新闻</label>
                                <label><input type="radio" id="option2" name="type" value="1">国内新闻</label>
                            </div>
                            <div class="am-form-group" align="center">
                                <input type="button" onclick="addNew1()" value="确定" class="am-btn am-btn-primary"/>
                                <input type="button" onclick="history.go(-1)" value="取消" class="am-btn am-btn-primary"/>
                            </div><!--modal(close) 使用amazeui的方法-->
                        </form>
                    </div>
                </div>

                <!-- content end -->
                <script>
                    function addNew1() {
                        var type = 2;
                        var types = document.getElementsByName("type");
                        for (var i = 0; i < types.length; i++) {
                            if (types[i].checked) {
                                type = types[i].value;
                                break;
                            }
                        };

                        data = {
                            'title': $("#title").val(),
                            'publisher': $("#publisher").val(),
                            'content': $("#content").val(),
                            'type': type,
                            '_token': $("#_token").val()
                        };
                        $.post('/adm/news/add-news', data, function (data) {
                            if (data.success) {
                                alert(data.msg);
                                location.href = "/adm/news";
                            } else {
                                alert(data.msg);
                            }
                        }, 'json');
                    }
                </script>
@endsection
