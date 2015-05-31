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
	<!-- 提示框 -->
	<div class="modal" id="mymodal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">温馨提示</h4>
				</div>
				<div class="modal-body">
					<p>提示内容</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">确定</button>
				</div>
			</div>
		</div>
	</div>
	<!-- 提示框结束 -->	
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>js/bootstrap.js"></script>
    <script src="<?php echo base_url()?>js/jquery.validate.js"></script>
    <script src="<?php echo base_url()?>js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url()?>js/jquery.form.js"></script>
    <script src="<?php echo base_url()?>js/libs.js"></script>
    <script src="<?php echo base_url()?>js/main.js"></script>
    <script src="<?php echo base_url()?>js/designer.js"></script>
    <script type="text/javascript">
    /* 返回站点路径 */
    function getSiteURL() {
    	return '<?php echo site_url();?>';
    }
    /* 返回基础路径 */
    function getBaseURL() {
    	return '<?php echo base_url();?>';
    }
    </script>
	</body>
</html>