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

/* 检查邮箱是否合法 */
function emailValidate() {

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