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
				<h1>Wangz Thangz Chocobo Digging Information</h1>
				<button class="accordion">What are the odds I can get an item at all while digging?</button>
				<div class="panel">
					<p>
						The closer you are to 0% or 100% moon the better your chances of getting an item, 50% moon is the worst chance to get an item
					</p>
					<table cellpadding="5">
						<tr>
							<td></td>
							<td>Min</td>
							<td>Max</td>
						</tr>
						<tr>
							<td>Amateur</td>
							<td>21.25% </td>
							<td>42.5%</td>
						</tr>
						<tr>
							<td>Recruit</td>
							<td>23.37% </td>
							<td>46.75%</td>
						</tr>
						<tr>
							<td>Initiate</td>
							<td>25.5%</td>
							<td>51%</td>
						</tr>
						<tr>
							<td>Novice</td>
							<td>27.5%</td>
							<td>55%</td>
						</tr>
						<tr>
							<td>Apprentice</td>
							<td>29.5% </td>
							<td>59%</td>
						</tr>
						<tr>
							<td>Journeyman</td>
							<td>31.5% </td>
							<td>63%</td>
						</tr>
						<tr>
							<td>Craftsman</td>
							<td>34%</td>
							<td>68%</td>
						</tr>
						<tr>
							<td>Artisan</td>
							<td>36%</td>
							<td>72%</td>
						</tr>
						<tr>
							<td>Adept</td>
							<td>38%</td>
							<td>76%</td>
						</tr>
						<tr>
							<td>Veteran</td>
							<td>40%</td>
							<td>80%</td>
						</tr>
						<tr>
							<td>Expert</td>
							<td>42.5%</td>
							<td>85%</td>
						</tr>
					</table>
				</div>
				<button class="accordion">What are the odds I can get a skill up while digging?</button>
				<div class="panel">
					<p>It's worth noting that it appears you have a chance to obtain a skill up regardless of if your dig successfully gets an item.</p>
					<table cellpadding="5">
						<tr>
							<td>Rank</td>
							<td>Chance per dig</td>
						</tr>
						<tr><td>Amateur</td><td>6.25%</td></tr>
						<tr><td>Recruit</td><td>2.77%</td></tr>
						<tr><td>Initiate</td><td>1.66%</td></tr>
						<tr><td>Novice</td><td>1.11%</td></tr>
						<tr><td>Apprentice</td><td>.79%</td></tr>
						<tr><td>Journeyman</td><td>.61%</td></tr>
						<tr><td>Craftsman</td><td>.47%</td></tr>
						<tr><td>Artisan</td><td>.37%</td></tr>
						<tr><td>Adept</td><td>.30%</td></tr>
						<tr><td>Veteran</td><td>.25%</td></tr>
					</table>
				</div>
				<button class="accordion">How many digs on average will I need to get to the next rank?</button>
				<div class="panel">
					
 					<table cellpadding="5">
						<tr>
							<td>Current Rank</td>
							<td>Pts Needed</td>
							<td>Avg # of Digs</td>
						</tr>					
						<tr><td>Amateur</td><td>100</td><td>1600</td></tr>
						<tr><td>Recruit</td><td>200</td><td>3600</td></tr>
						<tr><td>Initiate</td><td>300</td><td>6000</td></tr>
						<tr><td>Novice</td><td>400</td><td>9000</td></tr>
						<tr><td>Apprentice</td><td>500</td><td>12600</td></tr>
						<tr><td>Journeyman</td><td>600</td><td>16200</td></tr>
						<tr><td>Craftsman</td><td>700</td><td>21000</td></tr>
						<tr><td>Artisan</td><td>800</td><td>27000</td></tr>
						<tr><td>Adept</td><td>900</td><td>33000</td></tr>
						<tr><td>Veteran</td><td>1000</td><td>39000</td></tr>
						<tr><td>Expert</td><td>-</td><td>-</td></tr>
					</table>
					
<!-- 					<table cellpadding="5">
						<tr>
							<td>Rank</td>
							<td>Skill Up Chance</td>
							<td>Skill Ups Needed</td>
							<td>Digs Needed</td>
							<td>Stacks Needed</td>
						</tr>
						<tr>
							<td>0 to 1</td>
							<td>1 in 16 </td>
							<td>100 points</td>
							<td>1600 digs</td>
							<td>133</td>
						</tr><tr>
							<td>1 to 2</td>
							<td>1 in 36</td>
							<td>200 points</td>
							<td>7200 digs</td>
							<td>600</td>
						</tr><tr>
							<td>2 to 3</td>
							<td>1 in 60</td>
							<td>300 points</td>
							<td>18000 digs</td>
							<td>1500</td>
						</tr><tr>
							<td>3 to 4</td>
							<td>1 in 90</td>
							<td>400 points</td>
							<td>24000 digs</td>
							<td>2000</td>
						</tr><tr>
							<td>4 to 5</td>
							<td>1 in 126</td>
							<td>500 points</td>
							<td>30000 digs</td>
							<td>2500</td>
						</tr><tr>
							<td>5 to 6</td>
							<td>1 in 162</td>
							<td>600 points</td>
							<td>36000 digs</td>
							<td>3000</td>
						</tr><tr>
							<td>6 to 7</td>
							<td>1 in 210</td>
							<td>700 points</td>
							<td>42000 digs</td>
							<td>3500</td>
						</tr><tr>
							<td>7 to 8</td>
							<td>1 in 270</td>
							<td>800 points</td>
							<td>48000 digs</td>
							<td>4000</td>
						</tr><tr>
							<td>8 to 9</td>
							<td>1 in 330</td>
							<td>900 points</td>
							<td>54000 digs</td>
							<td>4500</td>
						</tr><tr>
							<td>9 to 10</td>
							<td>1 in 390</td>
							<td>1000 points</td>
							<td>160000 digs</td>
							<td>5000</td>
						</tr>
					</table> -->					
				</div>
				<button class="accordion">How many hours on average will it take to get to the next rank?</button>
				<div class="panel">
					<p>
						In short A LOT! Assuming a base line of 5 seconds between digs to account for the animation time and the time it 
						takes to move to your next dig spot here is the break down. These numbers don't factor in travel time to get to a 
						zone, or any miscellaneous time needed to do things like buy greens, remount, or take into account area dig delays 
						upon first entering so these numbers are under representing the actual hours needed by at least a little.
					</p>
					<table cellpadding="5">
						<tr>
							<td>Avg Digs Needed</td>
							<td>Dig Delay</td>
							<td>Avg Hours Needed</td>
						</tr>					
						<tr><td>1600</td><td>21</td><td>9.3 hours</td></tr>
						<tr><td>3600</td><td>16</td><td>16 hours</td></tr>
						<tr><td>6000</td><td>11</td><td>18.3 hours</td></tr>
						<tr><td>9000</td><td>5</td><td>12.5 hours</td></tr>
						<tr><td>12600</td><td>5</td><td>17.5 hours</td></tr>
						<tr><td>16200</td><td>5</td><td>22.5 hours</td></tr>
						<tr><td>21000</td><td>5</td><td>29.1 hours</td></tr>
						<tr><td>27000</td><td>5</td><td>37.5 hours</td></tr>
						<tr><td>33000</td><td>5</td><td>45.8 hours</td></tr>
						<tr><td>39000</td><td>5</td><td>54.1 hours</td></tr>
					</table>
				</div>
				<button class="accordion">What about Dig Fatigue or Zone Limits?</button>
				<div class="panel">
					<p>Neither of these things appear to be currently active on the Wings server so get out there dig until you wear out those macro keys.</p>
				</div>
			</div>
		</div>

		<div class="main_content">
			<div class="wrap">
				<div class="form zone_container">
					<label>Choose a Zone:</label><br/>
					<?php echo build_chocobo_digging_drop_down(); ?>
				</div>
				<div class="chocobo_digging_data_container data_container">
					<?php echo get_chocobo_digging_drops( 'CARPENTERS_LANDING' ); ?>
				</div>
			</div>
		</div>
		<?php include('site-footer.php') ?>
	</body>	
</html>