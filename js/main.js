/*
	名称：JS主要处理文件
	作者：崔庆才
	时间：2015/5/26
*/
/* 检查合法性的全局变量 */
var checkResult;

$(function(){


	/* 检查注册信息是否合法 */
	function checkRegister() {

		var value = $(this).val();
		switch ($(this).attr("name")) {
			case "email":
				break;
			case "name":
				checkResult = nameValidate(value);
				break;
			case "phone":
				checkResult = phoneValidate(value);
				break;
			case "checkcode":
				/* 验证码比较特殊 */
				$.post(getCodeCheckURL(), {checkcode:value}, function(data) {
					if (data == 1) {
						checkResult = 1;
						$("#register #checkcode").parent().next().children(".label").html("<img src="+getRightPic()+">");
					} else {
						checkResult = 0;
						$("#register #checkcode").parent().next().children(".label").html("<img src="+getWrongPic()+">");
					}
				});
				break;
			case "password":
				checkResult = passwordValidate(value);
				break;
			case "confirm":
				var password = $("#register #password").val();
				checkResult = confirmValidate(password, value);
				break;
		}
		/* 显示检查结果 */
		if (checkResult) {
			$(this).parent().next().children(".label").html("<img src="+getRightPic()+">");
		} else {
			$(this).parent().next().children(".label").html("<img src="+getWrongPic()+">");
		}
	}

	/* 注册输入框变化时监测 */
	$("#register input").bind("input propertychange", checkRegister);
	/* 注册按钮点击时 */
	$("#register #sub").bind("click", function() {
		$("#register input").trigger("propertychange");
	});

});