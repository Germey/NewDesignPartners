<div id="about">
	<div class="container">
		<div class="title"><h3>设计合伙人</h3></div>
		<?php 
		$detail = $about;
		$detail = str_replace("\n", "<br>", $detail);
		$detail = str_replace(" ", "&nbsp;&nbsp;", $detail);
		echo $detail;
		?>
	</div>
</div>