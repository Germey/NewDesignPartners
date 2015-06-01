/*
	名称：JS通用处理函数
	作者：崔庆才
	时间：2015/5/26
*/

/* 检查手机号是否合法 */
function phoneValidate(value) {
	/* 此处两次取非的原因是将正则匹配的结果转为布尔 */
	return !(!(value.length == 11) || (!value.match(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|17[0|6|7|8]|18[0-9])\d{8}$/)));
}

/* 检查输入姓名是否合法 */
function nameValidate(value) {  
	var containSpecial = RegExp(/[(\ )(\~)(\!)(\@)(\#)(\$)(\%)(\^)(\&)(\*)(\()(\))(\-)(\_)(\+)(\=)(\[)(\])(\{)(\})(\|)(\\)(\;)(\:)(\')(\")(\,)(\.)(\/)(\<)(\>)(\?)(\)]+/);      
	if (!containSpecial.test(value)&&value.length>=2) {
		return true;
	} else {
		return false;
	}      
}

/* 检查输入日期是否合法 */
function dateValidate(value) {  
	var containSpecial = RegExp(/[(\~)(\!)(\@)(\#)(\$)(\%)(\^)(\&)(\*)(\()(\))(\-)(\_)(\+)(\=)(\[)(\])(\{)(\})(\|)(\\)(\;)(\')(\")(\,)(\.)(\<)(\>)(\?)(\)]+/);      
	if (!containSpecial.test(value)&&value.length>=2) {
		return true;
	} else {
		return false;
	}      
}

/* 检查输入密码是否合法 */
function passwordValidate(value) {  
	var containSpecial = RegExp(/[(\ )(\~)(\!)(\@)(\#)(\$)(\%)(\^)(\&)(\*)(\()(\))(\-)(\_)(\+)(\=)(\[)(\])(\{)(\})(\|)(\\)(\;)(\:)(\')(\")(\,)(\.)(\/)(\<)(\>)(\?)(\)]+/);      
	if (!containSpecial.test(value) && value.length >= 6) {
		return true;
	} else {
		return false;
	}      
}

/* 检查确认密码是否合法 */
function confirmValidate(password, confirm) {
	return (password == confirm) && (confirm.length >= 6);
}

/* 检查验证码是否合法 */
function checkcodeValidate(value, url) {
	$.post(url, {checkcode:value}, function(data) {
		if (data == '1') {
			checkResult = 1;
		} else {
			checkResult = 0;
		}
	});
}

/* 调出提示框，输入内容 */
function message(content) {
	$("#mymodal").modal("show");
	$("#mymodal .modal-body p").html(content);
	$("#mymodal button").click(function() {
		$("#mymodal").modal("hide");
		$(".label label script").remove();
	});
}

/* 分页包含一层<li> */
function wrapPagination() {
	$(".pagi ul strong").wrapAll("<a></a>");
	$(".pagi ul a").each(function() {
		$(this).wrapAll("<li></li>");
	});
	
}

/* 检查复选框的合法性 */
function checkBoxValidate(groups) {
	var arr = new Array();
	$.each(groups, function(index, content) {
		if (content.checked) {
			arr.push(content.value);
		}
	});
	/* 数组形式返回选中的元素 */
	if (arr.length != 0) {
		return arr;
	} else {
		return false;
	}
}


/* 检查复选框的合法性 */
function checkSingleBoxValidate(groups) {
	var arr = new Array();
	$.each(groups, function(index, content) {
		if (content.checked) {
			arr.push(content.value);
		}
	});
	/* 数组形式返回选中的元素 */
	if (arr.length == 1) {
		return arr;
	} else {
		return false;
	}
}

/* 检查上传的文件是否合法 */
function isValidateFile() { 
	var extend = document.form.file.value.substring(document.form.file.value.lastIndexOf(".") + 1);
	if (extend == "") {
		message("请选择头像");
		return false;
	}
	else {
		if (!(extend == "jpg" || extend == "png")) {
		message("请上传后缀名为jpg或png的文件!");
		return false;
		}
	}
	return true;
}

/* 表单输入验证变化 */
function formInputChange(success, input) {
	if(!success) {
		input.removeClass("has-success").addClass("has-error");
	} else {
		input.removeClass("has-error").addClass("has-success");
	}
}

/* 通过URL获取项目id */
function getProjId() {
	var url = window.location.href;
	urls = url.split('/');
	id = urls[urls.length-1];
	return id;
}

/* 获得错误提示的图片 */
function getWrongPic() {
	return getBaseURL() + 'images/wrong.png';
}
/* 获得正确提示的图片 */
function getRightPic() {
	return getBaseURL() + 'images/right.png';
}
/* 验证码检验 */
function getCodeCheckURL() {
	return getSiteURL() + '/register/codeCheck';
}
/* 验证邮箱是否存在 */
function getEmailExistsURL() {
	return getSiteURL() + '/register/emailExists';
}
/* 验证手机是否存在 */
function getPhoneExistsURL() {
	return getSiteURL() + '/register/phoneExists';
}
/* 验证邮箱是否完成注册 */
function getEmailRegisteredURL() {
	return getSiteURL() + '/login/emailRegistered';
}
/* 验证密码 */
function getPasswordCheckURL() {
	return getSiteURL() + '/login/passwordCheck';
}
/* 获得已经加入的项目信息 */
function getJoinedProjectsURL() {
	return getSiteURL() + '/designer/getJoinedProjects';
}
/* 获得通过图片名获得链接 */
function getImageByKeyURL() {
	return getSiteURL() + '/project/getImageUrlByKey';
}
/* 储存基本信息 */
function getStoreBaseURL(){
	return getSiteURL() + '/project/storeBase';
}
/* 提交详细信息 */
function getPublishDetailsURL(){
	return getSiteURL() + '/project/publishDetails';
}
/* 储存详细信息 */
function getStoreDetailsURL(){
	return getSiteURL() + '/project/storeDetails';
}
/* 提交公司信息 */
function getPublishCompanyURL(){
	return getSiteURL() + '/project/publishCompany';
}
/* 储存详细信息 */
function getStoreCompanyURL(){
	return getSiteURL() + '/project/storeCompany';
}
/* 获取项目详情地址 */
function getProjDetailsURL(){
	return getSiteURL() + '/project/details';
}
/* 获取项目详情地址 */
function getFollowProjURL(){
	return getSiteURL() + '/designer/followProjOrNot';
}