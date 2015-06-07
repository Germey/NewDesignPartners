<!-- 训练营概览 -->
<div id="sampleOverview">
	<div class="container">
		<div class="block-header flow-hidden">
			<div class="title pull-left"><h2>成功案例</h2></div>
		</div>
		<div class="content">
			<div class="row">
				<?php if($samples):foreach($samples as $sample):?>
					<div class="col-xs-4 col-xx-12">
						<div class="sample-single">
							<div class = "img"><a href = "<?php echo site_url();?>/sample/details/<?php echo $sample['id'];?>"><img src = <?php echo $sample['image']?>></a></div>
							<div class = "name"><a href = "<?php echo site_url();?>/sample/details/<?php echo $sample['id'];?>"><?php echo $sample['name']?></a></div>
						</div>
					</div>
				<?php endforeach;endif;?>
			</div>
		</div>
	</div>
</div>
<!-- 训练营概览结束 -->