<!-- 发布项目详情 -->
<div id="publish-details">
	<div class="container">
		<div class="publish-process">
			
		</div>
		<div class="row">
			<!-- 主栏目 -->
			<div class="left col-md-8 col-xs-12">
				<div class="item proj_detail">
					<div class="title">项目详细介绍*</div>
					<div class="content">
						<textarea class="form-control" rows="3" name="proj_detail" id="proj_detail"></textarea>
					</div>
				</div>
				<div class="item des_need">
					<div class="title">设计需求*</div>
					<div class="content">
						<textarea class="form-control" rows="3" name="des_need" id="des_need"></textarea>
					</div>
				</div>
				<div class="item res_need">
					<div class="title">人员需求*</div>
					<div class="content">
						<textarea class="form-control" rows="3" name="res_need" id="res_need"></textarea>
					</div>
				</div>
				<div class="item time">
					<div class="title">项目时间计划*</div>
					<div class="content row">
						<div id="date-start" class="col-sm-6 input-append date ">
					      	<input class="form-control" type="text" id="start-time" name="start-time" placeholder="开始时间"></input>
					      	<span class="add-on">
					        	<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					      	</span>
					    </div>
					    <div id="date-end" class="col-sm-6 input-append date ">
					      	<input class="form-control" type="text" id="end-time" name="end-time" placeholder="结束时间"></input>
					      	<span class="add-on">
					        	<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					      	</span>
					    </div>
					</div>
				</div>
				<div class="item budget">
					<div class="title">项目预算*</div>
					<div class="content">
						<ul class="list-unstyled">
							<li><input type="checkbox" value="1">＜10,000元</li>
							<li><input type="checkbox" value="2">10,000-30,000元</li>
							<li><input type="checkbox" value="3">30,000-50,000元</li>
							<li><input type="checkbox" value="4">50,000-100,000元</li>
							<li><input type="checkbox" value="5">＞100,000元</li>
						</ul>
					</div>
				</div>
				<div class="item">
					<div class="title"></div>
					<div class="content">
						<input type="button" class="btn btn-primary" value="保存" name="save">
						<input type="hidden" value="<?php echo $proj_id?>" name="proj_id" id="proj_id">
					</div>
				</div>
			</div>
			<!-- 主栏目结束 -->
			<!-- 侧栏 -->
			<div class = "right col-md-4 col-xs-12">
				<div class="item">
					<div class="title">项目外包可直接联系平台</div>
					<div class="content">客服电话<br>400-188-6666<br>周一至周日9:00-23:00</div>
				</div>
			</div>
			<!-- 侧栏结束 -->
		</div>
		<div class="conserve">
			<input type="button" class="btn btn-primary" id="next-step" value="下一步">
		</div>
	</div>
</div>
<!-- 发布项目详情结束 -->