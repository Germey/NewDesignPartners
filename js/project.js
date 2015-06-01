/*
	名称：项目处理文件
	作者：崔庆才
	时间：2015/5/31
*/


$(function() {

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

	/* 表单提交后的响应 */
	function showResponse(responseText, statusText)  { 
	    $.post(getImageByKeyURL(), {
	    	key:responseText.key
	    }, function(data) {
	    	alert(data);
	    	$("#publish-base .proj_pic .img").html("");
	    	$("<img>").addClass("proj_img").attr("src",data).appendTo("#publish-base .proj_pic .img");
	    	var oldkey = $("#publish-base .proj_pic input#key").val();
	    	var id = oldkey.split("_")[0];
	    	$("#publish-base .proj_pic input#key").val(id+"_"+new Date().getTime());
	    })
	}


	/* 提交设计需求 - 基础信息 - 下一步 */
	$('#publish-base #next-step').click(function() {

		/* 检查是否获得了一个proj_id */
		if ($("#publish-base .left #proj_id").val()) {
			window.location.href = getPublishDetailsURL()+ "/" + $("#publish-base .left #proj_id").val();
		} else {
			$('#publish-base input[name="save"]').trigger(jQuery.Event("click"));
		}
		
	});


	/* 提交设计需求 - 详细信息 */
	$('#publish-details input[name="save"]').click(function() {
		var proj_detail_res = nameValidate($("#publish-details .proj_detail textarea").val());
		formInputChange(proj_detail_res, $("#publish-details .proj_detail"));
		var des_need_res = nameValidate($("#publish-details .des_need textarea").val());
		formInputChange(des_need_res, $("#publish-details .des_need"));
		var res_need_res = nameValidate($("#publish-details .res_need textarea").val());
		formInputChange(res_need_res, $("#publish-details .res_need"));
		var proj_time_start = dateValidate($("#publish-details #start-time").val());
		formInputChange(proj_time_start, $("#publish-details #date-start"));
		var proj_time_end = dateValidate($("#publish-details #end-time").val());
		formInputChange(proj_time_end, $("#publish-details #date-end"));
		var budget_res = checkSingleBoxValidate($('#publish-details .budget input[type="checkbox"]'));
		if (!budget_res) {
			message("请选择一项项目预算");
		}
		if (proj_detail_res&&des_need_res&&res_need_res&&proj_time_start&&proj_time_end&&budget_res){
			$.post(getStoreDetailsURL(), {
			proj_detail: $("#publish-details .proj_detail textarea").val(),
			des_need:  $("#publish-details .des_need textarea").val(),
			res_need: $("#publish-details .res_need textarea").val(),
			start_time: $("#publish-details #start-time").val(),
			end_time: $("#publish-details #end-time").val(),
			budget: budget_res.join(","),
			proj_id: $("#publish-details input#proj_id").val()
		}, function(data) {
			if (data != "0") {
				message("恭喜您保存成功");
				$("#publish-details .left").append($('<input type="hidden" name="update" id="update" value="1">'));
			}
		});
		}
		

	});
	
	/* 提交设计需求 - 详细信息 - 下一步 */
	$('#publish-details #next-step').click(function() {

		if ($("#publish-details .left #update").val()) {
			window.location.href = getPublishCompanyURL()+ "/" + $("#publish-details .left #proj_id").val();
		} else {
			$('#publish-details input[name="save"]').trigger(jQuery.Event("click"));
		}
		
	});
	


	/* 提交设计需求 - 公司信息 - LOGO上传 */
	$('#publish-company #company-logo-upload #sub').click(function() {
		var options = {  
			beforeSubmit: isValidateFile,
	        success: showResponseLogo,  
	        resetForm: true, 
	        dataType: 'json' 
	    };
		$('#company-logo-upload').ajaxSubmit(options);
	});

	$('#publish-company #company-logo-upload #delete').click(function() {
		var proj_loc_res = $("#publish-company .company-logo .img").html() == ""? false : true;
		if (!proj_loc_res) {
			message("请先上传图片");
		} else {
			$("#publish-company .company-logo .img").html("");
		}
	});

	/* 表单提交后的响应 */
	function showResponseLogo(responseText, statusText)  { 
	    $.post(getImageByKeyURL(), {
	    	key:responseText.key
	    }, function(data) {
	    	$("#publish-company .company-logo .img").html("");
	    	$("<img>").addClass("proj_img").attr("src",data).appendTo("#publish-company .company-logo .img");
	    	var oldkey = $("#publish-company .company-logo input#key").val();
	    	var id = oldkey.split("_")[0];
	    	$("#publish-company .company-logo input#key").val(id+"_"+new Date().getTime());
	    })
	}



	/* 提交设计需求 - 公司信息 */
	$('#publish-company input[name="save"]').click(function() {
		var company_name_res = nameValidate($("#publish-company .company-name input").val());
		formInputChange(company_name_res, $("#publish-company .company-name"));
		var company_location_res = nameValidate($("#publish-company .company-location input").val());
		formInputChange(company_location_res, $("#publish-company .company-location"));
		var charge_person_res = nameValidate($("#publish-company .charge-person input").val());
		formInputChange(charge_person_res, $("#publish-company .charge-person"));
		var charge_phone_res = nameValidate($("#publish-company .charge-phone input").val());
		formInputChange(charge_phone_res, $("#publish-company .charge-phone"));
		var company_log_res = $("#publish-company .company-logo .img").html() == ""? false : true;
		if (!company_log_res) {
			message("请选择公司LOGO");
		}else if (company_name_res&&company_location_res&&charge_person_res&&charge_phone_res) {
			$.post(getStoreCompanyURL(), {
			company_name: $("#publish-company .company-name input").val(),
			company_location:  $("#publish-company .company-location input").val(),
			charge_person: $("#publish-company .charge-person input").val(),
			charge_phone: $("#publish-company .charge-phone input").val(),
			charge_email: $("#publish-company .charge-email input").val(),
			company_logo: $("#publish-company .company-logo .img img").attr("src"),
			proj_id: $("#publish-company input#proj_id").val()
		}, function(data) {
			if (data != "0") {
				message("恭喜您保存成功");
				$("#publish-company .left").append($('<input type="hidden" name="update" id="update" value="1">'));
			}
		});
		}
		

	});

	
	/* 提交设计需求 - 详细信息 - 下一步 */
	$('#publish-company #sub-proj').click(function() {

		if ($("#publish-company .left #update").val()) {
			message("恭喜您的需求已经发布成功");
			window.location.href = getProjDetailsURL() + "/" + $("#publish-company .left #proj_id").val();
		} else {
			$('#publish-company input[name="save"]').trigger(jQuery.Event("click"));
		}
		
	});


});