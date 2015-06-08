<!-- 提示信息 -->
<div id="message">
	<div class="container">
		<div class="alert alert-success" role="alert">
		    <?php echo $content;?>
		</div>
	</div>
</div>
<script>
function redirectURL() {
	location = "<?php echo site_url()?>/<?php echo $redirect;?>";
}
<?php if (isset($redirect)) { 
	if($redirect == "back") { ?>
		window.history.go(-2);
<?php } else { ?>
		setTimeout('redirectURL()',1500);  
<?php }
	} ?>
</script>
<!-- 提示信息结束 -->