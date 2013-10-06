<?php

require_once('core/db.php');
require_once('languages/error.php');
require_once('core/API/users.php');
require_once('core/API/posts.php');
require_once('core/API/sections.php');
require_once('core/init.php');

$posts = new sPost('posts',1);


?>
<!DOCTYPE html>
<html>

	<head>
	
		
		<!--Google fonts -->
		<link href='http://fonts.googleapis.com/css?family=Economica|Cookie|Libre+Baskerville' rel='stylesheet' type='text/css'>
		
		<!--Engazy style sheet -->
		<link rel="stylesheet" href="css/style.css">
		
		<!--Fontello icons fonts -->
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]>
		<link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
		<script>
			function toggleCodes(on) {
				var obj = document.getElementById('icons');

				if (on) {
					obj.className += ' codesOn';
				} else {
					obj.className = obj.className.replace(' codesOn', '');
				}
			}
		</script>
		
	</head>
	
	<body>
		<!-- Header -->
		<div id="header">
			<div class="container">
					<h1>Enjazy</h1>
			</div>
		</div>
		<!-- /Header -->
	
		<!-- Navbar -->
		<div id="navbar">
			<div class="container">
				<ul>
					<li><i class="icon-home"></i></li>
					<li>Services</li>
					<li>Our Work</li>
					<li>About Us</li>
					<li>Contact Us</li>
				</ul>
			</div>
		</div>
		<!-- /Navbar -->
		
		
			


		<!-- Post format -->
		
		
		<div class="container">
		<?php
		$post = $posts->getAllPosts();
		for($i = 0; $i < count($post);$i++){
			echo '
			<div class="post-container" style="background-image: url(\'images/Eiffel-Tower.jpg\');">
				<header class="post-content">
					<h1>'.$post[$i]['subject'].'</h1>
					<p>
						'.$post[$i]['content'].'
					</p>
					<footer class="post-options">
						<div class="post-option-left">
						<p><a href="#">comments(5)</a></p>
						</div>
						
						<div class="post-option-right">
							<div class="icons">
								<ul>
									<li><i class="icon-facebook-squared"></i></li>
									<li><i class="icon-twitter"></i></li>
									<li><i class="icon-gplus"></i></li>
									<li><i class="icon-rss-alt"></i></li>
								</ul>
							</div>
						</div>
						
					</footer>
				</header>
			</div>
			';
		}
		?>
		</div>
		<!-- /Post format -->
		
	</body>


</html>