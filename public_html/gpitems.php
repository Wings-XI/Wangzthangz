<?php include("inc/init.php"); ?>
<html>
	<head>
		<title>Wangz Thangz Tools</title>
		<?php include('site-header.php') ?>
	</head>
	<body>
		<?php include('site-navigation.php') ?>
		<div class="top_content">
			<div class="wrap">
				<h1>Wangz Thangz GP Items</h1>

<!-- 				<button class="accordion">Question?</button>
				<div class="panel">
					<p>
						Answer
					</p>
				</div> -->
			</div>
		</div>

		<div class="main_content">
			<div class="wrap">
				<div class="form zone_container">
					<label>Choose a Guild:</label><br/>
					<?php echo build_guild_drop_down(); ?>
				</div>
				<div class="guild_data_container">
					<p>Curious about what the potential GP turn in items are for the Wings Server? Choose a guild from above and let's load in some Guild Item Points here!</p>					
				</div>
			</div>
		</div>
		<?php include('site-footer.php') ?>
	</body>	
</html>