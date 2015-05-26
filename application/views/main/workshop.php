<!-- 训练营概览 -->
<div id="wkshopOverview">
	<div class="container">
		<div class="block-header flow-hidden">
			<div class="title pull-left"><h2>训练营</h2></div>
			<div class="more pull-right"><a href="#"><h4>更多</h4></a></div>
		</div>
		<div class="content">
			<div class="row">
				<?php if($workshops):foreach($workshops as $workshop):?>
					<div class="col-xs-4 col-xx-12">
						<div class="workshop-single">
							<div class = "img"><a href = "<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>"><img src = <?php echo $workshop['image']?>></a></div>
							<div class = "name"><a href = "<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>"><?php echo $workshop['name']?></a></div>
						</div>
					</div>
				<?php endforeach;endif;?>
			</div>
		</div>
	</div>
</div>
<!-- 训练营概览结束 -->