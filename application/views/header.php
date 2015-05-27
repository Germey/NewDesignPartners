<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>设计合伙人</title>
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- 导航条 -->
    <div id="menubar">
      <nav class="navbar navbar-default">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url() ?>"><img src="<?php echo base_url()?>images/logo.png"></a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="#">项目</a></li>
              <li><a href="#">训练营</a></li>
              <li><a href="#">设计师</a></li>
              <li><a href="#">关于</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <?php if (!isset($_SESSION['name'])) { ?>
                <a href="<?php echo site_url();?>/login">登录</a>
                <?php } else { ?>
                <a href="<?php echo site_url();?>/login"><?php echo $_SESSION['name'];?></a>
                <?php } ?>
              </li>
              <li>
                <?php if (!isset($_SESSION['name'])) { ?>
                <a href="<?php echo site_url();?>/register">注册</a>
                <?php } else { ?>
                <a href="<?php echo site_url();?>/login/logout">登出</a>
                <?php } ?>
              </li>
              <li><a href="#">设计需求提交</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <!-- 导航条结束 -->