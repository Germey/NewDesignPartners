<!-- 项目详情 -->
<div id="proj-details">
	<div class="container">
		<div class="proj-title">
			<h2><?php echo $project['name']?></h2>
		</div>
		<div class="row">
			<!-- 项目详情 -->
			<div class="left col-md-8 col-xs-12">
				<div class="brief">
					<div><img class="img" src="<?php echo $project['large_image'];?>"></div>
					<div class="content"><?php echo $project['brief']; ?></div>
				</div>	
				<div class="details">
					<div class="item">
						<div class="title">项目详情</div>
						<div class="content"><?php echo $project['details']?></div>
					</div>
				</div>
			</div>
			<!-- 项目详情结束 -->
			<!-- 侧栏 -->
			<div class = "right col-md-4 col-xs-12">
				<div class="introduction">
					<div class="item">
						<p>距离该信息失效还有</p>
						<p>10天</p>
					</div>
					<div class="item">
						<p>发布方</p>
						<p>顺丰速运</p>
					</div>
					<div class="item">
						<p>联系人:张先生</p>
						<p>电话：18093823232</p>
					</div>
				</div>
				<div class="joined-designer">
					<div class="title">已经加入的设计师</div>
					<div class="item">
						<?php 
						if (count($designers) > 0) {
							foreach($designers as $item):
						?>
							<div class="single">
								<a href="<?php echo site_url();?>/designer/details/<?php echo $item['id'];?>"><img src="<?php echo $item['image']?>"></a>
								<div class="name"><a href="<?php echo site_url();?>/designer/details/<?php echo $item['id'];?>"><?php echo $item['name']?></a></div>
							</div>
							<?php endforeach;
						} else { ?>
						  <div class="none">暂无加入者</div>
						<?php
						}
						?> 
					</div>
				</div>
			</div>
			<!-- 侧栏结束 -->
		</div>
	</div>
</div>
<!-- 项目详情结束 -->