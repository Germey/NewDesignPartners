<!-- 发布项目 -->
<div id="publish-base">
	<div class="container">
		<div class="publish-process">
			
		</div>
		<div class="row">
			<!-- 主栏目 -->
			<div class="left col-md-8 col-xs-12">
				<div class="item ser-kind">
					<div class="title">服务类型*(*为必填项)</div>
					<div class="content">
						<ul class="list-unstyled">
							<li><input type="checkbox" value="1">单纯的项目展示（只在平台上展示，感兴趣的设计师自行联系，平台不参与项目）</li>
							<li><input type="checkbox" value="2">方案模糊，需要平台先征集方案（项目托管给平台，按照标准流程，从方案征集阶段开始）</li>
							<li><input type="checkbox" value="3">方案清晰，需要平台招募团队实现（项目托管给平台，按照标准流程，从团队征集阶段开始）</li>
							<li><input type="checkbox" value="4">项目整体外包（项目全权交由平台内部设计师团队完成，不走平台流程，效率更高，适合需求紧急型项目）</li>
						</ul>
					</div>
				</div>
				<div class="item des-kind">
					<div class="title">设计需求类别*</div>
					<div class="content">
						<ul class="list-unstyled">
							<li><input type="checkbox" value="1">商业咨询（如商业模式、设计研究等）</li>
							<li><input type="checkbox" value="2">服务策略（如服务设计，品牌设计等）</li>
							<li><input type="checkbox" value="3">界面设计（如网站、App的交互设计、视觉设计等）</li>
							<li><input type="checkbox" value="4">平面设计（如品牌VI、Logo标识、名片、海报等）</li>
						</ul>
					</div>
				</div>
				<div class="item proj_name">
					<div class="title">项目名称*</div>
					<div class="content">
						<input type="text" class="form-control text" placeholder="项目名称" name="proj_name" id="proj_name">
					</div>
				</div>
				<div class="item proj_loc">
					<div class="title">项目地点*</div>
					<div class="content">
						<input type="text" class="form-control text" placeholder="项目地点" name="proj_loc" id="proj_loc">
					</div>
				</div>
				<div class="item proj_pic">
					<div class="title">项目图片*</div>
					<div class="img"></div>
					<div class="content">
						<form id="proj-pic-upload" method="post" action="http://up.qiniu.com" name = "form" enctype="multipart/form-data" onsubmit="return isValidateFile('file');">
							<input type="hidden"  id="token" name="token"  value=<?php echo $upToken?>>
							<input type="hidden" name="key" id="key" value="<?php echo $id;?>_<?php echo time();?>">
							<input name="file"  type="file" id="file"/><br>
							<input type="button" id="sub" class="btn btn-primary" value="提交" >
							<input type="button" id="delete" class="btn btn-danger" value="删除" >
						</form>
					</div>
				</div>
				<div class="item proj_des">
					<div class="title">项目一句话描述*</div>
					<div class="content">
						<textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="item">
					<div class="title"></div>
					<div class="content">
						<input type="button" class="btn btn-primary" value="保存" name="save">
					</div>
				</div>
				<input type="hidden" value="<?php echo $_SESSION['id']?>" name="uid" id="uid">
				
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
			<input type="button" class="btn" value="上一步" disabled="disabled">
			<input type="button" class="btn btn-primary" id="next-step" value="下一步">
		</div>
	</div>
</div>
<!-- 发布基本项目内容 -->