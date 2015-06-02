<!-- 设计师概览 -->
<div id="desOverview">
	<div class="container">
		<div class="block-header flow-hidden">
			<div class="title pull-left"><h2>本周推荐设计师</h2></div>
			<div class="more pull-right"><a href="#"><h4>更多</h4></a></div>
		</div>
		<div class="content">
			<div class="row">
				<?php if($designers):foreach($designers as $designer):?>
					<div class="col-md-3 col-xs-6 col-xx-12">
						<a href="<?php echo site_url();?>/designer/details/<?php echo $designer['id']?>">
							<div class = "designer-single">
								<div class="img">
									<img src="<?php echo $designer['image'];?>">
									<p class="name"><?php echo $designer['name'];?></p>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach;endif;?>
			</div>
		</div>
	</div>
</div>
<!-- 项目概览结束 -->