<!-- 项目详情 -->
<div id="wkshop-details">
	<div class="container">
		<div class="wkshop-title">
			<h2><?php echo $workshop['name']?></h2>
		</div>
		<div class="row">
			<!-- 项目详情 -->
			<div class="left col-md-8 col-xs-12">
				<div class="nav">
					项目详情
				</div>
				<div class="main">
					<div class="brief">
						<div><img class="img" src="<?php echo $workshop['large_image'];?>"></div>
						<div class="content"><?php echo $workshop['brief']; ?></div>
					</div>	
					<div class="details">
						<?php if($workshop['background']):?>
							<div class="item">
								<div class="title">背景介绍</div>
								<div class="content"><?php echo $workshop['background']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['organization']):?>
							<div class="item">
								<div class="title">组织机构</div>
								<div class="content"><?php echo $workshop['organization']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['brief']):?>
							<div class="item">
								<div class="title">简介</div>
								<div class="content"><?php echo $workshop['brief']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['details']):?>
							<div class="item">
								<div class="title">详细介绍</div>
								<div class="content"><?php echo $workshop['details']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['process']):?>
							<div class="item">
								<div class="title">流程描述</div>
								<div class="content"><?php echo $workshop['process']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['join_explain']):?>
							<div class="item">
								<div class="title">报名说明</div>
								<div class="content"><?php echo $workshop['join_explain']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['prize']):?>
							<div class="item">
								<div class="title">奖金及证书</div>
								<div class="content"><?php echo $workshop['prize']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['sponsor']):?>
							<div class="item">
								<div class="title">主办方声明</div>
								<div class="content"><?php echo $workshop['sponsor']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['com_loc']):?>
							<div class="item">
								<div class="title">大赛场地</div>
								<div class="content"><?php echo $workshop['com_loc']?></div>
							</div>
						<?php endif ?>
						<?php if($workshop['contact']):?>
							<div class="item">
								<div class="title">联系方式</div>
								<div class="content"><?php echo $workshop['contact']?></div>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
			<!-- 项目详情结束 -->
			<!-- 侧栏 -->
			<div class = "right col-md-4 col-xs-12">
				<div class="follow">
					<?php if (!$attention) { ?>
					<p class="follow-workshop" wkshop="<?php echo $workshop['id'];?>">+关注</p>
					<?php } else { ?>
					<p class="follow-workshop" wkshop="<?php echo $workshop['id'];?>">取消关注</p>
					<?php } ?>
					<input type="hidden" value="<?php echo $workshop['id']?>" id="wkshop_id">
				</div>
				<div class = "main">
					<div class="introduction">
						<div class="item join">
							<?php if($workshop['state'] == 1){?>
								<input type="button" class="btn" value="已结束" disabled="disabled">
							<?php } else if($joined) { ?>
								<input type="button" class="btn btn-primary" value="已参与" name="joined">
							<?php } else { ?>
								<input type="button" class="btn btn-primary" value="立即参与" name="join" wkshop="<?php echo $workshop['id'];?>">
							<?php } ?>
						</div>
					</div>
					<div class="joined-designer">
						<div class="title">已经报名</div>
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
			</div>
			<!-- 侧栏结束 -->
		</div>
	</div>
</div>
<!-- 项目详情结束 -->