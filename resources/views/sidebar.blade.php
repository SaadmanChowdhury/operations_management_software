<!DOCTYPE html>
<html>
<head>
	<title>Sidebar</title>

	<!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/app.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	<div class="container-fluid">
		<div id="header_top" onmouseover="sidebar_expand(this)" onmouseout="normalsideBar(this)">
			<div class="logo-holder box-shadow">
				<div class="header-icon row">
					<img src="img/favicon.png">
					<h6 class="label-text hide">実績管理システム</h6>
					
				</div>
			</div>

			<div class="container">
				<div class="p-r list-unstyled" id="nav">
					<li><a href=""><span class="fa fa-home fa-2x" id="assign"></span><span class="label-text hide">アサイン</span></a></li>
					<li><a href=""><span class="fa fa-newspaper-o fa-2x" id="project"></span><span class="label-text hide">プロジェクト</span></a></li>
					<li><a href=""><span class="fa fa-user fa-2x" id="user"></span><span class="label-text hide">ユーザー</span></a></li>
					<li><a href=""><span class="fa fa-users fa-2x" id="client"></span><span class="label-text hide">クライアント</span></a></li>
				</div>
			</div>
			
		</div>
	</div>
     <!-- Template Main Javascript File -->
	<script src="/js/main.js"></script>
</body>
</html>