<?php include("inc/init.php"); ?>
<html>
	<head>
		<title>Wangz Thangz Tools</title>
		<?php include('site-header.php') ?>
	</head>
	<body>
		<div class='gear_popup'><div class="loading_container"><img class="loading" src='https://wangzthangz.com/assets/loading.gif' /></div></div>
		<?php include('site-navigation.php') ?>
		<div class="top_content">
			<div class="wrap">
				<h1>Wangz Thangz Gear Finder</h1>
				<p>
					A quick way to find the gear with the best Modifier you're looking for 
					broken down by slot. You can click on each piece of equipemnt for further 
					details from the FFXI wiki site.
				</p>
				<p style="font-weight:bold; font-size:15px;">
					Note: Not all gear listed will be currently available on the Wings server. 
					Also not all links to the wiki will work due to how the item names are stored 
					in the database versus how they exist on the wiki.
				</p>
				<p style="font-weight:bold; font-size:15px; margin: 0;">Special thanks to Ari and Ckoocho for help with the DB query on this one!</p>
			</div>
		</div>

		<div class="main_content">
			<div class="wrap">
				<div class="form zone_container">
                    <form id="gear_form">
                        <?php
                            echo build_select( $jobs, 'jobs' );
                            // echo build_select( $equipment_slot_id, 'slot' );
                            echo build_select( $mod_id_array, 'modifier' );
                        ?>
						<div class="input_contaienr">
							<label for="latent">Search Latents?</label>
							<input type="checkbox" id="latent" name="latent" value="Latent">
						</div>
						<div class="submit_container">
                        	<input type="button" class="submit" value="Submit" />
						</div>
                    </form>
				</div>
                <div class="gear_results data_container"></div>
			</div>
		</div>
		<?php include('site-footer.php') ?>
	</body>	
</html>