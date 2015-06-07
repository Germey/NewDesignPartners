<!-- 训练营概览 -->
<div id="wkshopOverview">
	<div class="container">
		<div class="block-header flow-hidden">
			<div class="title pull-left"><h2>训练营</h2></div>
			<div class="more pull-right"><a href="<?php echo site_url()?>/workshop"><h4>更多</h4></a></div>
		</div>
		<div class="content">
			<div class="row">
				<?php if($workshops):foreach($workshops as $workshop):?>
					<div class="col-xs-4 col-xx-12">
						<div class="workshop-single">
							<div class = "img">
								<a href = "<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>">
									<img src = <?php echo $workshop['image']?>>
								</a>
								<div class="join" style="display: none">
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
							<div class = "name"><a href = "<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>"><?php echo $workshop['name']?></a></div>
						</div>
					</div>
				<?php endforeach;endif;?>
			</div>
		</div>
	</div>
</div>
<!-- 训练营概览结束 -->