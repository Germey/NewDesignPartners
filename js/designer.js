/*
	名称：设计师个人页面处理JS
	作者：崔庆才
	时间：2015/5/28
*/

function getDesignerId() {
	var url = window.location.href;
	urls = url.split('/');
	id = urls[urls.length-1];
	return id;
}


$(function(){
	$("#designer-details .nav-tabs a[href='#tab-my-attention']").click(function(){

		
	});
	$("#designer-details .nav-tabs a[href='#tab-my-project']").click(function(){
		var id = getDesignerId();
		$.post(getJoinedProjectsURL(), {id:id}, function(data) {
			var target = $("#tab-my-project .row");
			target.html("");
			var result = JSON.parse(data);
			$.each(result, function(index, content) {
				var item = $("<div></div>").addClass("col-md-3 col-sm-6").appendTo(target);
				$('<div class="img-wrap"><a href="'+ getSiteURL() +'/project/details/'+content.id+'"><img src="'+content.image+'"></a></div>').appendTo(item);
				$("<div>").text(content.name).addClass("name").appendTo(item);
			});
		});
	});
	$("#designer-details .nav-tabs a[href='#tab-my-works']").click(function(){
		
	});
	$("#designer-details .nav-tabs a[href='#tab-my-details']").click(function(){
		
	});

	

});