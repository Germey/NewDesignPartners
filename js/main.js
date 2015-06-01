/*
	名称：JS主要处理文件
	作者：崔庆才
	时间：2015/5/26
*/


$(function(){

	/* 注册表单合法性验证 */
	$("#register-form").validate({
		rules: {
			email: {
				required: true, 
				email: true, 
				remote: {
					url: getEmailExistsURL(), 
					type: "post", 
					dataType: "json", 
					data: {
						email: function() {
							return $("#register-form #email").val();
						}
					}
				}
			}, 
			name: {
				required: true, minlength: 2
			}, 
			phone: {
				required: true, phone: true,
				remote: {
					url: getPhoneExistsURL(), 
					type: "post", 
					dataType: "json", 
					data: {
						phone: function() {
							return $("#register-form #phone").val();
						}
					}
				}
			}, 
			password: {
				required: true, minlength: 6
			}, 
			confirm: {
				required: true, equalTo: "#password"
			},
			checkcode: {
				required: true, minlength:4,
				remote: {
					url: getCodeCheckURL(), 
					type: "post", 
					dataType: "json", 
					data: {
						checkcode: function() {
							return $("#register-form #checkcode").val();
						}
					}
				}
			},
			checkbox: {
				required: true
			}
		}, 
		errorPlacement: function(error, element){
			element.parent().next().children(".label").html="";
			error.appendTo(element.parent().next().children(".label"));
		}, 
		messages: {
			email: {
				required: "<img src="+getWrongPic()+">", 
				email: "<img src="+getWrongPic()+">",
				remote: "<img src="+getWrongPic()+"><script>message('不好意思，邮箱已经被注册啦！')</script>"
			}, 
			name: {
				required: "<img src="+getWrongPic()+">", minlength: "<img src="+getWrongPic()+">"
			}, 
			phone: {
				required: "<img src="+getWrongPic()+">", phone: "<img src="+getWrongPic()+">",
				remote: "<img src="+getWrongPic()+"><script>message('不好意思，手机已经被注册啦！')</script>"
			}, 
			password: {
				required: "<img src="+getWrongPic()+">", minlength: "<img src="+getWrongPic()+">"
			}, 
			confirm: {
				required: "<img src="+getWrongPic()+">", equalTo: "<img src="+getWrongPic()+">"
			},
			checkcode: {
				required: "<img src="+getWrongPic()+">", minlength: "<img src="+getWrongPic()+">",
				remote: "<img src="+getWrongPic()+">"
			}
		}, 
		submitHandler: function(form){ 
			form.submit();
		}, 
		success: function(label){
			label.html("<img src="+getRightPic()+">");
		}
	});
	
	/* 登录表单合法性验证 */
	$("#login-form").validate({
		onkeyup: false,
		rules: {
			email: {
				required: true, 
				email: true, 
				remote: {
					url: getEmailRegisteredURL(), 
					type: "post", 
					dataType: "json", 
					data: {
						email: function() {
							return $("#login-form #email").val();
						}
					}
				}
			}, 
			password: {
				required: true,
				remote :{
					url: getPasswordCheckURL(),
					type: "post",
					dataType: "json",
					data: {
						email: function() {
							return $("#login-form #email").val();
						},
						password: function() {
							return $("#login-form #password").val();
						}
					}
				}
			}
		}, 
		errorPlacement: function(error, element){
			element.parent().next().children(".label").html="";
			error.appendTo(element.parent().next().children(".label"));
		}, 
		messages: {
			email: {
				required: "<img src="+getWrongPic()+">", 
				email: "<img src="+getWrongPic()+">",
				remote: "<img src="+getWrongPic()+"><script>message('不好意思，当前用户不存在！')</script>"
			}, 
			password: {
				required: "<img src="+getWrongPic()+">",
				remote: "<img src="+getWrongPic()+"><script>message('不好意思，密码输入错误！')</script>"
			}
		}, 
		submitHandler: function(form){ 
			form.submit();
		}, 
		success: function(label){
			label.html("<img src="+getRightPic()+">");
		}
	});
	
	/* 分页标签包围一层<li> */
	wrapPagination();


	/* 日期选择器 */
	$('#date-start').datetimepicker({
		format: 'yyyy/MM/dd hh:mm',
		language: 'en',
		pickDate: true,
		pickTime: true,
		hourStep: 1,
		minuteStep: 15,
		secondStep: 30,
		inputMask: true
	});
	$('#date-end').datetimepicker({
		format: 'yyyy/MM/dd hh:mm',
		language: 'en',
		pickDate: true,
		pickTime: true,
		hourStep: 1,
		minuteStep: 15,
		secondStep: 30,
		inputMask: true
	});

	/* 关注 - 项目 */
	$("#proj-details p.follow-project").click(function() {
		$.post(getFollowProjURL(), {proj_id: $("#proj-details #proj_id").val()}, function(data) {
			if (data == "-1") {
				window.location.href = getSiteURL() + "/login/login";
			} else if (data == 0) {
				message("关注失败，请稍后重试");
			} else if (data == 1) {
				$("#proj-details p.follow-project").text("取消关注");
			} else if (data == 2) {
				message("取消关注失败");
			} else if (data == 3) {
				$("#proj-details p.follow-project").text("+关注");
			} 
		});
	});


});
