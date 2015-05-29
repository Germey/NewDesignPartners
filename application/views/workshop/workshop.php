<!-- 训练营列表 -->
<div id="workshops">
	<div class="container">
	<?php foreach($workshops as $workshop):?>
		<div class="single">
			<div class="row">
				<a href="<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>">
					<div class="col-md-4 col-sm-6">
						<div class="intro-img">
							<img class="intro-img" src="<?php echo $workshop['image']?>"/>
						</div>
					</div>
					<div class="col-md-8 col-sm-6">
						<div class="title item">
							<?php echo $workshop['name'];?>
						</div>
						<div class="brief item">
							<?php 
							   $str;
							   if(strlen($workshop['brief']) > 400){
								  $str = substr($workshop['brief'],0,400)."...";
							   }else{
								  $str = $workshop['brief'];
							   }
							   echo $str;
							?>
						</div>
						<div class="location item">
							地点:<?php echo $workshop['location'];?>
						</div>
						<div class="number item">
							人数:<?php echo $workshop['max'];?>
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
<!-- 训练营列表结束 -->