<!-- 训练营列表 -->
<div id="workshops">
	<div class="container">
	<?php foreach($workshops as $workshop):?>
		<div class="single">
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<a href="<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>">
						<div class="intro-img">
							<img class="intro-img" src="<?php echo $workshop['image']?>"/>
						</div>
					</a>
				</div>
				<div class="col-md-8 col-sm-6 items">
					<div class="title item">
						<a href="<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>">
							<?php echo $workshop['name'];?>
						</a>
						<?php if (!$workshop['attention']) { ?>
						<p class="follow-workshop" wkshop="<?php echo $workshop['id'];?>">+关注</p>
						<?php } else { ?>
						<p class="follow-workshop" wkshop="<?php echo $workshop['id'];?>">取消关注</p>
						<?php } ?>
					</div>
					<a href="<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>">
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
					<div class="end item">
						<?php if($workshop['state'] == 1) {?>
							已结束
						<?php } else { ?>
							报名截止：<?php echo $workshop['end_date'];?>
						<?php } ?>
					</div>
					</a>
					<div class="date item">
						<?php if($workshop['state'] == 1) {?>
							起始日期：<?php echo $workshop['start_date']?>至<?php echo $workshop['end_date'];?>
						<?php } else { ?>
							距报名结束还有<span><?php echo $workshop['day_des'];?></span>天
						<?php } ?>
					</div>
					<div class="add item">
						<?php if ($workshop['redirect']) { ?>
						<input type="button" class="btn btn-primary" value="立即参与" name="join" redirect="<?php echo $workshop['redirect']?>" >
						<?php } else if ($workshop['state'] == 1) { ?>
						<input type="button" class="btn" value="已圆满结束" name="joined" disabled="disabled">
						<?php } else if ($workshop['joined']) { ?>
						<input type="button" class="btn btn-primary" value="已参与" name="joined">
						<?php } else if ($workshop['redirect'] == 0) { ?>
						<input type="button" class="btn btn-primary" value="立即参与" name="join" wkshop="<?php echo $workshop['id']?>">
						<?php } ?>
					</div>
				</div>
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