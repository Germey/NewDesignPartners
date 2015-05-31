<!-- 发布项目详情 -->
<div id="publish-company">
	<div class="container">
		<div class="publish-process">
			
		</div>
		<div class="row">
			<!-- 主栏目 -->
			<div class="left col-md-8 col-xs-12">
				<div class="item company-name">
					<div class="title">公司/企业名*</div>
					<div class="content">
						<input type="text" class="form-control text" placeholder="公司/企业名" name="company-name" id="company-name">
					</div>
				</div>
				<div class="item company-logo">
					<div class="title">企业LOGO*</div>
					<div class="img"></div>
					<div class="content">
						<form id="company-logo-upload" method="post" action="http://up.qiniu.com" name = "form" enctype="multipart/form-data" onsubmit="return isValidateFile('file');">
							<input type="hidden"  id="token" name="token"  value=<?php echo $upToken?>>
							<input type="hidden" name="key" id="key" value="<?php echo $id;?>_<?php echo time();?>">
							<input name="file"  type="file" id="file"/><br>
							<input type="button" id="sub" class="btn btn-primary" value="提交" >
							<input type="button" id="delete" class="btn btn-danger" value="删除" >
						</form>
					</div>
				</div>
				<div class="item company-location">
					<div class="title">企业所在点*</div>
					<div class="content">
						<input type="text" class="form-control text" placeholder="企业所在点" name="company-location" id="company-location">
					</div>
				</div>
				<div class="item charge-person">
					<div class="title">联系人姓名*</div>
					<div class="content">
						<input type="text" class="form-control text" placeholder="联系人姓名" name="charge-person" id="charge-person">
					</div>
				</div>
				<div class="item charge-phone">
					<div class="title">联系方式*</div>
					<div class="content">
						<input type="text" class="form-control text" placeholder="联系方式" name="charge-phone" id="charge-phone">
					</div>
				</div>
				<div class="item charge-email">
					<div class="title">联系邮箱</div>
					<div class="content">
						<input type="text" class="form-control text" placeholder="联系邮箱" name="charge-email" id="charge-email">
					</div>
				</div>
				<div class="item save">
					<div class="title"></div>
					<div class="content">
						<input type="button" class="btn btn-primary" value="保存" name="save" id="save">
						<input type="hidden" value="<?php echo $proj_id?>" name="proj_id" id="proj_id">
					</div>
				</div>
			</div>
			<!-- 主栏目结束 -->
			<!-- 侧栏 -->
			<div class = "right col-md-4 col-xs-12">
				<div class="item">
					<div class="title">项目外包可直接联系平台</div>
					<div class="content">客服电话<br>400-188-6666<br>周一至周日9:00-23:00</div>
				</div>
			</div>
			<!-- 侧栏结束 -->
		</div>
		<div class="conserve">
			<input type="button" class="btn btn-primary" value="提交" name="sub-proj" id="sub-proj">
		</div>
	</div>
</div>
<!-- 发布项目详情结束 -->