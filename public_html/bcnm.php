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
				<h1>Wangz Thangz BCNM Drop Tables</h1>

				<button class="accordion">When are more BCNMs going to be available?</button>
				<div class="panel">
					<p>
						Great question!
					</p>
				</div>
				<button class="accordion">Why does Under Observation Group 1 only have a 91% chance of nothing?</button>
				<div class="panel">
					<p>
						Peacock charm used to drop in this group and when it was removed the "nothing" item didn't get bumped from it's usual 91% to 100%.
					</p>
				</div>
			</div>
		</div>

		<div class="main_content">
			<div class="wrap">
				<div class="form zone_container">
					<label>Choose a BCNM / KSNM / ENM:</label><br/>
					<?php echo build_bcnm_drop_down(); ?>
				</div>
				<div class="bcnm_data_container data_container">
					<?php echo get_bcnm_drops( 'royal_jelly' ); ?>
				</div>
			</div>
		</div>
		<?php include('site-footer.php') ?>
	</body>	
</html>