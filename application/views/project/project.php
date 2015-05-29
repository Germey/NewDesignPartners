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
						<div class="number item">
							人数:<?php echo $project['max'];?>
						</div>
						<div class="date item">
							报名截止:<?php echo date('Y.m.d', strtotime($project['end_date']));?>
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