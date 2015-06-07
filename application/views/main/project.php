<!-- 项目概览 -->
<div id="projOverview">
	<div class="container">
		<div class="block-header flow-hidden">
			<div class="title pull-left"><h2>项目</h2></div>
			<div class="more pull-right"><a href="#"><h4>更多</h4></a></div>
		</div>
		<div class="content">
			<div class="row">
				<?php if($projects):foreach($projects as $project):?>
					<div class="col-sm-6 col-xs-12">
						<div class = "project-single">
							<div class="row">
								<div class="col-md-7 col-sm-12 col-xs-7 col-xx-12">
									<div class = "pre-img">
										<a href = "<?php echo site_url();?>/project/details/<?php echo $project['id']?>">
											<img src = <?php echo $project['image']?> />
										</a>
										<div class="join"><input type="button" class="btn btn-primary" value="加入项目"></div>
									</div>
									<div class = "name">
										<a href = "<?php echo site_url();?>/project/details/<?php echo $project['id']?>"><?php echo $project['name']?></a>
									</div>
								</div>
								<div class="col-md-5 col-sm-12 col-xs-5 col-xx-12">
									<div class = "introduction">
										<div class ="location">
											地点:<?php echo $project['location']?>
										</div>
										<div class ="recruit">
											招募:<br><?php echo $project['recruit']?>
										</div>
										<div class ="enddate">
											距报名结束还有<span><?php echo $project['day_des'];?></span>天
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach;endif;?>
			</div>
		</div>
	</div>
</div>
<!-- 项目概览结束 -->