<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>GT宮崎 実績管理システム</title>
	{{-- STYLE SHEET --}}
	<link rel="stylesheet" href="/css/app.css">
	
	{{-- FONT FAMILY --}}
	<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bg-image">
		<div class="overlay"></div>
		<div class="section-body" id="page-top">
			<div class="container-fluid">
				<div class="page-header">
					<div class="header-icon row center">
						<img src="img/favicon.png">
						<div class="text-lg">実績管理システム</div>
						
					</div><!--row-->
					
					
				</div><!--page-header-->
				
			</div><!--container-fluid-->
		</div><!--sectionbody-->
		<div class="login-body box-shadow">
			<div class="container">
				<div class="profile-icon">
					<img src="img/pro_icon2.png" alt="profile-icon">
				</div>
				<div class="row p-r center">
					<p class="text-lg">LOGIN</p>
				</div>
				<div class="login-form">
					<form name="myForm" action="" onsubmit="return validateForm()" method="get">
						<div class="row">
							<p class="fw-block label">EMAIL</p>
						</div>
						<div class="input">
								<input type="text" id="email" name="email" placeholder="example@example.co.jp">
								<p class="text-xs error-msg">Required!</p>
						</div>
						<div class="row">
							<p class="fw-block label">PASSWORD</p>
						</div>
						<div class="input">
							<input type="password" id="password" name="password" placeholder="your password">
							<p class="text-xs error-msg">Required!</p>
						</div>
					
						<div class="text-right mt mb">
							<a class="text-xs" href="">パスワードを忘れの場合</a>
						</div>
						<div class="center">
							<input class="btn btn-orange" type="submit" value="ログイン">
							
						</div>
					</form>
				</div>
				
			</div>
		</div>
		<footer>
			<div class="center">
				<p class="text-center">&copy; GT Miyazaki All Rights Reserved</p>				
			</div>
		</footer>
	</div>
	<!-- Template Main Javascript File -->
	<script src="/js/main.js"></script>
</body>
</html>