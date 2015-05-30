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

	/* 提交设计需求 - 基础信息 */
	$('#publish-base input[name="save"]').click(function() {
		var ser_kind_res = checkBoxValidate($('#publish-base .ser-kind input[type="checkbox"]'));
		var des_kind_res = checkBoxValidate($('#publish-base .des-kind input[type="checkbox"]'));
		var proj_name_res = nameValidate($("#publish-base input#proj_name").val());
		formInputChange(proj_name_res, $("#publish-base .proj_name"));
		var proj_loc_res = nameValidate($("#publish-base input#proj_loc").val());
		formInputChange(proj_loc_res, $("#publish-base .proj_loc"));
		var proj_pic_res = $("#publish-base .proj_pic .img").html() == ""? false : true;
		formInputChange(proj_pic_res, $("#publish-base .proj_pic"));
		var proj_des_res = nameValidate($("#publish-base .proj_des textarea").val());
		formInputChange(proj_des_res, $("#publish-base .proj_des"));
		if (!ser_kind_res) {
			message("请选择服务类型");
		} else if (!des_kind_res) {
			message("请选择设计需求类别");
		} else if (!proj_pic_res) {
			message("请上传项目图片");
		} else {
			$.post(getStoreBaseURL(), {
				ser_kind: ser_kind_res.join(","),
				des_kind: des_kind_res.join(","),
				proj_name: $("#publish-base input#proj_name").val(),
				proj_loc: $("#publish-base input#proj_loc").val(),
				proj_pic: $("#publish-base .proj_pic img").attr("src"),
				proj_des: $("#publish-base .proj_des textarea").val(),
				uid: $("#publish-base input#uid").val()
			}, function(data) {
				if (data != "0") {
					message("恭喜您保存成功");
					$("#publish-base .left").append($('<input type="hidden" name="proj_id" id="proj_id" value="'+data+'">'));
				}
			});
		}

	});

	$('#publish-base #proj-pic-upload #sub').click(function() {
		var options = {  
			beforeSubmit: isValidateFile,
	        success: showResponse,  
	        resetForm: true, 
	        dataType: 'json' 
	    };
		$('#proj-pic-upload').ajaxSubmit(options);
	});

	$('#publish-base #proj-pic-upload #delete').click(function() {
		var proj_loc_res = $("#publish-base .proj_pic .img").html() == ""? false : true;
		if (!proj_loc_res) {
			message("请先上传图片");
		} else {
			$("#publish-base .proj_pic .img").html("");
		}
	});

	function showResponse(responseText, statusText)  { 
	    $.post(getImageByKeyURL(), {
	    	key:responseText.key
	    }, function(data) {
	    	$("#publish-base .proj_pic .img").html("");
	    	$("<img>").addClass("proj_img").attr("src",data).appendTo("#publish-base .proj_pic .img");
	    	var oldkey = $("#publish-base .proj_pic input#key").val();
	    	var id = oldkey.split("_")[0];
	    	$("#publish-base .proj_pic input#key").val(id+"_"+new Date().getTime());
	    })
	}


	$('#publish-base #next-step').click(function() {

		if ($("#publish-base .left #proj_id").val()) {
			window.location.href = getPublishDetailsURL()+ "/" + $("#publish-base .left #proj_id").val();
		} else {
			$('#publish-base input[name="save"]').trigger(jQuery.Event("click"));
		}
		
	});


	/* 提交设计需求 - 详细信息 */
	$('#publish-details input[name="save"]').click(function() {
		alert("dd");
		var proj_detail_res = nameValidate($("#publish-details .proj_detail textarea").val());
		formInputChange(proj_detail_res, $("#publish-details .proj_detail"));
		var des_need_res = nameValidate($("#publish-details .des_need textarea").val());
		formInputChange(des_need_res, $("#publish-details .des_need"));
		var res_need_res = nameValidate($("#publish-details .res_need textarea").val());
		formInputChange(res_need_res, $("#publish-details .res_need"));
		var proj_time_res = nameValidate($("#publish-details #proj_time").val());
		formInputChange(proj_time_res, $("#publish-details .time"));
		if (proj_detail_res&&des_need_res&&res_need_res&&proj_time_res){
			$.post(getStoreDetailsURL(), {
			proj_detail: $("#publish-details .proj_detail textarea").val(),
			des_need:  $("#publish-details .des_need textarea").val(),
			res_need: $("#publish-details .res_need textarea").val(),
			proj_time: $("#publish-details #proj_time").val(),
			proj_id: $("#publish-details input#proj_id").val()
		}, function(data) {
			if (data != "0") {
				message("恭喜您保存成功");
				$("#publish-details .left").append($('<input type="hidden" name="proj_id" id="proj_id" value="'+data+'">'));
			}
		});
		}
		

	});

		

});
