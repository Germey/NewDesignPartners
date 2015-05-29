<!-- 设计师列表 -->
<div id="designers">
	<div class="container">
		<div class="row">
			<?php foreach($designers as $item):?>
				<div class="col-md-4 col-xs-6 col-xx-12">
					<div class="single">
						<div><a href="<?php echo site_url();?>/designer/details/<?php echo $item['id'];?>"><img src="<?php echo $item['image']?>" class="img"></a></div>
						<div class="name"><?php echo $item['name']?></div>
						<div class="sex">
							<?php if ($item['sex'] == 0) { ?>
								未知性别
							<?php } else if($item['sex']==1) { ?>
								男	
							<?php } else if($item['sex']==2) { ?>
								女
							<?php }?>
						</div>
						<div class="information"><a href="<?php echo site_url();?>/designer/details/<?php echo $item['id'];?>">个人中心</a></div>
					</div>
				</div>
			<?php endforeach;?> 
		</div>
		<div class="pagi">
			<ul class="pagination pagination-sm">
				<?php echo $paginations;?>
			</div>
		</div>
	</div> 
	</div>
</div>
<!-- 设计师列表结束 -->