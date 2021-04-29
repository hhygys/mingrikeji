@extends('layout.layout')
@section('title','编辑用户')
@section('content')
    <!-- sidebar end -->
    <!-- content start -->

    <div class="admin-content">
        <div class="admin-content-body">
            <input type="hidden" name="id" id="id" value="{{$user->id}}" />
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">用户管理</strong> /
                    <small>User</small>
                </div>
            </div>

            <hr>
            <!--修改密码弹出层start-->

            <div class="am-popup-inner">
                <div class="am-popup-hd">
                    <h4 class="am-popup-title">修改密码</h4>
                    <span data-am-modal-close
                          class="am-close">&times;</span>
                </div>
                <div class="am-popup-bd">
                    <form class="am-form" id="id" action="/adm/user/edit-user/{{$user->id}}" method="post">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                        <div class="am-form-group">
                            <label for="username">用户名:</label>
                            <input type="text" class="admin-form-text" name="username" id="username" readonly="readonly" value="{{$user->username}}">
                        </div>
                        <div class="am-form-group">
                            <label for="password">密码:</label></td>
                            <input type="password" class="admin-form-text"required="required" minlength="6" name="password" id="password" placeholder="请输入至少六位密码"data-validation-message="密码不能为空，至少六个字符" >
                        </div>
                        <div class="am-form-group">
                            <label for="password_confirmation">确认密码:</label></td>
                            <input type="password" class="admin-form-text"required="required" minlength="6" name="password_confirmation" id="password_confirmation" placeholder="请在此输入密码，保证两次密码输入一致"data-validation-message="确认密码不能为空，至少六个字符" >
                        </div>
                        <div class="am-form-group" align="center">
                            <!--加隐藏框存ID -->
                            <input type="button" class="am-btn am-btn-primary" value="修改" onclick="editUser()"></input>
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
<script>
    function editUser() {
        data  = {
            'id': $("#id").val(),
            'password': $("#password").val().trim(),
            'password_confirmation': $("#password_confirmation").val(),
            '_token': $("#_token").val()
        };
        $.post('/adm/user/edit-user', data, function (data) {
            if (data.success) {
                alert(data.msg);
                window.location.href="/adm/user";
            } else {
                alert(data.msg);
            }
        }, 'json')
    }
</script>
