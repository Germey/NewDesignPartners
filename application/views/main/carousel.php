<!-- 轮播 -->
<div id="carousel" class="carousel slide" data-ride="carousel">
	<!--轮播下方点-->
	<ol class="carousel-indicators">
		<li data-target="#carousel" data-slide-to="0" class="active"></li>
		<li data-target="#carousel" data-slide-to="1"></li>
		<li data-target="#carousel" data-slide-to="2"></li>
	</ol>
	<!-- 轮播图-->
	<div class="carousel-inner">
		<div class="item active">
			<img src="<?php echo base_url();?>images/banner5.png" alt="1 slide">
			<div class="container">
				<div class="carousel-caption">
					<div class="content">
						<h2>"PixCloud"云景 —— 艺术创作平台</h2>
						<p>团队组建6月3日———7月15日</p>
						<div class="groups">
							<a href="<?php echo site_url();?>/project/details/17"><input type="button" class="btn btn-primary" value="了解更多"></a>
							<a href="<?php echo site_url();?>/project/details/17"><input type="button" class="btn btn-primary" value="参与项目"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="item mofang">
			<img src="<?php echo base_url();?>images/banner6.png" alt="2 slide">
			<div class="container">
				<div class="carousel-caption">
					<div class="content">
						<div class="groups">
							<a href="<?php echo site_url();?>/project/details/18"><input type="button" class="btn btn-primary" value="参与项目"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="item">
			<img src="<?php echo base_url();?>images/banner7.png" alt="3 slide">
			<div class="container">
				<div class="carousel-caption">
					<div class="content">
						<h2>中美创客大赛初赛火热报名中</h2>
						<p>报名截止日期：6月19日</p>
						<div class="groups">
							<a href="http://2015.chinaus-maker.org/"><input type="button" class="btn btn-primary" value="了解更多"></a>
							<a href="http://2015.chinaus-maker.org/"><input type="button" class="btn btn-primary" value="参与项目"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- 左右箭头 -->
	<a class="left carousel-control" href="#carousel" data-slide="prev"><span
			class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#carousel" data-slide="next"><span
			class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!-- 轮播结束 -->