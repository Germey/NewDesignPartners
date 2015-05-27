/*
	名称：JS主要处理文件
	作者：崔庆才
	时间：2015/5/26
*/


$(function(){

	/* 注册表单合法性验证 */
	$("#register-form").validate({
		rules:{
			email:{
				required:true,email:true
			},
			name:{
				required:true,minlength:2
			},
			phone:{
				required:true,phone:true
			},
			password:{
				required:true,minlength:6
			},
			confirm:{
				required:true,equalTo:"#password"
			}
		},
		errorPlacement:function(error,element){
			element.parent().next().children(".label").html="";
			error.appendTo(element.parent().next().children(".label"));
		},
		messages:{
			email:{
				required:"<img src="+getWrongPic()+">",email:"<img src="+getWrongPic()+">"
			},
			name:{
				required:"<img src="+getWrongPic()+">",minlength:"<img src="+getWrongPic()+">"
			},
			phone:{
				required:"<img src="+getWrongPic()+">",phone:"<img src="+getWrongPic()+">"
			},
			password:{
				required:"<img src="+getWrongPic()+">",minlength:"<img src="+getWrongPic()+">"
			},
			confirm:{
				required:"<img src="+getWrongPic()+">",equalTo:"<img src="+getWrongPic()+">"
			}
		},
		submitHandler:function(form){ 
			form.submit();
		},
		success:function(label){
			label.html("<img src="+getRightPic()+">");
		}
	});
	

});