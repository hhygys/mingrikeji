function addnews(){
	var title=$("#news-head").val();
	var adminname=$("#new-adminname").val();
	var content=$("#news-body").val();
	if(title==""){
		alert("标题不能为空");
		return ;
	}
	if(adminname==""){
		alert("作者名不能为空");
		return;
	}
	if(content==""){
		alert("新闻内容不能为空");
	}
	$.ajax({
		data:{"title":title,"adminname":adminname,"content":content},
		dataType:"json",
		type:"post",
		url:"add-news",
		success:function(data){
			if(data.status==1){
				alert("新闻标题已存在");
			}else if(data.status==2){
				alert("添加新闻成功");
				$("#add-news").modal("close");
				location.href="news";
			}else if(data.status==3){
				alert("注册失败");
			}else{
				alert("未知错误");
			}
		}
	});
}
function delone1(obj){
	var username=$(obj).prev().prev().prev().val();
	var id=$(obj).prev().prev().prev().prev().prev().val();
		$("#delete-this-new").html(username);//span标签
		$("#delete-id").val(id);//input 标签
		$("#delete-news").modal(
			{
				onConfirm:function(){//为取消绑定事件
					//ajax
					$.ajax({
						data:{"id":id},
						dataType:"json",
						type:"post",
						url:"delete-news",
						success:function(data){
							
							if(data.status==1){
								alert("确认删除id为"+id+"的新闻");
								location.href="news";
							}else if(data.status==2){
								alert("删除失败");
							}else {
								alert("未知错误");
							}
						}
					});
				},
				onCancel:function(){
					alert("放弃删除");
				}
			}
		);
}
function edit1(obj){
	var title=$(obj).prev().prev().val();
	//将DOM对象转化为JQUERY对象
	var id=$(obj).prev().prev().prev().prev().val();
	var content=$(obj).prev().val();
	var adminname=$(obj).prev().prev().prev().val();
	$("#edit-head").val(title);
	$("#hiddenname").val(title);
	$("#edit1-adminname").val(adminname);
	$("#edit1-id").val(id);
	$("#edit-body").val(content);
	$("#edit-news").modal("open");
}
function editnews(){
	var title1=$("#hiddenname").val();
	var title = $("#edit-head").val();
	var adminname = $("#edit1-adminname").val();
	var id=$("#edit1-id").val();
	var content=$("#edit-body").val()
	var fun="1";
	if(title==title1){
		fun="1";
	}else{
		fun="2";
	}
	$.ajax({
		data:{"id":id,"title":title,"adminname":adminname,"content":content,"fun":fun},
		dataType:"json",
		type:"post",
		url:"edit-news",
		success:function(data){
			if(data.status==1){
				alert("编辑成功");
				location.href="news";
			}else if(data.status==2){
				alert("编辑失败")
				return ;
			}else if(data.status==3){
				alert("未知错误");
				return ;
			}else {
				alert("标题已存在");
				return;
			}
		}
	});
}
window.onload=function(){
    selAll=document.getElementById("selAll");
    hobbys =document.getElementsByName("newslist");

    //全选事件
    selAll.onclick=function(){
        //全选
        if(selAll.checked==true){
            for(var i=0;i<hobbys.length;i++){
                hobbys[i].checked=true;
            }
        }else{
            for(var i=0;i<hobbys.length;i++){
                hobbys[i].checked=false;
        	}
	    }
	}
}
function dellist(){
	if(!confirm("确定要删除这些新闻吗？")){
		 return ;
		 }
	var cks=document.getElementsByName("newslist");
	for(var i=0;i<cks.length;i++){
		 if(cks[i].checked){
		 //alert(cks[i].value);
			 $.ajax({
					data:{"id":cks[i].value},
					dataType:"json",
					type:"post",
					url:"delete-news",
					success:function(data){
						
						if(data.status==1){
							alert("删除成功");
						}else if(data.status==2){
							alert("删除失败");
						}else {
							alert("未知错误");
						}
					}
				});
		 }
	}
	location.href="news";
}
