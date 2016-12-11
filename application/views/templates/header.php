<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<title>Shanon 实验室</title>
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" />
<link rel="shortcut icon" href="<?php echo base_url();?>data/img/favicon.ico"  type="image/x-icon" />
<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>data/css/index.css" />

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-static-top">
<div class="container">
<div class="navbar-header">
<a class="navbar-brand logo" href="/"><img width="100" height="100" src="<?php echo base_url(); ?>data/img/logo.png" alt="Logo"><span>Shanon</span></a>
</div>
<div class="navbar-collapse collapse" id="navbar-main">
<ul class="nav navbar-nav navbar-right">
<li>
<a href="/explore">发现</a>
</li>
<li>
<form class="navbar-form" action="http://baidu.com/s" accept-charset="UTF-8" method="get">
<div class="input-group input-group">
<input type="text" name="wd" value="" placeholder="搜索.." class="form-control" size="40">
<span class="input-group-btn">
<button class="btn btn-primary" type="submit">
<i class="glyphicon glyphicon-search"></i>
</button>
</span>
</div>
</form> </li>
<li>
<p class="navbar-btn">
<a class="btn btn-success" rel="nofollow" href="/login?refer=/">
<i class="fa fa-github"></i> 登录
</a> </p>
</li>
</ul>
</div>
</div>
</div>