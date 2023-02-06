<?php include("./inc/init.php"); ?>
<html>
	<head>
		<title>Wangz Thangz Tools</title>
		<?php include('site-header.php') ?>
	</head>
	<body>
		<?php include('site-navigation.php') ?>
		<div class="top_content">
			<div class="wrap">
				<h1>Wangz Thangz Coffer / Chest Drop Tables</h1>
				<button class="accordion">What are the odds I can get a specific item from a chest if multiple items are availble?</button>
				<div class="panel">
					<p>
						The best I can tell is that each item within a specific category such as GEMS or ITEMS has an equal chance of being given.
					</p>
				</div>
			</div>
		</div>

		<div class="main_content">
			<div class="wrap">
				<div class="form zone_container">
					<label>Choose a Zone:</label><br/>
					<?php echo build_chest_coffer_drop_down(); ?>
				</div>
				<div class="chest_coffer_data_container data_container"></div>
			</div>
		</div>
		<?php include('site-footer.php') ?>
	</body>	
</html>