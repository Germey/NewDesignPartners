<!-- 项目详情 -->
<div id="proj-details">
	<div class="container">
		<div class="proj-title">
			<h2><?php echo $project['name']?></h2>
		</div>
		<div class="row">
			<!-- 项目详情 -->
			<div class="left col-md-8 col-xs-12">
				<div class="nav">
					项目详情
				</div>
				<div class="main">
					<div class="brief">
						<div><img class="img" src="<?php echo $project['large_image'];?>"></div>
						<div class="content"><?php echo $project['brief']; ?></div>
					</div>	
					<div class="details">
						<div class="item">
							<div class="title">项目详情</div>
							<div class="content"><?php echo $project['details']?></div>
						</div>
					</div>
					<div class="details">
						<div class="item">
							<div class="title">项目地点</div>
							<div class="content"><?php echo $project['location']?></div>
						</div>
					</div>
					<div class="details">
						<div class="item">
							<div class="title">服务类型</div>
							<div class="content"><?php 
								$kinds = explode(",", $project['ser_kind']);
								foreach ($kinds as $kind) {
									switch ($kind) {
										case 1:
											echo "单纯的项目展示（只在平台上展示，感兴趣的设计师自行联系，平台不参与项目）";
											break;
										case 2:
											echo "方案模糊，需要平台先征集方案（项目托管给平台，按照标准流程，从方案征集阶段开始）";
											break;
										case '3':
											echo "方案清晰，需要平台招募团队实现（项目托管给平台，按照标准流程，从团队征集阶段开始）";
											break;
										case '4':
											echo "项目整体外包（项目全权交由平台内部设计师团队完成，不走平台流程，效率更高，适合需求紧急型项目）";
											break;
									}
								}
							?></div>
						</div>
					</div>
					<div class="details">
						<div class="item">
							<div class="title">设计需求分类</div>
							<div class="content"><?php 
								$kinds = explode(",", $project['des_kind']);
								foreach ($kinds as $kind) {
									switch ($kind) {
										case 1:
											echo "商业咨询（如商业模式、设计研究等）";
											break;
										case 2:
											echo "服务策略（如服务设计，品牌设计等）";
											break;
										case '3':
											echo "界面设计（如网站、App的交互设计、视觉设计等）";
											break;
										case '4':
											echo "平面设计（如品牌VI、Logo标识、名片、海报等）";
											break;
									}
								}
							?></div>
						</div>
					</div>
					<div class="details">
						<div class="item">
							<div class="title">开始日期</div>
							<div class="content"><?php echo $project['start_date']?></div>
						</div>
					</div>
					<div class="details">
						<div class="item">
							<div class="title">结束日期</div>
							<div class="content"><?php echo $project['end_date']?></div>
						</div>
					</div>
					<div class="details">
						<div class="item">
							<div class="title">人员需求</div>
							<div class="content"><?php echo $project['res_need']?></div>
						</div>
					</div>
					<div class="details">
						<div class="item">
							<div class="title">设计需求</div>
							<div class="content"><?php echo $project['des_need']?></div>
						</div>
					</div>
					<div class="details">
						<div class="item">
							<div class="title">项目预算</div>
							<div class="content"><?php 
									switch ($project['fin_need']) {
										case 1:
											echo "＜10,000元";
											break;
										case 2:
											echo "10,000-30,000元";
											break;
										case 3:
											echo "30,000-50,000元";
											break;
										case 4:
											echo "50,000-100,000元";
											break;
										case 5:
											echo "＞100,000元";
											break;
									}
							?></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 项目详情结束 -->
			<!-- 侧栏 -->
			<div class = "right col-md-4 col-xs-12">
				<div class="follow">
					<?php if (!$attention) { ?>
					<p class="follow-project" proj="<?php echo $project['id'];?>">+关注</p>
					<?php } else { ?>
					<p class="follow-project" proj="<?php echo $project['id'];?>">取消关注</p>
					<?php } ?>
					<input type="hidden" value="<?php echo $project['id']?>" id="proj_id">
				</div>
				<div class="main">
					<div class="introduction">
						<div class="item join">
							<?php if ($joined) { ?>
							<input type="button" class="btn btn-primary" value="已参与" name="joined">
							<?php } else { ?>
							<input type="button" class="btn btn-primary" value="参与项目" name="join" proj="<?php echo $project['id']?>">
							<?php } ?>
						</div>
						<div class="item">
							<p>发布方</p>
							<?php if($project['company_name']){?><p><?php echo $project['company_name']?></p><?php } ?>
							<?php if($project['company_logo']){?><p><img class="company_logo" src="<?php echo $project['company_logo']?>"></p><?php } ?>
						</div>
						<div class="item">
							<p>联系人：<?php echo $project['charge_person']?></p>
							<p>电话：<?php echo $project['charge_phone']?></p>
						</div>
					</div>
					<div class="joined-designer">
						<div class="title">已经加入的设计师</div>
						<div class="item">
							<?php 
							if (count($designers) > 0) {
								foreach($designers as $item):
							?>
								<div class="single">
									<a href="<?php echo site_url();?>/designer/details/<?php echo $item['id'];?>"><img src="<?php echo $item['image']?>"></a>
									<div class="name"><a href="<?php echo site_url();?>/designer/details/<?php echo $item['id'];?>"><?php echo $item['name']?></a></div>
								</div>
								<?php endforeach;
							} else { ?>
							  <div class="none">暂无加入者</div>
							<?php
							}
							?> 
						</div>
					</div>
				</div>
			</div>
			<!-- 侧栏结束 -->
		</div>
	</div>
</div>
<!-- 项目详情结束 -->