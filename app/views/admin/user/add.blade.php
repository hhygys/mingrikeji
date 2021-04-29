@extends('layout.layout')
@section('title','添加用户')
@section('content')
    <!-- sidebar end -->
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">用户管理</strong> / <small>User</small></div>
            </div>
            <hr>
            <div class="am-popup-inner">
                <div class="am-popup-hd">
                    <h4 class="am-popup-title">添加用户</h4>
                    <span data-am-modal-close class="am-close">&times;</span>
                </div>
                <div class="am-popup-bd">
                    <form class="am-form" id="fm-add-user" method="post" action="/adm/user/edit-user">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <div class="am-form-group">
                            <label for="username">用户名:</label>
                            <input type="text" id="username" name="username" minlength="5" class="am-form-field" placeholder="用户名" required>
                        </div>
                        <div class="am-form-group">
                            <label for="email">邮箱:</label>
                            <input type="email" id="email" name="email"  class="am-form-field" placeholder="邮箱" >
                        </div>
                        <div class="am-form-group">
                            <label for="password">密码:</label>
                            <input type="password" id="password" name="password" class="am-form-field" placeholder="密码">
                        </div>
                        <div class="am-form-group">
                            <label for="password_confirmation">确认密码:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="am-form-field" placeholder="确认密码">
                        </div>
                        <div class="am-form-group">
                            <!--<label for="type">用户类型:</label></td>-->
                            <label><input type="radio" id="option1" name="type" value="0">普通用户</label>
                            <label><input type="radio" id="option2" name="type" value="1">管理员</label>
                        </div>
                        <div class="am-form-group" align="center">
                            <input type="button" onclick="addUser()" value="提交" class="am-btn am-btn-primary"/>
                            <input type="button" onclick="history.go(-1)" value="取消" class="am-btn am-btn-primary"/>
                        </div><!--modal(close) 使用amazeui的方法-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addUser() {
            var type = 2;
            var types = document.getElementsByName("type");
            for (var i = 0; i < types.length; i++) {
                if (types[i].checked) {
                    type = types[i].value;
                    break;
                }
            };
                data = {
                    'username': $("#username").val().trim(),
                    'email': $("#email").val().trim(),
                    'password': $("#password").val(),
                    'password_confirmation': $("#password_confirmation").val(),
                    'type': type,
                    '_token': $("#_token").val()
                };
            $.post('/adm/user/add-user', data, function (data) {
                if (data.success) {
                    alert(data.msg);
                    window.location.href = "/adm/user";
                } else {
                    alert(data.msg);
                }
            }, 'json');
        }
    </script>
@endsection
