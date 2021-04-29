$(function() {
	$('#fm-forget-user').validator({
		onValid: function(validity) {
			$(validity.field).closest('.am-form-group').find('.am-alert').hide();
		},

		onInValid: function(validity) {
			var $field = $(validity.field);
			var $group = $field.closest('.am-form-group');
			var $alert = $group.find('.am-alert');
			// 使用自定义的提示信息 或 插件内置的提示信息
			var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

			if (!$alert.length) {
				$alert = $('<div class="am-alert am-alert-danger"></div>').hide().
					appendTo($group);
			}

			$alert.html(msg).show();
		}
	});

	$('#fm-add-user').validator({
		onValid: function(validity) {
			$(validity.field).closest('.am-form-group').find('.am-alert').hide();
		},

		onInValid: function(validity) {
			var $field = $(validity.field);
			var $group = $field.closest('.am-form-group');
			var $alert = $group.find('.am-alert');
			// 使用自定义的提示信息 或 插件内置的提示信息
			var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

			if (!$alert.length) {
				$alert = $('<div class="am-alert am-alert-danger"></div>').hide().
					appendTo($group);
			}

			$alert.html(msg).show();
		}
	});

	$('#fm-edit-user').validator({
		onValid: function(validity) {
			$(validity.field).closest('.am-form-group').find('.am-alert').hide();
		},

		onInValid: function(validity) {
			var $field = $(validity.field);
			var $group = $field.closest('.am-form-group');
			var $alert = $group.find('.am-alert');
			// 使用自定义的提示信息 或 插件内置的提示信息
			var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

			if (!$alert.length) {
				$alert = $('<div class="am-alert am-alert-danger"></div>').hide().
					appendTo($group);
			}

			$alert.html(msg).show();
		}
	});
	
	$("input:checkbox[id='seluserAll']").click(function() {
		if($(this).is(':checked')) {
			$('input:checkbox').each(function() {
				$(this).prop("checked", true);
			});
		} else {
			$('input:checkbox').each(function() {
				$(this).prop("checked", false);
			});
		}
	});
	
	$('#fm-add-news').validator({
		onValid: function(validity) {
			$(validity.field).closest('.am-form-group').find('.am-alert').hide();
		},
		onInValid: function(validity) {
			var $field = $(validity.field);
			var $group = $field.closest('.am-form-group');
			var $alert = $group.find('.am-alert');
			// 使用自定义的提示信息 或 插件内置的提示信息
			var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

			if (!$alert.length) {
				$alert = $('<div class="am-alert am-alert-danger"></div>').hide().
				appendTo($group);
			}

			$alert.html(msg).show();
		}
	});

	$('#fm-edit-news').validator({
		onValid: function(validity) {
			$(validity.field).closest('.am-form-group').find('.am-alert').hide();
		},

		onInValid: function(validity) {
			var $field = $(validity.field);
			var $group = $field.closest('.am-form-group');
			var $alert = $group.find('.am-alert');
			// 使用自定义的提示信息 或 插件内置的提示信息
			var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

			if (!$alert.length) {
				$alert = $('<div class="am-alert am-alert-danger"></div>').hide().
				appendTo($group);
			}

			$alert.html(msg).show();
		}
	});
	
	$("input:checkbox[id='selnewsAll']").click(function() {
		if($(this).is(':checked')) {
			$('input:checkbox').each(function() {
				$(this).prop("checked", true);
			});
		} else {
			$('input:checkbox').each(function() {
				$(this).prop("checked", false);
			});
		}
	});
	
});

//记住密码
function save(){
	if ($("#remember-me").prop("checked")) {
        var str_username = $("#username").val();//用户名
        var str_password = $("#password").val();//密码
        $.cookie("rmbUser", "true", { expires: 7 }); //存储一个带7天期限的cookie
        $.cookie("username", str_username, { expires: 7 });
        $.cookie("password", str_password, { expires: 7 });
    } else {
        $.cookie("rmbUser", "false", { expire: -1 });
        $.cookie("username", "", { expires: -1 });
        $.cookie("password", "", { expires: -1 });
    }
    if ($("#autoLogin").prop("checked")) {
        var str_username = $("#username").val();
        var str_password = $("#password").val();
        $.cookie("auto", "true", { expires: 7 }); //存储一个带7天期限的cookie
        $.cookie("username", str_username, { expires: 7 });
        $.cookie("password", str_password, { expires: 7 });
    } else {
        $.cookie("auto", "false", { expire: -1 });
        $.cookie("username", "", { expires: -1 });
        $.cookie("password", "", { expires: -1 });
    }
}

$(function() {
    $("#autoLogin").change(function() {
       if($("#autoLogin").prop("checked")){
            $.cookie("auto", "true", { expires: 7 });
        }else{
            $.cookie("auto", "false", { expires: 7 });
        }
    });

    if ($.cookie("rmbUser") == "true") {
        $("#remember-me").attr("checked", true);
        $("#username").val($.cookie("username"));
        $("#password").val($.cookie("password"));
    }

    if ($.cookie("auto") == "true") {
        setTimeout(function(){
            if($.cookie("auto") == "true")
            login();
        },5000);
    }
});

function login() {
	data = {
		'username': $("#username").val().trim(),
		'password': $("#password").val(),
		'_token': $("#_token").val()
	};
	$.post('/login', data, function (data) {
		if (data.success) {
			alert(data.msg);
			location.href="/adm";
		} else {
			alert(data.msg);
		}
	}, 'json')
}

function forget(){
	var username = $("#username").val();
	$("#forget-user").find("#forusername").val(username);
	$("#forget-user").modal(); // 打开Popup层
}

function forgetuser(){
	var name = $("#forusername").val();
	var pwd = $("#forpassword1").val();
	if(pwd == ""){
		alert("密码不能为空");
		$("#forpassword1").focus();
		return;
	}
	if(pwd.length < 6){
		alert("密码至少为 6 位");
		$("#forpassword1").focus();
		return;
	}
	var repwd = $("#forpassword2").val();
	if(repwd == ""){
		alert("确认密码不能为空");
		$("#forpassword2").focus();
		return;
	}
	if(pwd != repwd){
		alert("两次密码不一致，请重新输入");
		$("#forpassword1").focus();
		return;
	}
	$.ajax({
		data:{"name":name, "pwd":pwd},
		dataType:"json",
		type:"post",
		url:"/MVCMC/admin/forget",
		success:function(data){
			if(data.status == 1){
				alert("普通用户不能修改");
			} else if(data.status == 2){
				alert("修改成功");
				location.href="/MVCMC/admin/login.jsp";
			} else if(data.status == 3){
				alert("修改失败");
			} else if(data.status == 4){
				alert("用户名不存在");
			} else {
				alert("未知错误");
			}
		}
	});
}

//用户tianjia
function register() {
	var type = 2;
	var types = document.getElementsByName("type");
	for(var i=0; i<types.length; i++){
		if(types[i].checked){
			type = types[i].value;
			break;
		}
	};
	data = {
		'username': $("#username").val().trim(),
		'password': $("#password").val(),
		'password_confirmation': $("#repassword").val(),
		'type': type,
		'_token': $("#_token").val()
	};
	$.post('/adm/user/add-user', data, function (data) {
		if (data.success) {
			alert(data.msg);
			location.href="/adm/user";
		} else {
			alert(data.msg);
		}
	}, 'json');
}

function delalluser(){
	var dau = document.getElementsByName("userlist");
	var nowname = $("#nowname").val();
	if (!confirm("确定要删除这些用户吗？")) {
		return;
	}
	for(var i = 0; i < dau.length; i++){
		if(dau[i].checked){
			$.ajax({
				data: {"id": dau[i].value, "nowname": nowname},
				dataType: "json",
				type: "post",
				url: "/adm/deluser",
				success: function(data) {
					if (data.status == 1) {
						alert("无法删除当前登录" + nowname + "用户");
						return;
					} else if (data.status == 2) {
						location.href="/adm/user";
					} else if (data.status == 3) {
						alert("删除失败");
					} else {
						alert("未知错误");
					}
				}
			});
		}
	}
}

function usercategory(){
	var chtype=$(":selected").val();
	window.location.href="/MVCMC/admin/ctguser?type=" + chtype;
}

function usersearch(){
	var selname=document.getElementById("searchcontent").value;
	var type=$("#usersel option:selected").val();
	if(selname == ""){
		alert("搜索框不能为空");
		$("#searchcontent").focus();
		return;
	}
	$.ajax({
		data:{"selname":selname, "type":type},
		dataType:"json",
		type:"post",
		url:"/MVCMC/admin/seauser",
		success:function(data){
			if(data.status == 1){
				alert("已找到");
				window.location.href="/MVCMC/admin/searchuser";
			} else if(data.status == 2) {
				alert("查无此人");
			} else {
				alert("未知错误");
			}
		}
	});
}

function edit(obj) {
	var username = $(obj).prev().val();
	var id = $(obj).prev().prev().val();
	$("#edit-user").find("#editusername").val(username);
	$("#edit-user").find("#edit-id").val(id);
	$("#edit-user").modal(); // 打开Popup层
}

function edituser(){
	var id = $("#edit-id").val();
	//var name = $("#editusername").val();
	var pwd = $("#password").val();
	if(pwd == ""){
		alert("密码不能为空");
		$("#editpassword1").focus();
		return;
	}
	if(pwd.length < 6){
		alert("密码至少为 6 位");
		$("#repassword").focus();
		return;
	}
	var repwd = $("#repassword").val();
	if(repwd == ""){
		alert("确认密码不能为空");
		$("#repassword").focus();
		return;
	}
	if(pwd != repwd){
		alert("两次密码不一致，请重新输入");
		$("#repassword").focus();
		return;
	}
	$.ajax({
		data:{"id":id, "pwd":pwd},
		dataType:"json",
		type:"post",
		url:"/adm/user/edit-user",
		success:function(data){
			if(data.status == 1){
				alert("修改成功");
				location.href="/adm/user";
			} else if(data.status == 2){
				alert("修改失败");
			} else {
				alert("未知错误");
			}
		}
	});
}

function deleteone(obj) {
	var username = $(obj).prev().prev().val(); // 要删除的当前记录的用户名
	var id = $(obj).prev().prev().prev().val();//表单控件才有val()方法
	var myname = $("#myname").val(); // 登陆的用户名
	$("#confirm-username").html(username);
	$("#delete-user").find("#delete-id").val(id);
	if(username == myname){
		alert("不能删除当前登录用户");
		return;
	}
	$("#delete-user").modal({
		relatedTarget: obj,
		onConfirm: function() {
			var $link = $(this.relatedTarget).prev("button");
			var msg = $link.length ? "您要删除的ID是" + $("#delete-id").val() : "您没有选中删除项";
			alert(msg);
			
			$.ajax({
				data:{"id":id},
				dataType:"json",
				type:"post",
				url:"/MVCMC/admin/deluser",
				success:function(data){
					if(data.status == 1){
						alert("删除成功");
						location.href="/MVCMC/admin/user";
					} else if(data.status == 2){
						alert("删除失败");
					} else{
						alert("未知错误");
					}
				}
			})
		},
		onCancel: function() {
			alert("算了，不删了");
		}
	});
}

//新闻
function newsregister() {
	var title = $("#newstitle").val();
	if(title == ""){
		alert("标题不能为空");
		$("#newstitle").focus();
		return;
	}
	var publisher = $("#newspublisher").val();
	if(publisher == ""){
		alert("作者不能为空");
		$("#newspublisher").focus();
		return;
	}
	var content = $("#newscontent").val();
	var type = 2;
	var types = document.getElementsByName("type");
	for(var i=0; i<types.length; i++){
		if(types[i].checked){
			type = types[i].value;
			break;
		}
	}
	if(type != "1" && type != "0"){
		alert("请选择新闻类型");
		return;
	}
	
	$.ajax({
		data:{"title":title, "publisher":publisher, "content":content, "type":type},
		dataType:"json",
		type:"post",
		url:"/MVCMC/admin/addnews",
		success:function(data){
			if(data.status == 0) {
				alert("该新闻已存在");
			} else if(data.status == 1){
				alert("添加成功");
				$("#add-news").modal("close");
				location.href="/MVCMC/admin/news";
			} else if(data.status == 2){
				alert("添加失败");
			} else {
				alert("未知错误");
			}
		}
	});
}

function delallnews(){
	var dan = document.getElementsByName("newslist");
	if (!confirm("确定要删除这些新闻吗？")) {
		return;
	}
	for(var i = 0; i < dan.length; i++){
		if(dan[i].checked){
			$.ajax({
				data: {"id": dan[i].value},
				dataType: "json",
				type: "post",
				url: "/MVCMC/admin/delnews",
				success: function(data) {
					if (data.status == 1) {
						location.href="/MVCMC/admin/news";
					} else if (data.status == 2) {
						alert("删除失败");
					} else {
						alert("未知错误");
					}
				}
			});
		}
	}
}

function newscategory(){
	var chtype=$(":selected").val();
	window.location.href="/MVCMC/admin/ctgnews?type=" + chtype;
}

function newssearch(){
	var selname=document.getElementById("searchcontent").value;
	var type=$("#newssel option:selected").val();
	if(selname == ""){
		alert("搜索框不能为空");
		$("#searchcontent").focus();
		return;
	}
	$.ajax({
		data:{"selname":selname, "type":type},
		dataType:"json",
		type:"post",
		url:"/MVCMC/admin/seanews",
		success:function(data){
			if(data.status == 1){
				alert("已找到");
				window.location.href="/MVCMC/admin/searchnews";
			} else if(data.status == 2) {
				alert("没有标题为 " + selname + " 新闻");
			} else {
				alert("未知错误");
			}
		}
	});
}

function editnews(obj) {
	var newstitle = $(obj).prev().val();
	var id = $(obj).prev().prev().val();
	$("#edit-news").find("#editnewstitle").val(newstitle);
	$("#edit-news").find("#editnews-id").val(id);
	$("#edit-news").modal();
}

function editnewss(){
	var id = $("#editnews-id").val();
	var title = $("#editnewstitle").val();
	var content = $("#editnewscontent").val();
	if(content == ""){
		alert("内容不能为空");
		$("#editnewscontent").focus();
		return;
	}
	$.ajax({
		data:{"id":id, "content":content},
		dataType:"json",
		type:"post",
		url:"/MVCMC/admin/editnews",
		success:function(data){
			if(data.status == 1){
				alert("修改成功");
				location.href="/MVCMC/admin/news";
			} else if(data.status == 2){
				alert("修改失败");
			} else {
				alert("未错误");
			}
		}
	});
}

function deleteonenews(obj) {
	var newstitle=$(obj).prev().prev().val();
	var id=$(obj).prev().prev().prev().val();//表单控件才有val()方法
	$("#confirm-newsname").html(newstitle);
	$("#delete-news").find("#delete-id").val(id);
	$("#delete-news").modal({
		relatedTarget:obj,
		onConfirm:function(){
			var $link=$(this.relatedTarget).prev("button");
			var msg=$link.length?"您要删除的ID是"+$("#delete-id").val():"您没有选中删除项";
			alert(msg);
			
			$.ajax({
				data:{"id":id},
				dataType:"json",
				type:"post",
				url:"/MVCMC/admin/delnews",
				success:function(data){
					if(data.status == 1){
						alert("删除成功");
						location.href="/MVCMC/admin/news";
					} else if(data.status == 2){
						alert("删除失败");
					} else{
						alert("未知错误");
					}
				}
			})
		},
		onCancel:function(){
			alert("算了，不删了");
		}
	});
}
