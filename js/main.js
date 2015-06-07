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
		format: 'yyyy/MM/dd',
		language: 'en',
		pickDate: true,
		pickTime: true,
		hourStep: 1,
		minuteStep: 15,
		secondStep: 30,
		inputMask: true
	});
	$('#date-end').datetimepicker({
		format: 'yyyy/MM/dd',
		language: 'en',
		pickDate: true,
		pickTime: true,
		hourStep: 1,
		minuteStep: 15,
		secondStep: 30,
		inputMask: true
	});

	/* 首页鼠标滑动经过项目弹出参与按钮 */
	$("#projOverview .project-single .pre-img").mouseleave(function() {
		$(this).find(".join").fadeOut(500);
	})
	.mouseenter(function() {
		$(this).find(".join").fadeIn(500);
	});

	/* 首页鼠标滑动经过训练营弹出参与按钮 */
	$("#wkshopOverview .workshop-single .img").mouseleave(function() {
		$(this).find(".join").fadeOut(500);
	})
	.mouseenter(function() {
		$(this).find(".join").fadeIn(500);
	});


	/* 加关注 */
	function addAttentionProj() {
		var item = $(this);
		$.post(getAttentionProjURL(), {proj_id: $(this).attr("proj")}, function(data) {
			if (data == "-1") {
				window.location.href = getSiteURL() + "/login";
			} else if (data == 0) {
				message("关注失败，请稍后重试");
			} else if (data == 1) {
				item.text("取消关注");
			} else if (data == 2) {
				message("取消关注失败");
			} else if (data == 3) {
				item.text("+关注");
			} 
		});
	}

	/* 关注项目 */
	$("#proj-details p.follow-project").click(addAttentionProj);


	/* 加关注 */
	function addAttentionWkshop() {
		var item = $(this);
		$.post(getAttentionWkshopURL(), {wkshop_id: $(this).attr("wkshop")}, function(data) {
			if (data == "-1") {
				window.location.href = getSiteURL() + "/login";
			} else if (data == 0) {
				message("关注失败，请稍后重试");
			} else if (data == 1) {
				item.text("取消关注");
			} else if (data == 2) {
				message("取消关注失败");
			} else if (data == 3) {
				item.text("+关注");
			} 
		});
	}

	/* 关注训练营 */
	$("#wkshop-details p.follow-workshop").click(addAttentionWkshop);

	/* 加入项目 */
	function joinProj() {
		var btn = $(this);
		if($(this).attr("proj")){
			$.post(getJoinProjURL(), {proj_id: btn.attr("proj")}, function(data) {
				if (data == "-1") {
					window.location.href = getSiteURL() + "/login";
				} else if (data == 0) {
					message("参与失败，请稍后重试");
				} else if (data == 1) {
					btn.removeAttr("proj").attr("name","joined").val("已参与");
				} else if (data == 2) {
					message("请勿重复参与");
				} 
			});
		}

	}

	/* 加入训练营 */
	function joinWkshop() {
		var btn = $(this);
		if ($(this).attr("wkshop")) {
			$.post(getJoinWkshopURL(), {wkshop_id: btn.attr("wkshop")}, function(data) {
				if (data == "-1") {
					window.location.href = getSiteURL() + "/login";
				} else if (data == 0) {
					message("参与失败，请稍后重试");
				} else if (data == 1) {
					btn.removeAttr("wkshop").attr("name","joined").val("已参与");
				} else if (data == 2) {
					message("请勿重复参与");
				} 
			});
		} else if ($(this).attr("redirect")) {
			window.location.href = $(this).attr("redirect");
		}

	}


	/* 首页 - 加入 - 项目 */
	$('#projOverview .project-single input[name="join"]').click(joinProj);

	/* 项目列表页 - 加入 - 项目 */
	$('#projects .add input[name="join"]').click(joinProj);

	/* 详情页 - 加入 - 项目 */
	$('#proj-details .join input[name="join"]').click(joinProj);

	/* 首页 - 加入 - 训练营 */
	$('#wkshopOverview .workshop-single input[name="join"]').click(joinWkshop);

	/* 训练营列表页 - 加入 - 项目 */
	$('#workshops .add input[name="join"]').click(joinWkshop);

	/* 详情页 - 加入 - 训练营 */
	$('#wkshop-details .join input[name="join"]').click(joinWkshop);

});
