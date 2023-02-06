<?php
	$menu = array(
		"../index.php" 			=> "Mob Drops",
		"../bcnm.php" 			=> "BCNM / KSNM / ENM Drops",
		"../gpitems.php" 			=> "GP Items",
		"../chocobodigging.php" 	=> "Choco Digging",
		"../coffer_chests.php" 	=> "Chests / Coffers"
	);
?>
<div class="site-navigation">
	<div class="wrap">
		<?php echo get_last_startup(); ?>
		<ul class="menu">
			<?php
				foreach ($menu as $key => $value) {
					if ( $_SERVER['REQUEST_URI'] == $key ) {
						echo '<li class="menu-item active"><a href="'.$key.'">'.$value.'</a></li>';
					} else {
						echo '<li class="menu-item"><a href="'.$key.'">'.$value.'</a></li>';		
					}
				}
			?>
		</ul>
	</div>
</div>