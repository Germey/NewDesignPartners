<!-- 个人信息页面 -->
<div id="designer-details">
	<div class="brief">
		<img src="<?php echo base_url();?>/images/designer_bg.png" alt="设计师个人信息背景">
		<div class="content">
			<div class="icon item"><img src="<?php echo $info['image'];?>"></div>
			<div class="name item"><?php echo $info['name'];?></div>
			<div class="intro item"><?php echo $info['brief'];?></div>
		</div>
	</div>
	<div class="details">
		<div class="container" id="proj">
			<ul class="nav nav-tabs" role="tablist" id="feature-tab">
				<li class="active"><a href="#tab-my-attention" role="tab" data-toggle="tab">我的关注</a></li>
				<li><a href="#tab-my-project" role="tab" data-toggle="tab">项目经历</a></li>
				<li><a href="#tab-my-works" role="tab" data-toggle="tab">个人作品</a></li>
				<li><a href="#tab-my-details" role="tab" data-toggle="tab">详细资料</a></li>
			</ul>
			<div class="tab-content">
				<!-- 我的关注 -->
				<div class="tab-pane active" id="tab-my-attention">
					<div class="container">
						<div class="row">暂无关注
						</div>
					</div>
				</div>
				<!-- 我的关注结束 -->
				<!-- 项目经历 -->
				<div class="tab-pane" id="tab-my-project">
					<div class="container">
						<div class="row">
						</div>
					</div>
				</div>
				<!-- 项目经历结束 -->
				<!-- 个人作品 -->
				<div class="tab-pane" id="tab-my-works">
					<div class="container">
						<div class="row">暂无作品
						</div>
					</div>
				</div>
				<!-- 个人作品结束 -->
				<!-- 详细资料 -->
				<div class="tab-pane" id="tab-my-details">
					<div class="container">
						<div class="row">暂无详情
						</div>
					</div>
				</div>
				<!-- 详细资料结束 -->
			</div>
		</div>
	</div>
</div>
<!-- 个人信息页面结束 -->