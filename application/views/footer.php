	<!-- 尾部 -->
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-4 col-xx-12">
					<div class = "design-partner block">
					  <ul>
						<div class="title"><b>设计合伙人</b></div>
					    <li><a href="">关于我们</a></li>
					    <li><a href="">联系我们</a></li>
					    <li><a href="">加入我们</a></li>
					    <li><a href="">意见反馈</a></li>
					  </ul>
					</div>
				</div>
				<div class="col-xs-4 col-xx-12">
					<div class="problems block">
					  <ul>
						<div class="title"><b>常见问题</b></div>
					    <li><a href="">常见问题</a></li>
					    <li><a href="">服务条款</a></li>
					  </ul>
					</div>
				</div>
				<div class="col-xs-4 col-xx-12">
					<div class="contact_us block">
					  <div class="title"><b>关注我们</b></div>
					  <div class="img"><img src="<?php echo base_url()?>/images/us.jpg"></div>
					</div>
				</div>
			</div>
			<div class="row" id="copyright">
				<div class="content">
						Cooyright © 2014 北京钉趣网络科技有限公司 designpartners.cn 版权所有 All rights reserved 京ICP备14025430号
				</div>
			</div>
		</div>
	</div>
	<!-- 尾部结束 -->	
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>js/bootstrap.js"></script>
    <script src="<?php echo base_url()?>js/main.js"></script>
    <script src="<?php echo base_url()?>js/libs.js"></script>
    <script type="text/javascript">
	function getWrongPic() {
		return '<?php echo base_url();?>images/wrong.png';
	}
	function getRightPic() {
		return '<?php echo base_url();?>images/right.png';
	}
	function getCodeCheckURL() {
		return '<?php echo site_url();?>/register/codeCheck';
	}
    </script>
	</body>
</html>