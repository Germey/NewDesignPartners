<!-- 项目详情 -->
<div id="sample-details">
	<div class="container">
		<div class="sample-title">
			<h2><?php echo $sample['name']?></h2>
		</div>
		<div class="row">
			<!-- 项目详情 -->
			<div class="left col-md-8 col-xs-12">
				<div class="nav">
					项目展示
				</div>
				<div class="main">
					<div class="brief">
						<div><img class="img" src="<?php echo $sample['large_image'];?>"></div>
						<div class="content"><?php echo $sample['brief']; ?></div>
					</div>	
					<div class="details">
						<?php echo $sample['details'];?>
					</div>
				</div>
			</div>
			<!-- 项目详情结束 -->
			<!-- 侧栏 -->
			<div class = "right col-md-4 col-xs-12">
				<div class="follow">
					<p class="follow-sample">+关注</p>
				</div>
				<div class = "main">
					<div class="introduction">
						<div class="item">
							<p>发布方</p>
							<?php if($sample['company_name']){?><p><?php echo $sample['company_name']?></p><?php } ?>
							<?php if($sample['company_logo']){?><p><img class="company_logo" src="<?php echo $sample['company_logo']?>"></p><?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!-- 侧栏结束 -->
		</div>
	</div>
</div>
<!-- 项目详情结束 -->