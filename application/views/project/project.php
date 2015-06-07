<!-- 项目列表 -->
<div id="projects">
	<div class = "container">
	<?php foreach($projects as $project):?>
		<div class="single">
			<div class="row">
				<a href="<?php echo site_url();?>/project/details/<?php echo $project['id'];?>">
					<div class="col-md-4 col-sm-6">
						<div class="intro-img">
							<img class="intro-img" src="<?php echo $project['image']?>"/>
						</div>
					</div>
					<div class="col-md-8 col-sm-6">
						<div class="title item">
							<?php echo $project['name'];?>
							<p class="follow-project">+关注</p>
						</div>
						<div class="brief item">
							<?php 
							   $str;
							   if(strlen($project['brief']) > 400){
								  $str = substr($project['brief'],0,400)."...";
							   }else{
								  $str = $project['brief'];
							   }
							   echo $str;
							?>
						</div>
						<div class="location item">
							地点:<?php echo $project['location'];?>
						</div>
						<div class="recruit item">
							招募:<?php echo $project['recruit'];?>
						</div>
						<div class="date item">
							距报名结束还有<span><?php echo $project['day_des'];?></span>天
						</div>
						<div class="add item">
							<input type="button" class="btn btn-primary" value="参与项目">
						</div>
					</div>
				</a>
			</div>
		</div>
	<?php endforeach;?> 
	<div class="pagi">
			<ul class="pagination pagination-sm">
				<?php echo $paginations;?>
			</div>
		</div>
	</div> 
</div>
<!-- 项目列表结束 -->