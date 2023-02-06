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
				<h1>Wangz Thangz Mob Drop Tables </h1>
			</div>
		</div>
		


		<div class="main_content">
			<div class="wrap">
				<div class="form zone_container">
					<label>Choose a Zone:</label><br/>
					<?php echo build_zone_drop_down(); ?>
				</div>
				<div class="form th_container">
					<label>Apply Treasure Hunter:</label><br/>
					<input type="radio" id="thzero" name="th" value="0" checked> <label for="thzero">TH 0</label>
					<input type="radio" id="thone" name="th" value="1"> <label for="thone">TH 1</label>
					<input type="radio" id="thtwo" name="th" value="2"> <label for="thtwo">TH 2</label>
					<input type="radio" id="ththree" name="th" value="3"> <label for="ththree">TH 3</label>
					<input type="radio" id="thfour" name="th" value="4"> <label for="thfour">TH 4</label>
				</div>
				<div class="mob_data_container data_container">
					<?php echo get_zone_mobs( 116, 0 ); ?>
					<?php echo get_zone_nm_mobs( 116, 0 ); ?>
				</div>
			</div>
		</div>
		<div class="top_content">
			<div class="wrap">
				<h5>Important Notice:</h5>
				<p>
					This site <strong>IS NOW</strong> an "official" WingsXI site so if you see anything that looks wrong please file an issue on the <a href="https://gitlab.com/ffxiwings/wings/-/issues">WingsXI Gitlab</a> or with the <a href="https://wingsxi.com/wings/discord.php">Wings
					Discord</a>.
				</p>

				<button class="accordion">What exactly am I looking at here?</button>
				<div class="panel">
					<p>
						This a quick and simple tool I built to look up the mobs for any zone on the Wings private server and see what items drop and at what rate.
					</p>
				</div>

				<button class="accordion">What are "Grouped Drops"?</button>
				<div class="panel">
					<p>
						This is loot that shares the same "drop pool", in other words you're going to get one of these items but never more than one. 
						Also if the group drop rate is 100% then don't worry about having Treasure Hunter because it won't factor in.
					</p>
				</div>

				<button class="accordion">Why is it so plain and ugly?</button>
				<div class="panel">
					<p>
						Geez! Judgey much? Beauty is in the eye of the beholder also I'm not a UX kinda person.
					</p>
				</div>

				<button class="accordion">This looks terrible on my phone / tablet.</button>
				<div class="panel">
					<p>
						Yep see above, I did a little bit but it's not ideal. <i class="fas fa-arrow-up"></i>
					</p>
				</div>

				<button class="accordion">Wow! This is great but when are you going to add feature X?</button>
				<div class="panel">
					<p>
						In an effort to bring the real life Wings Feeling<i class="fas fa-trademark"></i> to this site I'll be honoring their long commitment to not giving ETAs.
					</p>
				</div>

				<button class="accordion">How accurate is this info?</button>
				<div class="panel">
					<p>
						The base drop rates and loot tables are pulled right from the SQL files available on the Wings GitLab. The TH modification is from my understanding of 
						how TH is impacting loot rolls which was gained by digging through the GitLab files for about 4 hours one day. So all in all I'd say pretty accurate but 
						I wouldn't be that surprised to find out there might be mistakes with TH.
					</p>
					<p>
						I continue to work and try and improve the accuracy of all information shown here and I'm always open to reports of potential issues.
					</p>
				</div>

				<button class="accordion">Why are there some odd mob entries?</button>
				<div class="panel">
					<p>
						Mostly because the mobs are a little odd coming straight out of the Wings SQL file. Combine that with 
						Square's choice not to differentiate between things like timed spawn NMs and NMs that are force spawned 
						for quests creates an interesting maze to navigate and properly filter out the "odd" mobs. In the end I've 
						opted to give as much information as possible and let the user sort it out until I can find a better way to 
						filter things.
					</p>
				</div>
				<p>
					
				</p>
			</div>
		</div>
		<?php include('site-footer.php') ?>
	</body>	
</html>