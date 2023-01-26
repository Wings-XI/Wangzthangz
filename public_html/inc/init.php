<?php
$maintenance = FALSE;
if ( $maintenance === TRUE && $_SERVER['REMOTE_ADDR'] != '173.22.162.37' ) {
	header('Location: https://www.wangzthangz.com/maintenance.php');
	exit;
}

if ( $maintenance === TRUE ) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set("memory_limit","16M");
	error_reporting(E_ALL);
}

$mysqli = new mysqli("db","test","example","wingsdb");

function get_item_name( $item_ID ) {
	global $mysqli;

	if ( $item_ID == 0 ) {
		return "Nothing";
	}

	if ($result = $mysqli -> query("SELECT sortname FROM item_basic WHERE itemid = ".$item_ID )) {
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$item_name = ucwords(str_replace('_', ' ', $row['sortname']));
				return $item_name;
			}
		}
	}
}

function get_item_value( $item_ID ) {
	global $mysqli;

	$output = '';
	if ($result = $mysqli -> query("SELECT BaseSell FROM item_basic WHERE itemid = ".$item_ID )) {
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$item_value = $row['BaseSell'];
				return $item_value;
			}
		}
	}
}

if ( isset($_POST['callback']) ) {
	if ( $_REQUEST['callback'] == 'get_guild_point_items' ) {
		$guild_id 	= intval($_REQUEST['guild']);
		echo get_guild_point_items( $guild_id );
	}

	if ( $_REQUEST['callback'] == 'get_chocobo_digging' ) {
		$cs_zone 	= $_REQUEST['cd_zone'];
		echo get_chocobo_digging_drops( $cs_zone );
	}

	if ( $_REQUEST['callback'] == 'get_zone_mobs' && $_REQUEST['zone'] ) {
		$zone_id 	= intval($_REQUEST['zone']);
		$th_value 	= intval($_REQUEST['th']);

		echo get_zone_mobs( $zone_id, $th_value );
		echo get_zone_nm_mobs( $zone_id, $th_value );
	}

	if ( $_REQUEST['callback'] == 'get_bcnm_drops' && $_REQUEST['bcnm'] ) {
		$bcnm 	= $_REQUEST['bcnm'];

		echo get_bcnm_drops( $bcnm );
	}

	if ( $_REQUEST['callback'] == 'get_chest_coffer_drops' && $_REQUEST['chest_coffer'] ) {
		$chest_coffer 	= $_REQUEST['chest_coffer'];

		echo get_chest_coffer_drops( $chest_coffer );
	}	

	if ( $_REQUEST['callback'] == 'get_gear' ) {
		$job    = intval($_REQUEST['job']);
		// $slot   = intval($_REQUEST['slot']);
		$mod   	= intval($_REQUEST['mod']);
		$latent = intval($_REQUEST['latent']);
		$equipment_slot_id = array(
			"MAIN  " => 1,
			"SUB   " => 2,
			"RANGED" => 4,
			"AMMO  " => 8,
			"HEAD  " => 16,
			"BODY  " => 32,
			"HANDS " => 64,
			"LEGS  " => 128,
			"FEET  " => 256,
			"NECK  " => 512,
			"WAIST " => 1024,
			"EARRING  " => 6144,
			"RING " => 24576,
			"BACK  " => 32768,
		);
		foreach ($equipment_slot_id as $key => $value) {
			echo '<div>';
				echo '<h3>' . $key . '</h3>';
					echo get_gear( $value, $job, $mod, $latent );
				echo '<br />';
			echo '</div>';
		}

	}

	if ( $_REQUEST['callback'] == 'get_gear_popup' ) {
		$item_id    = intval($_REQUEST['item_id']);
		get_gear_popup( $item_id );
	}	
}

// MOB
	function build_zone_drop_down() {
		$zone_array = array(
								// 1 => 'Phanauet Channel',
								2 => 'Carpenters Landing',
								// 3 => 'Manaclipper',
								4 => 'Bibiki Bay',
								5 => 'Uleguerand Range',
								// 6 => 'Bearclaw Pinnacle',
								7 => 'Attohwa Chasm',
								// 8 => 'Boneyard Gully',
								9 => 'PsoXja',
								// 10 => 'The Shrouded Maw',
								11 => 'Oldton Movalpolos',
								12 => 'Newton Movalpolos',
								// 13 => 'Mine Shaft 2716',
								// 14 => 'Hall of Transference',
								16 => 'Promyvion-Holla',
								// 17 => 'Spire of Holla',
								18 => 'Promyvion-Dem',
								// 19 => 'Spire of Dem',
								20 => 'Promyvion-Mea',
								// 21 => 'Spire of Mea',
								22 => 'Promyvion-Vahzl',
								// 23 => 'Spire of Vahzl',
								24 => 'Lufaise Meadows',
								25 => 'Misareaux Coast',
								27 => 'Phomiuna Aqueducts',
								28 => 'Sacrarium',
								29 => 'Riverne-Site B01',
								30 => 'Riverne-Site A01',
								// 31 => 'Monarch Linn',
								// 32 => 'Sealions Den',
								33 => 'AlTaieu',
								34 => 'Grand Palace of HuXzoi',
								35 => 'The Garden of RuHmet',
								// 36 => 'Empyreal Paradox',
								// 37 => 'Temenos',
								// 38 => 'Apollyon',
   								38 => "Dynamis-Valkurm",
   								40 => "Dynamis-Buburimu",
   								41 => "Dynamis-Qufim",
   								42 => "Dynamis-Tavnazia",
								// 44 => 'Abdhaljs Isle-Purgonorgo',
								51 => 'Wajaom Woodlands',
								52 => 'Bhaflau Thickets',
								53 => 'Nashmau',
								54 => 'Arrapago Reef',
								// 55 => 'Ilrusi Atoll',
								// 56 => 'Periqia',
								// 57 => 'Talacca Cove',
								// 60 => 'The Ashu Talif',
								61 => 'Mount Zhayolm',
								62 => 'Halvung',
								// 63 => 'Lebros Cavern',
								// 64 => 'Navukgo Execution Chamber',
								65 => 'Mamook',
								// 66 => 'Mamool Ja Training Grounds',
								// 67 => 'Jade Sepulcher',
								68 => 'Aydeewa Subterrane',
								// 69 => 'Leujaoam Sanctum',
								// 71 => 'The Colosseum',
								72 => 'Alzadaal Undersea Ruins',
								// 73 => 'Zhayolm Remnants',
								// 74 => 'Arrapago Remnants',
								// 75 => 'Bhaflau Remnants',
								// 76 => 'Silver Sea Remnants',
								// 77 => 'Nyzul Isle',
								// 78 => 'Hazhalm Testing Grounds',
								79 => 'Caedarva Mire',
								81 => 'East Ronfaure [S]',
								82 => 'Jugner Forest [S]',
								83 => 'Vunkerl Inlet [S]',
								84 => 'Batallia Downs [S]',
								85 => 'La Vaule [S]',
								// 86 => 'Everbloom Hollow',
								88 => 'North Gustaberg [S]',
								89 => 'Grauberg [S]',
								90 => 'Pashhow Marshlands [S]',
								91 => 'Rolanberry Fields [S]',
								92 => 'Beadeaux [S]',
								// 93 => 'Ruhotz Silvermines',
								95 => 'West Sarutabaruta [S]',
								96 => 'Fort Karugo-Narugo [S]',
								97 => 'Meriphataud Mountains [S]',
								98 => 'Sauromugue Champaign [S]',
								99 => 'Castle Oztroja [S]',
								100 => 'West Ronfaure',
								101 => 'East Ronfaure',
								102 => 'La Theine Plateau',
								103 => 'Valkurm Dunes',
								104 => 'Jugner Forest',
								105 => 'Batallia Downs',
								106 => 'North Gustaberg',
								107 => 'South Gustaberg',
								108 => 'Konschtat Highlands',
								109 => 'Pashhow Marshlands',
								110 => 'Rolanberry Fields',
								111 => 'Beaucedine Glacier',
								112 => 'Xarcabard',
								113 => 'Cape Teriggan',
								114 => 'Eastern Altepa Desert',
								115 => 'West Sarutabaruta',
								116 => 'East Sarutabaruta',
								117 => 'Tahrongi Canyon',
								118 => 'Buburimu Peninsula',
								119 => 'Meriphataud Mountains',
								120 => 'Sauromugue Champaign',
								121 => 'The Sanctuary of ZiTah',
								122 => 'RoMaeve',
								123 => 'Yuhtunga Jungle',
								124 => 'Yhoator Jungle',
								125 => 'Western Altepa Desert',
								126 => 'Qufim Island',
								127 => 'Behemoths Dominion',
								128 => 'Valley of Sorrows',
								// 129 => 'Ghoyus Reverie',
								130 => 'RuAun Gardens',
								// 131 => 'Mordion Gaol',
								134 => 'Dynamis-Beaucedine',
								135 => 'Dynamis-Xarcabard',
								136 => 'Beaucedine Glacier [S]',
								137 => 'Xarcabard [S]',
								138 => 'Castle Zvahl Baileys [S]',
								139 => 'Horlais Peak',
								140 => 'Ghelsba Outpost',
								141 => 'Fort Ghelsba',
								142 => 'Yughott Grotto',
								143 => 'Palborough Mines',
								// 144 => 'Waughroon Shrine',
								145 => 'Giddeus',
								// 146 => 'Balgas Dais',
								147 => 'Beadeaux',
								148 => 'Qulun Dome',
								149 => 'Davoi',
								150 => 'Monastic Cavern',
								151 => 'Castle Oztroja',
								// 152 => 'Altar Room',
								153 => 'The Boyahda Tree',
								154 => 'Dragons Aery',
								155 => 'Castle Zvahl Keep [S]',
								156 => 'Throne Room [S]',
								157 => 'Middle Delkfutts Tower',
								158 => 'Upper Delkfutts Tower',
								159 => 'Temple of Uggalepih',
								160 => 'Den of Rancor',
								161 => 'Castle Zvahl Baileys',
								162 => 'Castle Zvahl Keep',
								163 => 'Sacrificial Chamber',
								164 => 'Garlaige Citadel [S]',
								165 => 'Throne Room',
								166 => 'Ranguemont Pass',
								167 => 'Bostaunieux Oubliette',
								// 168 => 'Chamber of Oracles',
								169 => 'Toraimarai Canal',
								// 170 => 'Full Moon Fountain',
								171 => 'Crawlers Nest [S]',
								172 => 'Zeruhn Mines',
								173 => 'Korroloka Tunnel',
								174 => 'Kuftal Tunnel',
								175 => 'The Eldieme Necropolis [S]',
								176 => 'Sea Serpent Grotto',
								177 => 'VeLugannon Palace',
								178 => 'The Shrine of RuAvitau',
								179 => 'Stellar Fulcrum',
								// 180 => 'LaLoff Amphitheater',
								// 181 => 'The Celestial Nexus',
								// 182 => 'Walk of Echoes',
								184 => 'Lower Delkfutts Tower',
								185 => 'Dynamis-San_dOria',
								186 => 'Dynamis-Bastok',
								187 => 'Dynamis-Windurst',
								188 => 'Dynamis-Jeuno',
								// 189 => 'Residential Area',
								190 => 'King Ranperres Tomb',
								191 => 'Dangruf Wadi',
								192 => 'Inner Horutoto Ruins',
								193 => 'Ordelles Caves',
								194 => 'Outer Horutoto Ruins',
								195 => 'The Eldieme Necropolis',
								196 => 'Gusgen Mines',
								197 => 'Crawlers Nest',
								198 => 'Maze of Shakhrami',
								// 199 => 'Residential Area',
								200 => 'Garlaige Citadel',
								204 => 'FeiYin',
								205 => 'Ifrits Cauldron',
								// 206 => 'QuBia Arena',
								208 => 'Quicksand Caves',
								// 210 => 'GM Home',
								212 => 'Gustav Tunnel',
								213 => 'Labyrinth of Onzozo',
								// 220 => 'Ship bound for Selbina',
								// 221 => 'Ship bound for Mhaura',
								// 227 => 'Ship bound for Selbina Pirates',
								// 228 => 'Ship bound for Mhaura Pirates',
								// 251 => 'Hall of the Gods',
								252 => 'Norg',
								// 279 => 'Walk of Echoes [P2]',
								// 298 => 'Walk of Echoes [P1]',
								500 => 'Apollyon - NW Apollyon',
								501 => 'Apollyon - NE Apollyon',
								502 => 'Apollyon - SW Apollyon',
								503 => 'Apollyon - SE Apollyon',
								// 504 => 'Apollyon - CS Apollyon',
								505 => 'Apollyon - Central Apollyon',
								600 => 'Temenos - Western Tower',
								601 => 'Temenos - Northern Tower',
								602 => 'Temenos - Eastern Tower',
								// 603 => 'Temenos - Central Temenos - Basement 1',
								604 => 'Temenos - Central Temenos - 1st Floor',
								605 => 'Temenos - Central Temenos - 2nd Floor',
								606 => 'Temenos - Central Temenos - 3rd Floor',
								607 => 'Temenos - Central Temenos - 4th Floor',
						);
		asort($zone_array);

		$output = '';

		$output .= "<select id='zone_select'>";
			$output .= "<option value='xx'>Choose A Zone</option>";
			foreach ($zone_array as $key => $value) {
				if ( $key == 116 ) {
					$output .= "<option value='{$key}' selected>{$value}</option>";
				} else {
					$output .= "<option value='{$key}'>{$value}</option>";	
				}
				
			}
		$output .= "</select>";

		return $output;
	}

	function get_zone_mobs( $zone_id, $th_value = 0 ) {
		global $mysqli;

		// Perform query to get mobs
		$output = "<button class='accordion'>Normal Mobs</button>";
		$output .= "<div class='panel'>";
		$output .= "<div class='normal_mobs_container'>";
		$zone_id = intval($zone_id);

		// if ( $zone_id == 505 ) {}

		if ($result = $mysqli -> query(
										"SELECT * FROM mob_groups
												LEFT JOIN mob_spawn_points ON 
													mob_groups.groupid = mob_spawn_points.groupid AND 
													mob_groups.zoneid = ((mobid >> 12) & 0xFFF)
											WHERE 
												mob_groups.zoneid = ".$zone_id." AND 
												(spawntype = 0 OR spawntype = 1 OR spawntype = 2 OR spawntype = 3 OR spawntype = 4) AND 
												(respawntime > 0 AND respawntime < 1800 ) AND
												-- dropid != 0 AND
												mob_groups.name NOT IN ( SELECT name FROM fishing_mob WHERE zoneid = ".$zone_id." ) AND
												mob_groups.groupid IN ( SELECT mob_spawn_points.groupid FROM mob_spawn_points WHERE 1 ) 
											ORDER BY name, minLevel"
											)) {
			if ($result->num_rows > 0) {
				$output .= "<ul class='header'>
								<li class='name'>Name</li> 
								<li class='level'>Level</li> 
								<li class='drop'>Normal Drops</li> 
								<li class='gdrop'>Grouped Drops</li> 
								<li class='steal'>Steal</li>
							</ul>";
				// output data of each row
				$mob_array = array();
				while($row = $result->fetch_assoc()) {

					if ( strpos( $row['name'], '2' ) ) {
						continue;
					}
					if ( strpos( $row['name'], 'Aern' ) ) {
						continue;
					}

					if ( array_key_exists($row['name'], $mob_array) ) {
						$name = $row['name'];
						$set_drop_id = $mob_array[$name]['dropid'];
						if ( $set_drop_id == $row['dropid'] ) {
							// This mob has the same name and drop id as one already in our array
							// Set the existing mobs max level to this mobs max level
							$mob_array[$name]['maxLevel'] = $row['maxLevel'];
						}
					} else {
						$mob_array[ $row['name'] ] = array( 
															'minLevel' => $row['minLevel'],
															'maxLevel' => $row['maxLevel'],
															'dropid' => $row['dropid'], 
															'spawntype' => $row['spawntype']
															);
					}
				}
		
				foreach ($mob_array as $key => $value) {
					$link_name 					= str_replace(array( '_present', '_pres', '_both', '_past' ) , '', $key);
					$name 						= str_replace('_', ' ', $link_name);
					switch( $value['spawntype'] ) {
						case 1:
							$special_spawn_condition = '<span>Spawns between 20:00-04:00</span>';
						break;
						case 2:
							$special_spawn_condition = '<span>Spawns between 18:00-06:00</span>';
						break;
						case 4:
							$special_spawn_condition = '<span>Spawns during weather</span>';
						break;
						default: 
							$special_spawn_condition = '';
						break;
					}

					$output .= "<ul>";
						$output .= "<li class='name'><a target='_blank' href='https://ffxiclopedia.fandom.com/wiki/".$link_name."'>" . $name . " <i class='fas fa-external-link-alt'></i></a>".$special_spawn_condition."</li>";
						$output .= "<li class='level'>" . $value["minLevel"] . ' - ' . $value['maxLevel'] . "</li>";
						$output .= "<li class='drop'>" . get_mob_normal_drops( $value['dropid'], $th_value ) . "</li>";
						$output .= "<li class='gdrop'>" . get_mob_grouped_drops( $value['dropid'] ) . "</li>";
						$output .= "<li class='steal'>" . get_mob_steal_drops( $value['dropid'] ) . "</li>";
					$output .= "</ul>";
				}

			} else {
				$output .= "0 results";
			}
			// Free result set
			$result -> free_result();
		}

		$output .= "</div>";
		$output .= "</div>";

		return $output;
	}

	function get_zone_nm_mobs( $zone_id, $th_value = 0 ) {
		global $mysqli;

		$output = "<button class='accordion'>Notorious Mobs</button>";
		$output .= "<div class='panel'>";
		$output .= "<div class='nm_mobs_container'>";
		$zone_id = intval($zone_id);
		
		if ($result = $mysqli -> query("SELECT * FROM mob_groups
											LEFT JOIN mob_spawn_points ON
												mob_groups.groupid = mob_spawn_points.groupid AND
												mob_groups.zoneid = ((mobid >> 12) & 0xFFF)
											WHERE 
											zoneid = ".$zone_id." AND 
											( 
												spawntype = 32 OR
												spawntype = 64 OR
												spawntype = 128 OR
												respawntime > 1800 OR
												(spawntype = 0 AND respawntime > 1800) 
											)
											AND dropid != 0 
											-- AND ( pos_x != 0 AND pos_x != 1 )
											AND name NOT IN ( SELECT name FROM fishing_mob WHERE zoneid = ".$zone_id." )
											ORDER BY name, minLevel")) {
			if ($result->num_rows > 0) {
				$output .= "<ul class='header'>
								<li class='name'>Name</li> 
								<li class='level'>Level</li> 
								<li class='drop'>Normal Drops</li> 
								<li class='gdrop'>Grouped Drops</li> 
								<li class='steal'>Steal</li>
							</ul>";
				// output data of each row
				$mob_array = array();
				while($row = $result->fetch_assoc()) {

					if ( strpos( $row['name'], '_fished' ) ) {
						continue;
					}
					
					if ( $row['name'] == 'Mimic' ) {
						continue;
					}

					if ( array_key_exists($row['name'], $mob_array) ) {
						$name = $row['name'];
						$set_drop_id = $mob_array[$name]['dropid'];
						if ( $set_drop_id == $row['dropid'] ) {
							// This mob has the same name and drop id as one already in our array
							// Set the existing mobs max level to this mobs max level
							$mob_array[$name]['maxLevel'] = $row['maxLevel'];
						}
					} else {
						$mob_array[ $row['name'] ] = array( 
															'minLevel' 		=> $row['minLevel'],
															'maxLevel' 		=> $row['maxLevel'],
															'dropid' 		=> $row['dropid'],
															'spawntype' 	=> $row['spawntype'],
															'respawntime' 	=> $row['respawntime'],
															);
					}
				}
		
				foreach ($mob_array as $key => $value) {
					$link_name 	= str_replace(array( '_present','_pres', '_both' ) , '', $key);
					$name 		= str_replace('_', ' ', $link_name);

					switch( $value['spawntype'] ) {
						case 32:
							$special_spawn_condition = '<span>Lottery Spawn</span>';
						break;
						case 64:
							$special_spawn_condition = '<span>Window Spawn</span>';
						break;
						case 128:
							$special_spawn_condition = '<span>Timed / Event</span>';
						break;
						default: 
							$special_spawn_condition = '';
						break;
					}

					if ( $value['spawntype'] == 0 && $value['respawntime'] >= 1800 ) {
						$special_spawn_condition = '<span>Timed / Event</span>';
					}

					$output .= "<ul>";
						$output .= "<li class='name'><a target='_blank' href='https://ffxiclopedia.fandom.com/wiki/".$link_name."'>" . $name . "</a>".$special_spawn_condition."</li>";
						$output .= "<li class='level'>" . $value["minLevel"] . ' - ' . $value['maxLevel'] . "</li>";
						$output .= "<li class='drop'>" . get_mob_normal_drops( $value['dropid'], $th_value ) . "</li>";
						$output .= "<li class='gdrop'>" . get_mob_grouped_drops( $value['dropid'], $th_value ) . "</li>";
						$output .= "<li class='steal'>" . get_mob_steal_drops( $value['dropid'] ) . "</li>";
					$output .= "</ul>";
				}

			} else {
				$output .= "0 results";
			}
			// Free result set
			$result -> free_result();
		}

		$output .= "</div>";
		$output .= "</div>";

		return $output;
	}

	function get_rate_from_th( $base_rate, $th_value ) {
		switch ( $th_value ) {
			case 0:
				$drop_rate = $base_rate / 10;
				break;
			case 1:
				 $base_rate = $base_rate / 1000;
				$drop_rate = $base_rate + ($base_rate * (1000 - $drop_rate)/1000 * .8);
				$drop_rate = round($drop_rate * 100, 2);
				break;
			case 2:
				$base_rate 		= $base_rate / 1000;
				$last_roll_rate = round( $base_rate + ($base_rate * (1000 - $drop_rate)/1000 * .41), 2);

				$drop_rate = 1 - ( ( 1 - $base_rate ) * ( 1 - $last_roll_rate ) );
				$drop_rate = round($drop_rate * 100, 2);
				break;
			case 3:
				$base_rate 		= $base_rate / 1000;
				$last_roll_rate = round( $base_rate + ($base_rate * (1000 - $drop_rate)/1000 * .03), 2);

				$drop_rate = 1 - ( ( 1 - $base_rate ) * ( 1 - $base_rate ) * ( 1 - $last_roll_rate ) );
				$drop_rate = round($drop_rate * 100, 2);
				break;
			case 4:
				$base_rate 		= $base_rate / 1000;
				$last_roll_rate = round( $base_rate + ($base_rate * (1000 - $drop_rate)/1000 * .25), 2);

				$drop_rate = 1 - ( ( 1 - $base_rate ) * ( 1 - $base_rate ) * ( 1 - $last_roll_rate ) );
				$drop_rate = round($drop_rate * 100, 2);
				break;
			default:
				$drop_rate = $drop_rate / 10;
				break;
		}

		return $drop_rate;
	}

	function get_mob_normal_drops( $drop_ID, $th_value ) {
		global $mysqli;
		require $_SERVER['DOCUMENT_ROOT'] . '/inc/limbus_loot_array.php';

		// Omega Drops -- https://gitlab.com/ffxiwings/wings/-/blob/master/scripts/zones/Apollyon/npcs/Armoury_Crate.lua
		if ( $drop_ID == 9999999 ) {
			$counter = 1;
			foreach ($limbus_loot['omega_loot'] as $key => $value) {
				$output .= "<span style='font-weight:bold; margin: 20px 0 10px; font-size: 18px;'>Group " . $counter . "</span>";
				foreach ($value as $key => $value) {
					$itemid = $value['itemid'];
					$drop_rate = $value['droprate'] / 10;
					$output .= '<span>' . get_item_name($itemid) . '&nbsp;&nbsp;(' . $drop_rate . '%)</span>';	
				}
				$counter++;
			}
			return $output;
		}
		// Omega Gunpod Drops -- https://gitlab.com/ffxiwings/wings/-/blob/master/scripts/zones/Apollyon/npcs/Armoury_Crate.lua
		if ( $drop_ID == 999999 ) {
			$counter = 1;
			foreach ($limbus_loot['omega_gunpod'] as $key => $value) {
				$output .= "<span style='font-weight:bold; margin: 20px 0 10px; font-size: 18px;'>Group " . $counter . "</span>";
				foreach ($value as $key => $value) {
					$itemid = $value['itemid'];
					$drop_rate = $value['droprate'] / 10;
					$output .= '<span>' . get_item_name($itemid) . '&nbsp;&nbsp;(' . $drop_rate . '%)</span>';	
				}
				$counter++;
			}
			return $output;
		}
		// Ultima Drops -- https://gitlab.com/ffxiwings/wings/-/blob/master/scripts/zones/Temenos/npcs/Armoury_Crate.lua
		if ( $drop_ID == 99999 ) {
			$counter = 1;
			foreach ($limbus_loot['ultima_loot'] as $key => $value) {
				$output .= "<span style='font-weight:bold; margin: 20px 0 10px; font-size: 18px;'>Group " . $counter . "</span>";
				foreach ($value as $key => $value) {
					$itemid = $value['itemid'];
					if ( $itemid == 0 ) { $itemdid = "Nothing"; }
					$drop_rate = $value['droprate'] / 10;
					$output .= '<span>' . get_item_name($itemid) . '&nbsp;&nbsp;(' . $drop_rate . '%)</span>';	
				}
				$counter++;
			}
			return $output;
		}

		$output = '';
		if ($result = $mysqli -> query("SELECT * FROM mob_droplist WHERE dropId = ".$drop_ID." AND dropType = 0")) {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$drop_rate = get_rate_from_th( $row['itemRate'], $th_value );

					$output .= '<span><a href="https://www.wingsxi.com/wings/index.php?page=item&id='.$row['itemId'].'" target="_blank">' . get_item_name($row['itemId']) . ' <i class="fas fa-external-link-alt"></i></a>&nbsp;&nbsp;(' . $drop_rate . '%)&nbsp;&nbsp;('. get_item_value($row['itemId']) . ' gil)</span>';
				}
			} else {
				$output = "<span>No Drops Found</span>";
			}
		}
		return $output;
	}

	function get_mob_steal_drops( $drop_ID ) {
		global $mysqli;
		
		$output = '';
		if ($result = $mysqli -> query("SELECT * FROM mob_droplist WHERE dropId = ".$drop_ID." AND dropType = 2")) {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$output .= '<span><a href="https://www.wingsxi.com/wings/index.php?page=item&id='.$row['itemId'].'" target="_blank">' . get_item_name($row['itemId']) . ' <i class="fas fa-external-link-alt"></i></a>&nbsp;&nbsp;('. get_item_value($row['itemId']) . ' gil)</span>';
				}
			} else {
				$output .= 'N/A';
			}
		}
		return $output;
	}

	function get_mob_grouped_drops( $drop_ID, $th_value ) {
		global $mysqli;

		$output = '';
		$group_id = -1;
		$i = 1;
		if ($result = $mysqli -> query("SELECT * FROM mob_droplist WHERE dropId = ".$drop_ID." AND dropType = 1 order by groupId")) {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if ( $group_id != $row['groupId'] ) {
						// Final info from previous group
						if ( $group_id != -1 ) {
							$output .= "<span>Total Item Weight: " . $total_rate . "</span>";
						}
						$total_rate = 0;
						$group_id = $row['groupId'];
						$output .= "<span><b>Group " . $group_id . "</b> Rate: " . $row['groupRate'] / 10 . "% (not including TH)</span>";
					}
					$item_rate = $row['itemRate'];
					$total_rate += $item_rate;
					$output .= '<span>' . get_item_name($row['itemId']) . ' ('. get_item_value($row['itemId']) . ' gil) (Wght: ' . $item_rate . ') </span>';
					$i++;
				}
				$output .= "<span>Total Item Weight: " . $total_rate . "</span><span>&nbsp;</span>";
			} else {
				$output .= 'N/A';
			}
		}

		return $output;
	}

// BCNM
	function build_bcnm_drop_down() {
		require $_SERVER['DOCUMENT_ROOT'] . '/inc/bcnm_arrays.php';

		ksort($bcnms_master_table);

		$output = '';

		$output .= "<select id='bcnm_select'>";
			$output .= "<option value='xx' selected>Choose a BCNM / KSNM / ENM</option>";
			foreach ($bcnms_master_table as $key => $value) {
				$proper_name = ucwords(str_replace('_', ' ', $key));
				if ( $key == 'royal_jelly' ) {
					$output .= "<option value='{$key}' selected>{$proper_name}</option>";
				} else {
					$output .= "<option value='{$key}'>{$proper_name}</option>";	
				}
				
			}
		$output .= "</select>";

		return $output;
	}

	function get_bcnm_drops( $bcnm ) {
		require $_SERVER['DOCUMENT_ROOT'] . '/inc/bcnm_arrays.php';

		$output = "";
		if (!empty($bcnms_master_table[$bcnm])) {
			$selected_bcnm = $bcnms_master_table[$bcnm];

			foreach ($selected_bcnm as $key => $value) {
				$output .= "<div class='group'>";
					$output .= "<h2>";
						$output .= "Drop Group ";
						$output .= $key + 1;
					$output .= "</h2>";
					$output .= "<ul>";
					foreach ($value as $key => $value) {
						$item_name 	= ($value['itemid'] != 0) 		? get_item_name($value['itemid']) 	: 'Nothing';
						$amount 	= ($value['itemid'] == 65535) 	? $value['amount'] 					: '';
						$output .= "<li>";
							$output .= '<a href="https://www.wingsxi.com/wings/index.php?page=item&id='.$value['itemid'].'" target="_blank">' . $item_name . '</a> ' . $amount . ' - ' . $value['droprate'] / 10 . '%';
						$output .= "</li>";
					}
					$output .= "</ul>";
				$output .= "</div>";
			}
		}
		return $output;
	}

// GUILD
	function build_guild_drop_down() {
		global $mysqli;

		$output = '';
		// Perform query to get mobs
		$result = $mysqli -> query("SELECT * FROM guilds WHERE 1");
		if ($result->num_rows > 0) {
			$output .= "<select id='guild_select'>";
				$output .= "<option value='xx'>Choose a Guild</option>";
				while($row = $result->fetch_assoc()) {
					$proper_name 	= ucwords(str_replace('_', ' ', $row['points_name']));
					$guild_id 		= $row['id'];
					$output .= "<option value='{$guild_id}'>{$proper_name}</option>";
				}
			$output .= "</select>";	
		}
		return $output;
	}

	function get_guild_point_items( $guild_id ) {
		global $mysqli;
		
		$output = '';
		// Perform query to get mobs
		$result = $mysqli -> query("SELECT
										guild_item_points.guildid,
										guild_item_points.rank,
										guild_item_points.points,
										guild_item_points.pattern,
										guild_item_points.max_points,
										item_basic.name	
								    FROM guild_item_points 
									LEFT JOIN item_basic ON item_basic.itemid = guild_item_points.itemid    
									WHERE guildid = {$guild_id} ORDER BY rank, pattern, points");

		if ($result->num_rows > 0) {

			$gp_items = array();

			while($row = $result->fetch_assoc()) {
				$item_name  = $item_name = ucwords(str_replace('_', ' ', $row['name']));;
				$rank 		= $row['rank'];
				$points 	= $row['points'];
				$max_points = $row['max_points'];
				$pattern 	= $row['pattern'];
				
				if ( !empty($gp_items[$rank]) and array_key_exists( $pattern, $gp_items[$rank] ) ) {
					$gp_items[$rank][$pattern]["hqpoints"] = $points;
				} else {
					$gp_items[$rank][$pattern] = array(
											"item_name" => $item_name,
											"points"	=> $points,
											"maxpoints"	=> $max_points
										);
				}
			}
		}

		if ( count($gp_items) > 0 ) {
			foreach ($gp_items as $key => $value) {
				// Get our Rank Title
				switch ( $key ) {
					case 0:
						$rank_title = "Amateur";
						break;					
					case 1:
						$rank_title = "Recruit";
						break;
					case 2:
						$rank_title = "Initiate";
						break;
					case 3:
						$rank_title = "Novice";
						break;
					case 4:
						$rank_title = "Apprentice";
						break;
					case 5:
						$rank_title = "Journeyman";
						break;
					case 6:
						$rank_title = "Craftsman";
						break;
					case 7:
						$rank_title = "Artisan";
						break;
					case 8:
						$rank_title = "Adept";
						break;
					case 9:
						$rank_title = "Veteran";
						break;
					default:
						$rank_title = "";
						break;
				}

				$output .= "<div>";
					$output .= "<h2 class='rank_heading'>{$rank_title}</h2>";
					$output .= "<ul class='header'>
									<li class='name'>Name</li> 
									<li class='point_value'>Point Value</li> 
									<li class='turn_in'>Turn In Qty</li> 
									<li class='max_points'>Max Points</li> 
								</ul>";	
					foreach ($value as $key => $value) {
						$item_name  = $value['item_name'];
						$item_link	= str_replace(' ', '_', $item_name);
						$points 	= $value['points'];
						$max_points = $value['maxpoints'];

						$count 		= round( $max_points / $points, 2 );

						if ( !empty($value['hqpoints']) ) {
							$hq_points 	= " (HQ: " . $value['hqpoints'] . ")";
							$hq_count	= " / " . round( $max_points / $value['hqpoints'], 2 );
						} else {
							$hq_points = '';
							$hq_count = '';
						}

						$output .= "<ul>";
							$output .= "<li><a href='https://ffxiclopedia.fandom.com/wiki/{$item_link}' target='_blank'>{$item_name}</a></li>";
							$output .= "<li>{$points}{$hq_points}</li>";
							$output .= "<li>{$count}{$hq_count}</li>";
							$output .= "<li>{$max_points}</li>";
						$output .= "</ul>";
					}
				$output .= "</div>";
			}
		}

		return $output;
	}

// CHOCOBO DIGGING
	function build_chocobo_digging_drop_down() {
		require $_SERVER['DOCUMENT_ROOT'] . '/inc/chocobo_digging_arrays.php';

		// echo '<pre>';
		// print_r($digInfo);
		// echo '</pre>';
		ksort($digInfo);

		$output = '';

		$output .= "<select id='cd_zone_select'>";
			$output .= "<option value='xx'>Choose a Zone</option>";
			foreach ($digInfo as $key => $value) {
				$proper_name = ucwords(strtolower(str_replace('_', ' ', $key)));
				$output .= "<option value='{$key}'>{$proper_name}</option>";	
			}
		$output .= "</select>";

		return $output;
	}

	function get_chocobo_digging_drops( $zone ) {
		require $_SERVER['DOCUMENT_ROOT'] . '/inc/chocobo_digging_arrays.php';

		$selected_dig_zone = $digInfo[$zone];

		$output = "";

		if ( $selected_dig_zone ) {
			$proper_name = ucwords(strtolower(str_replace('_', ' ', $zone)));
			$output .= "<h2>" . $proper_name . "</h2>";
			$output .= "<ul class='header'>
							<li class='name'>Item</li> 
							<li class='dig_chance'>Dig Chance</li> 
							<li class='dig_special'>Special Ability Required</li> 
						</ul>";

			foreach ($selected_dig_zone as $key => $value) {
				$output .= "<ul>";
					if ( $value['itemid'] == 1255) {
						$item_name 		= "Elemental Ore*";
					} elseif ( $value['itemid'] == 4096 ) {
						$item_name 		= "Elemental Crystal**";
					} else {
						$item_name 		= get_item_name($value['itemid']);
					}

					$dig_rate		= $value['digrate'] / 10;
					$dig_special	= ($value['digspecial'] == 'MODIFIER') ? 'EGG HELM' : $value['digspecial'];

					$output .= "<li data-id=" . $value['itemid'] . "><a href='https://www.wingsxi.com/wings/index.php?page=item&id=" . $value['itemid'] . "' target='_blank'>" . $item_name . "</a></li>";
					$output .= "<li>" . $dig_rate . "%</li>";
					$output .= "<li>" . $dig_special . "</li>";

				$output .= "</ul>";
			}

			$output .= "<p>&nbsp;</p>";
			$output .= "<p style='margin-bottom:0;'>";
				$output .= "* Elemental Ores are only available while the following are true:";
			$output .= "</p>";
			$output .= "<ol style='margin-top:5px;'>";
				$output .= "<li>Active weather event</li>";
				$output .= "<li>The moon is waxing between 7% and 24%</li>";
				$output .= "<li>Player has rank Craftsman or higher digging</li>";
			$output .= "</ol>";
			$output .= "<p>";
				$output .= "The ore obtained will correspond with the element of the day it was dug up on. i.e. Fire ore will appear on Firesday regardless of the weather type.";
			$output .= "</p>";
			
			$output .= "<p>";
				$output .= "** Elemental Crystals are only available during an active weather event.";
			$output .= "</p>";
		}

		return $output;
	}

// COFFERS & CHESTS
	function build_chest_coffer_drop_down() {
		require $_SERVER['DOCUMENT_ROOT'] . '/inc/treasure_chest_array.php';
		require $_SERVER['DOCUMENT_ROOT'] . '/inc/treasure_coffer_array.php';

		$zone_output = array_merge( $treasure_chest_array, $treasure_coffer_array );
		ksort($zone_output);

		$output = '';

		$output .= "<select id='chest_coffer_select'>";
			$output .= "<option value='xx'>Choose a Zone</option>";
			foreach ($zone_output as $key => $value ) {
				$proper_name = ucwords(strtolower(str_replace('_', ' ', $key)));
				$output .= "<option value='{$key}'>{$proper_name}</option>";	
			}
		$output .= "</select>";

		return $output;
	}

	function get_chest_coffer_drops( $zone ) {

		if ( $zone == 'xx' ) {
			return;
		}

		require $_SERVER['DOCUMENT_ROOT'] . '/inc/treasure_chest_array.php';
		require $_SERVER['DOCUMENT_ROOT'] . '/inc/treasure_coffer_array.php';

		$selected_chest 	= $treasure_chest_array[$zone];
		$selected_coffer 	= $treasure_coffer_array[$zone];
	
		$proper_name = ucwords(strtolower(str_replace('_', ' ', $zone)));

		$output = "";

		if ( $selected_chest != '' ) {
			$output .= "<h3>{$proper_name} Chests</h3>";
			foreach ($selected_chest as $key => $value) {
				switch( $key ) {
					case "gil":
						$output .= '<button class="accordion">' . ucwords(strtolower(str_replace('_', ' ', $key))) . ' ' . $value['chance'] * 100 . '%</button>';
						$output .= '<div class="panel">';
							$output .= '<p>MIN: ' . $value['min'] . '</p>';
							$output .= '<p>MAX: ' . $value['max'] . '</p>';
						$output .= '</div>';
					break;
					case "gem":
						$output .= '<button class="accordion">' . ucwords(strtolower(str_replace('_', ' ', $key))) . 's ' . $value['chance'] * 100 . '%</button>';
					break;
					case "stones":
						$output .= '<div class="panel">';
							foreach ($value as $key => $value) {
								$output .= '<p> - ' . get_item_name($value) . '</p>';
							}
						$output .= '</div>';
					break;
					case "item":
						$output .= '<button class="accordion">' . ucwords(strtolower(str_replace('_', ' ', $key))) . 's ' . $value['chance'] * 100 . '%</button>';
						$output .= '<div class="panel">';
							foreach ($value['itemids'] as $value) {
								$output .= '<p> - ' . get_item_name($value) . '</p>';
							}
						$output .= '</div>';
					break;
					case "quest_items":
						$output .= '<button class="accordion">' . ucwords(strtolower(str_replace('_', ' ', $key))) . ' <span style="font-size:12px;">*Must have the proper quest active to receive this item</span></button>';
						$output .= '<div class="panel">';
							foreach ($value as $key => $value) {
								$output .= '<p> - ' . $value . '</p>';
							}
						$output .= '</div>';
					break;
				}
			}
		}

		if ( $selected_coffer != '' ) {
			$output .= "<h3>{$proper_name} Coffer</h3>";
			foreach ($selected_coffer as $key => $value) {
				switch( $key ) {
					case 'hands':
						$output .= '<button class="accordion">AF Hands <span style="font-size:12px;">*Must have the proper quest active to receive this item</span></button>';
						$output .= '<div class="panel">';
							foreach ($value as $key => $value) {
								$output .= '<p> - ' . $value . '</p>';
							}
						$output .= '</div>';
					break;
					case 'af':
						$output .= '<button class="accordion">AF Armor <span style="font-size:12px;">*Must have the proper quest active to receive this item</span></button>';
						$output .= '<div class="panel">';
							foreach ($value as $key => $value) {
								$output .= '<p> - ' . $value . ' <span style="font-size:12px;">('.$key.')</span></p>';
							}
						$output .= '</div>';
					break;
					case "gil":
						$output .= '<button class="accordion">' . ucwords(strtolower(str_replace('_', ' ', $key))) . ' ' . $value['chance'] * 100 . '%</button>';
						$output .= '<div class="panel">';
							$output .= '<p>MIN: ' . $value['min'] . '</p>';
							$output .= '<p>MAX: ' . $value['max'] . '</p>';
						$output .= '</div>';
					break;
					case "gem":
						$output .= '<button class="accordion">' . ucwords(strtolower(str_replace('_', ' ', $key))) . 's ' . $value['chance'] * 100 . '%</button>';
					break;
					case "stones":
						$output .= '<div class="panel">';
							foreach ($value as $key => $value) {
								$output .= '<p> - ' . get_item_name($value) . '</p>';
							}
						$output .= '</div>';
					break;
					case "item":
						$output .= '<button class="accordion">' . ucwords(strtolower(str_replace('_', ' ', $key))) . 's ' . $value['chance'] * 100 . '%</button>';
						$output .= '<div class="panel">';
							foreach ($value['itemids'] as $value) {
								$output .= '<p> - ' . get_item_name($value) . '</p>';
							}
						$output .= '</div>';
					break;
					case "misc":
						$output .= '<button class="accordion">Quest Items <span style="font-size:12px;">*Must have the proper quest active to receive this item</span></button>';
						$output .= '<div class="panel">';
							foreach ($value as $key => $value) {
								$output .= '<p> - ' . $value . '</p>';
							}
						$output .= '</div>';
					break;
				}
			}
		}

		return $output;
	}
// GEAR
	// Old MOD LIST
	$mod_id_array = array(
		"NONE" => 0,
		"DEF" => 1,
		"HP" => 2,
		"HP %" => 3,
		"CONVERT MP TO HP" => 4,
		"MP" => 5,
		"MP %" => 6,
		"CONVERT HP TO MP" => 7,
		"STR" => 8,
		"DEX" => 9,
		"VIT" => 10,
		"AGI" => 11,
		"INT" => 12,
		"MND" => 13,
		"CHR" => 14,
		"MAX TP" => 969,
		"FIRE DEF" => 15,
		"ICE DEF" => 16,
		"WIND DEF" => 17,
		"EARTH DEF" => 18,
		"THUNDER DEF" => 19,
		"WATER DEF" => 20,
		"LIGHT DEF" => 21,
		"DARK DEF" => 22,
		"ATT" => 23,
		"RANGED ATT" => 24,
		"ACC" => 25,
		"RANGED ACC" => 26,
		"ENMITY" => 27,
		"MAGIC ATT" => 28,
		"MAGIC DEF" => 29,
		"MAGIC ACC" => 30,
		"MAGIC EVA" => 31,
		// "FIRE ATT" => 32,
		// "ICE ATT" => 33,
		// "WIND ATT" => 34,
		// "EARTH ATT" => 35,
		// "THUNDER ATT" => 36,
		// "WATER ATT" => 37,
		// "LIGHT ATT" => 38,
		// "DARK ATT" => 39,
		// "FIRE ACC" => 40,
		// "ICE ACC" => 41,
		// "WIND ACC" => 42,
		// "EARTH ACC" => 43,
		// "THUNDER ACC" => 44,
		// "WATER ACC" => 45,
		// "LIGHT ACC" => 46,
		// "DARK ACC" => 47,
		// "WS ACC" => 48,
		"SLASH RESISTANCE" => 49,
		"PIERCE RESISTANCE" => 50,
		"IMPACT RESISTANCE" => 51,
		"HTH RESISTANCE" => 52,
		"H2H RESISTANCE" => 52,
		"FIRE RESISTANCE" => 54,
		"ICE RESISTANCE" => 55,
		"WIND RESISTANCE" => 56,
		"EARTH RESISTANCE" => 57,
		"THUNDER RESISTANCE" => 58,
		"WATER RESISTANCE" => 59,
		"LIGHT RESISTANCE" => 60,
		"DARK RESISTANCE" => 61,
		// "SDT FIRE" => 1054,
		// "SDT ICE" => 1055,
		// "SDT WIND" => 1056,
		// "SDT EARTH" => 1057,
		// "SDT THUNDER" => 1058,
		// "SDT WATER" => 1059,
		// "SDT LIGHT" => 1060,
		// "SDT DARK" => 1061,
		// "ATT P" => 62,
		// "DEF P" => 63,
		// "COMBAT SKILLUP RATE" => 64,
		// "MAGIC SKILLUP RATE" => 65,
		"RATT P" => 66,
		"EVA" => 68,
		"RDEF" => 69,
		"REVA" => 70,
		"MP HEAL" => 71,
		"HP HEAL" => 72,
		"STORE TP" => 73,
		// "TACTICAL PARRY" => 486,
		"MAG BURST BONUS" => 487,
		// "INHIBIT TP" => 488,
		// "HTH" => 80,
		"H2H" => 80,
		"DAGGER" => 81,
		"SWORD" => 82,
		"GREATE SWORD" => 83,
		"AXE" => 84,
		"GAXE" => 85,
		"SCYTHE" => 86,
		"POLEARM" => 87,
		"KATANA" => 88,
		"GKATANA" => 89,
		"CLUB" => 90,
		"STAFF" => 91,
		// "AUTO MELEE SKILL" => 101,
		// "AUTO RANGED SKILL" => 102,
		// "AUTO MAGIC SKILL" => 103,
		"ARCHERY" => 104,
		"MARKSMAN" => 105,
		"THROW" => 106,
		"GUARD" => 107,
		"EVASION" => 108,
		"SHIELD" => 109,
		"PARRY" => 110,
		"DIVINE" => 111,
		"HEALING" => 112,
		"ENHANCE" => 113,
		"ENFEEBLE" => 114,
		"ELEMENTAL" => 115,
		"DARK" => 116,
		"SUMMONING" => 117,
		"NINJUTSU" => 118,
		"SINGING" => 119,
		"STRING" => 120,
		"WIND" => 121,
		"BLUE" => 122,
		// "FISH" => 127,
		// "WOOD" => 128,
		// "SMITH" => 129,
		// "GOLDSMITH" => 130,
		// "CLOTH" => 131,
		// "LEATHER" => 132,
		// "BONE" => 133,
		// "ALCHEMY" => 134,
		// "COOK" => 135,
		// "SYNERGY" => 136,
		// "RIDING" => 137,
		// "ANTIHQ WOOD" => 144,
		// "ANTIHQ SMITH" => 145,
		// "ANTIHQ GOLDSMITH" => 146,
		// "ANTIHQ CLOTH" => 147,
		// "ANTIHQ LEATHER" => 148,
		// "ANTIHQ BONE" => 149,
		// "ANTIHQ ALCHEMY" => 150,
		// "ANTIHQ COOK" => 151,
		"DMG" => 160,
		"DMGPHYS" => 161,
		"DMGPHYS II" => 190,
		"DMGBREATH" => 162,
		"DMGMAGIC" => 163,
		"DMGMAGIC II" => 831,
		"DMGRANGE" => 164,
		"UDMGPHYS" => 387,
		"UDMGBREATH" => 388,
		"UDMGMAGIC" => 389,
		"UDMGRANGE" => 390,
		"CRITHITRATE" => 165,
		"CRIT DMG INCREASE" => 421,
		"RANGED CRIT DMG INCREASE" => 964,
		"ENEMYCRITRATE" => 166,
		"CRIT DEF BONUS" => 908,
		"MAGIC CRITHITRATE" => 562,
		"MAGIC CRIT DMG INCREASE" => 563,
		"FENCER TP BONUS" => 903,
		"FENCER CRITHITRATE" => 904,
		"SMITE" => 898,
		"TACTICAL GUARD" => 899,
		"GUARD PERCENT" => 976,
		// "HASTE MAGIC" => 167,
		// "HASTE ABILITY" => 383,
		"HASTE GEAR" => 384,
		"SPELL INTERRUPT" => 168,
		"MOVE" => 169,
		// "MOUNT MOVE" => 972,
		"FASTCAST" => 170,
		"UFASTCAST" => 407,
		"CURE CAST TIME" => 519,
		// "ELEMENTAL CELERITY" => 901,
		// "DELAY" => 171,
		// "RANGED DELAY" => 172,
		"MARTIAL ARTS" => 173,
		// "SKILLCHAINBONUS" => 174,
		// "SKILLCHAINDMG" => 175,
		// "MAX SWINGS" => 978,
		// "ADDITIONAL SWING CHANCE" => 979,
		"MAGIC DAMAGE" => 311,
		// "FOOD HPP" => 176,
		// "FOOD HP CAP" => 177,
		// "FOOD MPP" => 178,
		// "FOOD MP CAP" => 179,
		// "FOOD ATTP" => 180,
		// "FOOD ATT CAP" => 181,
		// "FOOD DEFP" => 182,
		// "FOOD DEF CAP" => 183,
		// "FOOD ACCP" => 184,
		// "FOOD ACC CAP" => 185,
		// "FOOD RATTP" => 186,
		// "FOOD RATT CAP" => 187,
		// "FOOD RACCP" => 188,
		// "FOOD RACC CAP" => 189,
		// "FOOD MACCP" => 99,
		// "FOOD MACC CAP" => 100,
		// "FOOD DURATION" => 937,
		"VERMIN KILLER" => 224,
		"BIRD KILLER" => 225,
		"AMORPH KILLER" => 226,
		"LIZARD KILLER" => 227,
		"AQUAN KILLER" => 228,
		"PLANTOID KILLER" => 229,
		"BEAST KILLER" => 230,
		"UNDEAD KILLER" => 231,
		"ARCANA KILLER" => 232,
		"DRAGON KILLER" => 233,
		"DEMON KILLER" => 234,
		"EMPTY KILLER" => 235,
		"HUMANOID KILLER" => 236,
		"LUMORIAN KILLER" => 237,
		"LUMINION KILLER" => 238,
		"STATUS RESISTANCE" => 239,
		"SLEEP RESISTANCE" => 240,
		"POISON RESISTANCE" => 241,
		"PARALYZE RESISTANCE" => 242,
		"BLIND RESISTANCE" => 243,
		"SILENCE RESISTANCE" => 244,
		"VIRUS RESISTANCE" => 245,
		"PETRIFY RESISTANCE" => 246,
		"BIND RESISTANCE" => 247,
		"CURSE RESISTANCE" => 248,
		"GRAVITY RESISTANCE" => 249,
		"SLOW RESISTANCE" => 250,
		"STUN RESISTANCE" => 251,
		"CHARM RESISTANCE" => 252,
		"AMNESIA RESISTANCE" => 253,
		"LULLABY RESISTANCE" => 254,
		"DEATH RESISTANCE" => 255,
		// "SLEEPRESTRAIT" => 1240,
		// "POISONRESTRAIT" => 1241,
		// "PARALYZERESTRAIT" => 1242,
		// "BLINDRESTRAIT" => 1243,
		// "SILENCERESTRAIT" => 1244,
		// "VIRUSRESTRAIT" => 1245,
		// "PETRIFYRESTRAIT" => 1246,
		// "BINDRESTRAIT" => 1247,
		// "CURSERESTRAIT" => 1248,
		// "GRAVITYRESTRAIT" => 1249,
		// "SLOWRESTRAIT" => 1250,
		// "STUNRESTRAIT" => 1251,
		// "CHARMRESTRAIT" => 1252,
		// "AMNESIARESTRAIT" => 1253,
		// "LULLABYRESTRAIT" => 1254,
		// "DEATHRESTRAIT" => 1255,
		// "RESBUILD SLEEP" => 2002,
		// "RESBUILD POISON" => 2003,
		// "RESBUILD PARALYZE" => 2004,
		// "RESBUILD BLIND" => 2005,
		// "RESBUILD SILENCE" => 2006,
		// "RESBUILD STUN" => 2010,
		// "RESBUILD BIND" => 2011,
		// "RESBUILD GRAVITY" => 2012,
		// "RESBUILD SLOW" => 2013,
		// "RESBUILD LULLABY" => 2193,
		// "PARALYZE" => 257,
		// "MIJIN RERAISE" => 258,
		"DUAL WIELD" => 259,
		"DOUBLE ATTACK" => 288,
		// "WARCRY DURATION" => 483,
		// "BERSERK EFFECT" => 948,
		// "BERSERK DURATION" => 954,
		// "AGGRESSOR DURATION" => 955,
		// "DEFENDER DURATION" => 956,
		// "BOOST EFFECT" => 97,
		// "CHAKRA MULT" => 123,
		// "CHAKRA REMOVAL" => 124,
		"SUBTLE BLOW" => 289,
		// "COUNTER" => 291,
		// "KICK ATTACK RATE" => 292,
		// "PERFECT COUNTER ATT" => 428,
		// "FOOTWORK ATT BONUS" => 429,
		// "COUNTERSTANCE EFFECT" => 543,
		// "DODGE EFFECT" => 552,
		// "FOCUS EFFECT" => 561,
		// "AFFLATUS SOLACE" => 293,
		// "AFFLATUS MISERY" => 294,
		// "AUSPICE EFFECT" => 484,
		// "AOE NA" => 524,
		// "REGEN MULTIPLIER" => 838,
		// "CURE2MP PERCENT" => 860,
		// "DIVINE BENISON" => 910,
		"CLEAR MIND" => 295,
		"CONSERVE MP" => 296,
		// "BLINK" => 299,
		// "STONESKIN" => 300,
		// "PHALANX" => 301,
		// "ENF MAG POTENCY" => 290,
		// "ENHANCES SABOTEUR" => 297,
		"FLEE DURATION" => 93,
		"STEAL" => 298,
		"DESPOIL" => 896,
		"PERFECT DODGE" => 883,
		"TRIPLE ATTACK" => 302,
		"TREASURE HUNTER" => 303,
		"SNEAK ATK DEX" => 959,
		"TRICK ATK AGI" => 520,
		"MUG EFFECT" => 835,
		"ACC COLLAB EFFECT" => 884,
		"HIDE DURATION" => 885,
		"GILFINDER" => 897,
		"HOLY CIRCLE DURATION" => 857,
		"RAMPART DURATION" => 92,
		"ABSORB PHYSDMG TO MP" => 426,
		"SHIELD MASTERY TP" => 485,
		"SENTINEL EFFECT" => 837,
		"SHIELD DEF BONUS" => 905,
		"COVER TO MP" => 965,
		"COVER MAGIC AND RANGED" => 966,
		"COVER DURATION" => 967,
		"ARCANE CIRCLE DURATION" => 858,
		"SOULEATER EFFECT" => 96,
		"DESPERATE BLOWS" => 906,
		"STALWART SOUL" => 907,
		"TAME" => 304,
		"CHARM TIME" => 360,
		"REWARD HP BONUS" => 364,
		// "CHARM CHANCE" => 391,
		"FERAL HOWL DURATION" => 503,
		"JUG LEVEL RANGE" => 564,
		// "CALL BEAST DELAY" => 572,
		// "MINNE EFFECT" => 433,
		// "MINUET EFFECT" => 434,
		// "PAEON EFFECT" => 435,
		// "REQUIEM EFFECT" => 436,
		// "THRENODY EFFECT" => 437,
		// "MADRIGAL EFFECT" => 438,
		// "MAMBO EFFECT" => 439,
		// "LULLABY EFFECT" => 440,
		// "ETUDE EFFECT" => 441,
		// "BALLAD EFFECT" => 442,
		// "MARCH EFFECT" => 443,
		// "FINALE EFFECT" => 444,
		// "CAROL EFFECT" => 445,
		// "MAZURKA EFFECT" => 446,
		// "ELEGY EFFECT" => 447,
		// "PRELUDE EFFECT" => 448,
		// "HYMNUS EFFECT" => 449,
		// "VIRELAI EFFECT" => 450,
		// "SCHERZO EFFECT" => 451,
		"ALL SONGS EFFECT" => 452,
		"MAXIMUM SONGS BONUS" => 453,
		"SONG DURATION BONUS" => 454,
		"SONG SPELLCASTING TIME REDUCTION" => 455,
		"SONG RECAST DELAY" => 833,
		"CAMOUFLAGE DURATION" => 98,
		"RECYCLE" => 305,
		"SNAP SHOT" => 365,
		"RAPID SHOT" => 359,
		"WIDESCAN" => 340,
		"BARRAGE ACC" => 420,
		"DOUBLE SHOT RATE" => 422,
		"VELOCITY SNAPSHOT BONUS" => 423,
		"VELOCITY RATT BONUS" => 424,
		"SHADOW BIND EXT" => 425,
		"SCAVENGE EFFECT" => 312,
		"SHARPSHOT" => 314,
		"WARDING CIRCLE DURATION" => 95,
		"MEDITATE DURATION" => 94,
		"ZANSHIN" => 306,
		"THIRD EYE COUNTER RATE" => 508,
		"THIRD EYE ANTICIPATE RATE" => 839,
		"UTSUSEMI" => 307,
		"UTSUSEMI BONUS" => 900,
		"NINJA TOOL" => 308,
		"NIN NUKE BONUS" => 522,
		"DAKEN" => 911,
		"ANCIENT CIRCLE DURATION" => 859,
		"JUMP TP BONUS" => 361,
		"JUMP ATT BONUS" => 362,
		"HIGH JUMP ENMITY REDUCTION" => 363,
		"FORCE JUMP CRIT" => 828,
		"WYVERN EFFECTIVE BREATH" => 829,
		"WYVERN SUBJOB TRAITS" => 974,
		"AVATAR PERPETUATION" => 371,
		"WEATHER REDUCTION" => 372,
		"DAY REDUCTION" => 373,
		"PERPETUATION REDUCTION" => 346,
		"BP DELAY" => 357,
		"ENHANCES ELEMENTAL SIPHON" => 540,
		"BP DELAY II" => 541,
		"BP DAMAGE" => 126,
		"BLOOD BOON" => 913,
		"SPIRIT RECAST REDUCTION" => 960,
		"BLUE POINTS" => 309,
		"BLUE LEARN CHANCE" => 945,
		"MONSTER CORRELATION BONUS" => 936,
		"EXP BONUS" => 382,
		"ROLL RANGE" => 528,
		"JOB BONUS CHANCE" => 542,
		"QUICK DRAW DELAY" => 571,
		"RANDOM DEAL BONUS" => 573,
		"DMG REFLECT" => 316,
		"ROLL ROGUES" => 317,
		"ROLL GALLANTS" => 318,
		"ROLL CHAOS" => 319,
		"ROLL BEAST" => 320,
		"ROLL CHORAL" => 321,
		"ROLL HUNTERS" => 322,
		"ROLL SAMURAI" => 323,
		"ROLL NINJA" => 324,
		"ROLL DRACHEN" => 325,
		"ROLL EVOKERS" => 326,
		"ROLL MAGUS" => 327,
		"ROLL CORSAIRS" => 328,
		"ROLL PUPPET" => 329,
		"ROLL DANCERS" => 330,
		"ROLL SCHOLARS" => 331,
		"ROLL BOLTERS" => 869,
		"ROLL CASTERS" => 870,
		"ROLL COURSERS" => 871,
		"ROLL BLITZERS" => 872,
		"ROLL TACTICIANS" => 873,
		"ROLL ALLIES" => 874,
		"ROLL MISERS" => 875,
		"ROLL COMPANIONS" => 876,
		"ROLL AVENGERS" => 877,
		"ROLL NATURALISTS" => 878,
		"ROLL RUNEISTS" => 879,
		"BUST" => 332,
		"QUICK DRAW DMG" => 411,
		"QUICK DRAW DMG PERCENT" => 834,
		"QUICK DRAW MACC" => 191,
		"PHANTOM ROLL" => 881,
		"PHANTOM DURATION" => 882,
		"MANEUVER BONUS" => 504,
		"OVERLOAD THRESH" => 505,
		"AUTO DECISION DELAY" => 842,
		"AUTO SHIELD BASH DELAY" => 843,
		"AUTO MAGIC DELAY" => 844,
		"AUTO HEALING DELAY" => 845,
		"AUTO HEALING THRESHOLD" => 846,
		"BURDEN DECAY" => 847,
		"AUTO SHIELD BASH SLOW" => 848,
		"AUTO TP EFFICIENCY" => 849,
		"AUTO SCAN RESISTS" => 850,
		"REPAIR EFFECT" => 853,
		"REPAIR POTENCY" => 854,
		"PREVENT OVERLOAD" => 855,
		"SUPPRESS OVERLOAD" => 125,
		"AUTO STEAM JACKET" => 938,
		"AUTO STEAM JACKED REDUCTION" => 939,
		"AUTO SCHURZEN" => 940,
		"AUTO EQUALIZER" => 941,
		"AUTO PERFORMANCE BOOST" => 942,
		"AUTO ANALYZER" => 943,
		"FINISHING MOVES" => 333,
		"SAMBA DURATION" => 490,
		"WALTZ POTENTCY" => 491,
		"CHOCOBO JIG DURATION" => 492,
		"VFLOURISH MACC" => 493,
		"STEP FINISH" => 494,
		"STEP ACCURACY" => 403,
		"WALTZ DELAY" => 497,
		"SAMBA PDURATION" => 498,
		"SPECTRAL JIG DURATION" => 502,
		"REVERSE FLOURISH EFFECT" => 836,
		"BLACK MAGIC COST" => 393,
		"WHITE MAGIC COST" => 394,
		"BLACK MAGIC CAST" => 395,
		"WHITE MAGIC CAST" => 396,
		"BLACK MAGIC RECAST" => 397,
		"WHITE MAGIC RECAST" => 398,
		"ALACRITY CELERITY EFFECT" => 399,
		"LIGHT ARTS EFFECT" => 334,
		"DARK ARTS EFFECT" => 335,
		"LIGHT ARTS SKILL" => 336,
		"DARK ARTS SKILL" => 337,
		"LIGHT ARTS REGEN" => 338,
		"REGEN DURATION" => 339,
		"HELIX EFFECT" => 478,
		"HELIX DURATION" => 477,
		"STORMSURGE EFFECT" => 400,
		"SUBLIMATION BONUS" => 401,
		"GRIMOIRE SPELLCASTING" => 489,
		"CARDINAL CHANT" => 12100,
		"INDI DURATION" => 12101,
		"GEOMANCY" => 12102,
		"WIDENED COMPASS" => 12103,
		"MENDING HALATION" => 12104,
		"RADIAL ARCANA" => 12105,
		"CURATIVE RECANTATION" => 12106,
		"PRIMEVAL ZEAL" => 12107,
		"ENSPELL" => 341,
		"ENSPELL DMG" => 343,
		"ENSPELL DMG BONUS" => 432,
		"ENSPELL CHANCE" => 856,
		"SPIKES" => 342,
		"SPIKES DMG" => 344,
		"TP BONUS" => 345,
		"SAVETP" => 880,
		"CONSERVE TP" => 944,
		"WYRMAL ABJ KILLER EFFECT" => 53,
		"INQUARTATA" => 963,
		"FIRE AFFINITY DMG" => 347,
		"ICE AFFINITY DMG" => 348,
		"WIND AFFINITY DMG" => 349,
		"EARTH AFFINITY DMG" => 350,
		"THUNDER AFFINITY DMG" => 351,
		"WATER AFFINITY DMG" => 352,
		"LIGHT AFFINITY DMG" => 353,
		"DARK AFFINITY DMG" => 354,
		"FIRE AFFINITY ACC" => 544,
		"ICE AFFINITY ACC" => 545,
		"WIND AFFINITY ACC" => 546,
		"EARTH AFFINITY ACC" => 547,
		"THUNDER AFFINITY ACC" => 548,
		"WATER AFFINITY ACC" => 549,
		"LIGHT AFFINITY ACC" => 550,
		"DARK AFFINITY ACC" => 551,
		"FIRE AFFINITY PERP" => 553,
		"ICE AFFINITY PERP" => 554,
		"WIND AFFINITY PERP" => 555,
		"EARTH AFFINITY PERP" => 556,
		"THUNDER AFFINITY PERP" => 557,
		"WATER AFFINITY PERP" => 558,
		"LIGHT AFFINITY PERP" => 559,
		"DARK AFFINITY PERP" => 560,
		"ADDS WEAPONSKILL" => 355,
		"ADDS WEAPONSKILL DYN" => 356,
		"STEALTH" => 358,
		"SNEAK DURATION" => 946,
		"INVISIBLE DURATION" => 947,
		"MAIN DMG RATING" => 366,
		"SUB DMG RATING" => 367,
		"REGAIN" => 368,
		"REGAIN DOWN" => 406,
		"REFRESH" => 369,
		"REFRESH DOWN" => 405,
		"REGEN" => 370,
		"REGEN DOWN" => 404,
		"CURE POTENCY" => 374,
		"CURE POTENCY II" => 260,
		"CURE POTENCY RCVD" => 375,
		"RANGED DMG RATING" => 376,
		"MAIN DMG RANK" => 377,
		"SUB DMG RANK" => 378,
		"RANGED DMG RANK" => 379,
		"DELAYP" => 380,
		"RANGED DELAYP" => 381,
		"SHIELD BASH" => 385,
		"KICK DMG" => 386,
		"WEAPON BASH" => 392,
		"WYVERN BREATH" => 402,
		"DA DOUBLE DAMAGE" => 408,
		"TA TRIPLE DAMAGE" => 409,
		"ZANSHIN DOUBLE DAMAGE" => 410,
		"RAPID SHOT DOUBLE DAMAGE" => 479,
		"ABSORB DMG CHANCE" => 480,
		"EXTRA DUAL WIELD ATTACK" => 481,
		"EXTRA KICK ATTACK" => 482,
		"SAMBA DOUBLE DAMAGE" => 415,
		"NULL PHYSICAL DAMAGE" => 416,
		"QUICK DRAW TRIPLE DAMAGE" => 417,
		"BAR ELEMENT NULL CHANCE" => 418,
		"GRIMOIRE INSTANT CAST" => 419,
		"QUAD ATTACK" => 430,
		"RERAISE I" => 456,
		"RERAISE II" => 457,
		"RERAISE III" => 458,
		"FIRE ABSORB" => 459,
		"ICE ABSORB" => 460,
		"WIND ABSORB" => 461,
		"EARTH ABSORB" => 462,
		"LTNG ABSORB" => 463,
		"WATER ABSORB" => 464,
		"LIGHT ABSORB" => 465,
		"DARK ABSORB" => 466,
		"FIRE NULL" => 467,
		"ICE NULL" => 468,
		"WIND NULL" => 469,
		"EARTH NULL" => 470,
		"LTNG NULL" => 471,
		"WATER NULL" => 472,
		"LIGHT NULL" => 473,
		"DARK NULL" => 474,
		"MAGIC ABSORB" => 475,
		"MAGIC NULL" => 476,
		"PHYS ABSORB" => 512,
		"ABSORB DMG TO MP" => 516,
		"ADDITIONAL EFFECT" => 431,
		"ITEM SPIKES TYPE" => 499,
		"ITEM SPIKES DMG" => 500,
		"ITEM SPIKES CHANCE" => 501,
		// "GOV CLEARS" => 496,
		// "AFTERMATH" => 256,
		// "EXTRA DMG CHANCE" => 506,
		// "OCC DO EXTRA DMG" => 507,
		// "REM OCC DO DOUBLE DMG" => 863,
		// "REM OCC DO TRIPLE DMG" => 864,
		// "REM OCC DO DOUBLE DMG RANGED" => 867,
		// "REM OCC DO TRIPLE DMG RANGED" => 868,
		// "MYTHIC OCC ATT TWICE" => 865,
		// "MYTHIC OCC ATT THRICE" => 866,
		// "EAT RAW FISH" => 412,
		// "EAT RAW MEAT" => 413,
		// "ENHANCES CURSNA RCVD" => 67,
		// "ENHANCES CURSNA" => 310,
		// "ENHANCES HOLYWATER" => 495,
		// "RETALIATION" => 414,
		// "CLAMMING IMPROVED RESULTS" => 509,
		// "CLAMMING REDUCED INCIDENTS" => 510,
		// "CHOCOBO RIDING TIME" => 511,
		// "HARVESTING RESULT" => 513,
		// "LOGGING RESULT" => 514,
		// "MINING RESULT" => 515,
		// "EGGHELM" => 517,
		"SHIELD BLOCK RATE" => 518,
		// "DIA DOT" => 313,
		// "ENH DRAIN ASPIR" => 315,
		// "AUGMENTS ABSORB" => 521,
		// "AMMO SWING" => 523,
		// "AMMO SWING TYPE" => 826,
		// "AUGMENTS CONVERT" => 525,
		// "AUGMENTS SA" => 526,
		// "AUGMENTS TA" => 527,
		// "AUGMENTS FEINT" => 888,
		// "AUGMENTS ASSASSINS CHARGE" => 886,
		// "AUGMENTS AMBUSH" => 887,
		// "AUGMENTS AURA STEAL" => 889,
		// "AUGMENTS CONSPIRATOR" => 912,
		// "ENHANCES REFRESH" => 529,
		// "NO SPELL MP DEPLETION" => 530,
		// "FORCE FIRE DWBONUS" => 531,
		// "FORCE ICE DWBONUS" => 532,
		// "FORCE WIND DWBONUS" => 533,
		// "FORCE EARTH DWBONUS" => 534,
		// "FORCE LIGHTNING DWBONUS" => 535,
		// "FORCE WATER DWBONUS" => 536,
		// "FORCE LIGHT DWBONUS" => 537,
		// "FORCE DARK DWBONUS" => 538,
		// "STONESKIN BONUS HP" => 539,
		"DAY NUKE BONUS" => 565,
		// "IRIDESCENCE" => 566,
		"BARSPELL AMOUNT" => 567,
		"BARSPELL MDEF BONUS" => 827,
		// "RAPTURE AMOUNT" => 568,
		// "EBULLIENCE AMOUNT" => 569,
		// "ENH MAGIC DURATION" => 890,
		// "ENHANCES COURSERS ROLL" => 891,
		// "ENHANCES CASTERS ROLL" => 892,
		// "ENHANCES BLITZERS ROLL" => 893,
		// "ENHANCES ALLIES ROLL" => 894,
		// "ENHANCES TACTICIANS ROLL" => 895,
		// "OCCULT ACUMEN" => 902,
		// "QUICK MAGIC" => 909,
		// "SYNTH SUCCESS" => 851,
		// "SYNTH SKILL GAIN" => 852,
		// "SYNTH FAIL RATE" => 861,
		// "SYNTH HQ RATE" => 862,
		// "DESYNTH SUCCESS" => 916,
		// "SYNTH FAIL RATE FIRE" => 917,
		// "SYNTH FAIL RATE ICE" => 918,
		// "SYNTH FAIL RATE WIND" => 919,
		// "SYNTH FAIL RATE EARTH" => 920,
		// "SYNTH FAIL RATE LIGHTNING" => 921,
		// "SYNTH FAIL RATE WATER" => 922,
		// "SYNTH FAIL RATE LIGHT" => 923,
		// "SYNTH FAIL RATE DARK" => 924,
		// "SYNTH FAIL RATE WOOD" => 925,
		// "SYNTH FAIL RATE SMITH" => 926,
		// "SYNTH FAIL RATE GOLDSMITH" => 927,
		// "SYNTH FAIL RATE CLOTH" => 928,
		// "SYNTH FAIL RATE LEATHER" => 929,
		// "SYNTH FAIL RATE BONE" => 930,
		// "SYNTH FAIL RATE ALCHEMY" => 931,
		// "SYNTH FAIL RATE COOK" => 932,
		"WEAPONSKILL DAMAGE BASE" => 570,
		"ALL WSDMG ALL HITS" => 840,
		"ALL WSDMG FIRST HIT" => 841,
		// "WS NO DEPLETE" => 949,
		// "WS STR BONUS" => 980,
		// "WS DEX BONUS" => 957,
		// "WS VIT BONUS" => 981,
		// "WS AGI BONUS" => 982,
		// "WS INT BONUS" => 983,
		// "WS MND BONUS" => 984,
		// "WS CHR BONUS" => 985,
		// "EXPERIENCE RETAINED" => 914,
		// "CAPACITY BONUS" => 915,
		// "CONQUEST BONUS" => 933,
		// "CONQUEST REGION BONUS" => 934,
		// "CAMPAIGN BONUS" => 935,
		"SUBTLE BLOW II" => 993,
		// "GARDENING WILT BONUS" => 995,
		"SUPER JUMP" => 988,
		// "SPDEF DOWN" => 958,
		// "SUSC TO WS STUN" => 1176,
		// "ENHANCES COVER" => 1178,
		// "AUGMENTS COVER" => 1179,
		// "COVERED MP FLAG" => 1180,
		// "RAMPART STONESKIN" => 1181,
		"TAME SUCCESS RATE" => 1182,
		// "MAGIC STACKING MDT" => 1183,
		// "FIRE BURDEN DECAY" => 1184,
		// "BURDEN DECAY IGNORE CHANCE" => 1185,
		// "FIRE BURDEN PERC EXTRA" => 1186,
		// "SUPER INTIMIDATION" => 1187,
		// "PENGUIN RING EFFECT" => 1000,
		// "ALBATROSS RING EFFECT" => 1001,
		// "PELICAN RING EFFECT" => 1002,
		"VERMIN CIRCLE" => 1224,
		"BIRD CIRCLE" => 1225,
		"AMORPH CIRCLE" => 1226,
		"LIZARD CIRCLE" => 1227,
		"AQUAN CIRCLE" => 1228,
		"PLANTOID CIRCLE" => 1229,
		"BEAST CIRCLE" => 1230,
		"UNDEAD CIRCLE" => 1231,
		"ARCANA CIRCLE" => 1232,
		"DRAGON CIRCLE" => 1233,
		"DEMON CIRCLE" => 1234,
		"EMPTY CIRCLE" => 1235,
		"HUMANOID CIRCLE" => 1236,
		"LUMORIAN CIRCLE" => 1237,
		"LUMINION CIRCLE" => 1238,
	);

	$mod_id_array = array(
		"NONE" => 0,
		"--General Stats" => "General Stats",
			"HP" => 2,
			"HP %" => 3,
			"CONVERT MP TO HP" => 4,
			"+HP HEAL" => 72,
			"MP" => 5,
			"MP %" => 6,
			"CONVERT HP TO MP" => 7,
			"+MP HEAL" => 71,
			"STR" => 8,
			"DEX" => 9,
			"VIT" => 10,
			"AGI" => 11,
			"INT" => 12,
			"MND" => 13,
			"CHR" => 14,
			"ACC" => 25,
		"--Offensive Stats" => "Offensive Stats",
			"ATTACK" => 23,
			"ATTACK %" => 62,
			"RANGED ACC" => 26,
			"RANGED ATTACK" => 24,
			"RANGED ATTACK %" => 66,
			"MAGIC ATTACK" => 28,
			"MAGIC ACC" => 30,
			"MAG BURST BONUS" => 487,
		"--Defensive Stats" => "Defensive Stats",
			"DEF" => 1,
			"MAGIC DEF" => 29,
			"DEF %" => 63,
			"EVA" => 68,
			"MAGIC EVA" => 31,
			"ENMITY" => 27,
			"FIRE RESISTANCE" => 54,
			"ICE RESISTANCE" => 55,
			"WIND RESISTANCE" => 56,
			"EARTH RESISTANCE" => 57,
			"THUNDER RESISTANCE" => 58,
			"WATER RESISTANCE" => 59,
			"LIGHT RESISTANCE" => 60,
			"DARK RESISTANCE" => 61,
		"--Misc" => "Misc",
			"HASTE GEAR" => 384,
			"CRIT HIT RATE" => 165,
			"STORE TP" => 73,
			"SPELL INTERRUPT" => 168,
			"MOVE SPEED" => 169,
			"FAST CAST" => 170,
			"CURE CAST TIME" => 519,
			"MAGIC DAMAGE" => 311,
			"REFRESH" => 369,
			"REGEN" => 370,
			"CURE POTENCY" => 374,
		"--Combat Skills" => "Combat Skills",
			"H2H" => 80,
			"DAGGER" => 81,
			"SWORD" => 82,
			"GREAT SWORD" => 83,
			"AXE" => 84,
			"GREAT AXE" => 85,
			"SCYTHE" => 86,
			"POLEARM" => 87,
			"KATANA" => 88,
			"GKATANA" => 89,
			"CLUB" => 90,
			"STAFF" => 91,
			"ARCHERY" => 104,
			"MARKSMAN" => 105,
			"THROW" => 106,
			"GUARD" => 107,
			"EVASION" => 108,
			"SHIELD" => 109,
			"PARRY" => 110,
		"--Magic Skills" => "Magic Skills",
			"DIVINE" => 111,
			"HEALING" => 112,
			"ENHANCE" => 113,
			"ENFEEBLE" => 114,
			"ELEM" => 115,
			"DARK" => 116,
			"SUMMONING" => 117,
			"NINJUTSU" => 118,
			"SINGING" => 119,
			"STRING" => 120,
			"WIND" => 121,
			"BLUE" => 122,
		"--Killer-Effects" => "Killer-Effects",
			"VERMIN KILLER" => 224,
			"BIRD KILLER" => 225,
			"AMORPH KILLER" => 226,
			"LIZARD KILLER" => 227,
			"AQUAN KILLER" => 228,
			"PLANTOID KILLER" => 229,
			"BEAST KILLER" => 230,
			"UNDEAD KILLER" => 231,
			"ARCANA KILLER" => 232,
			"DRAGON KILLER" => 233,
			"DEMON KILLER" => 234,
			"EMPTY KILLER" => 235,
			"HUMANOID KILLER" => 236,
			"LUMORIAN KILLER" => 237,
			"LUMINION KILLER" => 238,
			"--Warrior" => 99999999,
			"DOUBLE ATTACK" => 288,
			"WARCRY DURATION" => 483,
			"BERSERK EFFECT" => 948,
			"BERSERK DURATION" => 954,
			"AGGRESSOR DURATION" => 955,
			"DEFENDER DURATION" => 956,
		"--Monk" => "Monk",
			"BOOST EFFECT" => 97,
			"CHAKRA MULT" => 123,
			"CHAKRA REMOVAL" => 124,
			"SUBTLE BLOW" => 289,
			"COUNTER" => 291,
			"KICK ATTACK RATE" => 292,
			"PERFECT COUNTER ATT" => 428,
			"FOOTWORK ATT BONUS" => 429,
			"COUNTERSTANCE EFFECT" => 543,
			"DODGE EFFECT" => 552,
			"FOCUS EFFECT" => 561,
		"--White Mage" => "White Mage",
			"AFFLATUS SOLACE" => 293,
			"AFFLATUS MISERY" => 294,
			"AUSPICE EFFECT" => 484,
			"AOE NA" => 524,
			"REGEN MULTIPLIER" => 838,
			"CURE2MP PERCENT" => 860,
			"DIVINE BENISON" => 910,
		"--Black Mage" => "Black Mage",
			"CLEAR MIND" => 295,
			"CONSERVE MP" => 296,
		"--RedMage" => "RedMage",
			"BLINK" => 299,
			"STONESKIN" => 300,
			"PHALANX" => 301,
			"ENF MAG POTENCY" => 290,
			"ENHANCES SABOTEUR" => 297,
		"--Thief" => "Thief",
			"FLEE DURATION" => 93,
			"STEAL" => 298,
			"DESPOIL" => 896,
			"PERFECT DODGE" => 883,
			"TRIPLE ATTACK" => 302,
			"TREASURE HUNTER" => 303,
			"SNEAK ATK DEX" => 959,
			"TRICK ATK AGI" => 520,
			"MUG EFFECT" => 835,
			"ACC COLLAB EFFECT" => 884,
			"HIDE DURATION" => 885,
			"GILFINDER" => 897,
		"--Paladin" => "Paladin",
			"HOLY CIRCLE DURATION" => 857,
			"RAMPART DURATION" => 92,
			"ABSORB PHYSDMG TO MP" => 426,
			"SHIELD MASTERY TP" => 485,
			"SENTINEL EFFECT" => 837,
			"SHIELD DEF BONUS" => 905,
			"COVER TO MP" => 965,
			"COVER MAGIC AND RANGED" => 966,
			"COVER DURATION" => 967,
		"--Dark Knight" => "Dark Knight",
			"ARCANE CIRCLE DURATION" => 858,
			"SOULEATER EFFECT" => 96,
			"DESPERATE BLOWS" => 906,
			"STALWART SOUL" => 907,
		"--Beastmaster" => "Beastmaster",
			"TAME" => 304,
			"CHARM TIME" => 360,
			"REWARD HP BONUS" => 364,
			"CHARM CHANCE" => 391,
			"FERAL HOWL DURATION" => 503,
			"JUG LEVEL RANGE" => 564,
			"CALL BEAST DELAY" => 572,
		"--Bard" => "Bard",
			"MINNE EFFECT" => 433,
			"MINUET EFFECT" => 434,
			"PAEON EFFECT" => 435,
			"REQUIEM EFFECT" => 436,
			"THRENODY EFFECT" => 437,
			"MADRIGAL EFFECT" => 438,
			"MAMBO EFFECT" => 439,
			"LULLABY EFFECT" => 440,
			"ETUDE EFFECT" => 441,
			"BALLAD EFFECT" => 442,
			"MARCH EFFECT" => 443,
			"FINALE EFFECT" => 444,
			"CAROL EFFECT" => 445,
			"MAZURKA EFFECT" => 446,
			"ELEGY EFFECT" => 447,
			"PRELUDE EFFECT" => 448,
			"HYMNUS EFFECT" => 449,
			"VIRELAI EFFECT" => 450,
			"SCHERZO EFFECT" => 451,
			"ALL SONGS EFFECT" => 452,
			"MAXIMUM SONGS BONUS" => 453,
			"SONG DURATION BONUS" => 454,
			"SONG SPELLCASTING TIME REDUCTION" => 455,
			"SONG RECAST DELAY" => 833,
		"--Ranger" => "Ranger",
			"CAMOUFLAGE DURATION" => 98,
			"RECYCLE" => 305,
			"SNAP SHOT" => 365,
			"RAPID SHOT" => 359,
			"WIDESCAN" => 340,
			"BARRAGE ACC" => 420,
			"DOUBLE SHOT RATE" => 422,
			"VELOCITY SNAPSHOT BONUS" => 423,
			"VELOCITY RATT BONUS" => 424,
			"SHADOW BIND EXT" => 425,
			"SCAVENGE EFFECT" => 312,
			"SHARPSHOT" => 314,
		"--Samurai" => "Samurai",
			"WARDING CIRCLE DURATION" => 95,
			"MEDITATE DURATION" => 94,
			"ZANSHIN" => 306,
			"THIRD EYE COUNTER RATE" => 508,
			"THIRD EYE ANTICIPATE RATE" => 839,
		"--Ninja" => "Ninja",
			"UTSUSEMI" => 307,
			"UTSUSEMI BONUS" => 900,
			"NINJA TOOL" => 308,
			"NIN NUKE BONUS" => 522,
			"DAKEN" => 911,
		"--Dragoon" => "Dragoon",
			"ANCIENT CIRCLE DURATION" => 859,
			"JUMP TP BONUS" => 361,
			"JUMP ATT BONUS" => 362,
			"HIGH JUMP ENMITY REDUCTION" => 363,
			"FORCE JUMP CRIT" => 828,
			"WYVERN EFFECTIVE BREATH" => 829,
			"WYVERN SUBJOB TRAITS" => 974,
		"--Summoner" => "Summoner",
			"AVATAR PERPETUATION" => 371,
			"WEATHER REDUCTION" => 372,
			"DAY REDUCTION" => 373,
			"PERPETUATION REDUCTION" => 346,
			"BP DELAY" => 357,
			"ENHANCES ELEMENTAL SIPHON" => 540,
			"BP DELAY II" => 541,
			"BP DAMAGE" => 126,
			"BLOOD BOON" => 913,
			"SPIRIT RECAST REDUCTION" => 960,
		"--Blue Mage" => "Blue Mage",
			"BLUE POINTS" => 309,
			"BLUE LEARN CHANCE" => 945,
			"MONSTER CORRELATION BONUS" => 936,
		"--Corsair" => "Corsair",
			"EXP BONUS" => 382,
			"ROLL RANGE" => 528,
			"JOB BONUS CHANCE" => 542,
			"QUICK DRAW DELAY" => 571,
			"RANDOM DEAL BONUS" => 573,
			"QUICK DRAW DMG" => 411,
			"QUICK DRAW DMG PERCENT" => 834,
			"QUICK DRAW MACC" => 191,
			"PHANTOM ROLL" => 881,
			"PHANTOM DURATION" => 882,
		"--Puppetmaster" => "Puppetmaster",
			"MANEUVER BONUS" => 504,
			"OVERLOAD THRESH" => 505,
			"AUTO DECISION DELAY" => 842,
			"AUTO SHIELD BASH DELAY" => 843,
			"AUTO MAGIC DELAY" => 844,
			"AUTO HEALING DELAY" => 845,
			"AUTO HEALING THRESHOLD" => 846,
			"BURDEN DECAY" => 847,
			"AUTO SHIELD BASH SLOW" => 848,
			"AUTO TP EFFICIENCY" => 849,
			"AUTO SCAN RESISTS" => 850,
			"REPAIR EFFECT" => 853,
			"REPAIR POTENCY" => 854,
			"PREVENT OVERLOAD" => 855,
			"SUPPRESS OVERLOAD" => 125,
			"AUTO STEAM JACKET" => 938,
			"AUTO STEAM JACKED REDUCTION" => 939,
			"AUTO SCHURZEN" => 940,
			"AUTO EQUALIZER" => 941,
			"AUTO PERFORMANCE BOOST" => 942,
			"AUTO ANALYZER" => 943,
		"--Dancer" => "Dancer",
			"FINISHING MOVES" => 333,
			"SAMBA DURATION" => 490,
			"WALTZ POTENTCY" => 491,
			"CHOCOBO JIG DURATION" => 492,
			"VFLOURISH MACC" => 493,
			"STEP FINISH" => 494,
			"STEP ACCURACY" => 403,
			"WALTZ DELAY" => 497,
			"SAMBA PDURATION" => 498,
			"SPECTRAL JIG DURATION" => 502,
			"REVERSE FLOURISH EFFECT" => 836,
		"--Scholar" => "Scholar",
			"BLACK MAGIC COST" => 393,
			"WHITE MAGIC COST" => 394,
			"BLACK MAGIC CAST" => 395,
			"WHITE MAGIC CAST" => 396,
			"BLACK MAGIC RECAST" => 397,
			"WHITE MAGIC RECAST" => 398,
			"ALACRITY CELERITY EFFECT" => 399,
			"LIGHT ARTS EFFECT" => 334,
			"DARK ARTS EFFECT" => 335,
			"LIGHT ARTS SKILL" => 336,
			"DARK ARTS SKILL" => 337,
			"LIGHT ARTS REGEN" => 338,
			"REGEN DURATION" => 339,
			"HELIX EFFECT" => 478,
			"HELIX DURATION" => 477,
			"STORMSURGE EFFECT" => 400,
			"SUBLIMATION BONUS" => 401,
			"GRIMOIRE SPELLCASTING" => 489
	);

	$jobs = array(
		"WAR" => 1,
		"MNK" => 2,
		"WHM" => 3,
		"BLM" => 4,
		"RDM" => 5,
		"THF" => 6,
		"PLD" => 7,
		"DRK" => 8,
		"BST" => 9,
		"BRD" => 10,
		"RNG" => 11,
		"SAM" => 12,
		"NIN" => 13,
		"DRG" => 14,
		"SMN" => 15,
		"BLU" => 16,
		"COR" => 17,
		"PUP" => 18,
		"DNC" => 19,
		"SCH" => 20,
		// "GEO" => 21,
		// "RUN" => 22,
	);

	$equipment_slot_id = array(
		// "MAIN  " => 1,
		// "SUB   " => 2,
		// "RANGED" => 4,
		"AMMO  " => 8,
		"HEAD  " => 16,
		"BODY  " => 32,
		"HANDS " => 64,
		"LEGS  " => 128,
		"FEET  " => 256,
		"NECK  " => 512,
		"WAIST " => 1024,
		"EARRING  " => 6144,
		"RING " => 24576,
		"BACK  " => 32768,
	);

	function build_select( $values, $name ) {
		if ( !is_array($values) ) {
			return;
		}
		$output = '<div class="input_contaienr">';
			$output .= '<label>' . ucwords($name) . '</label>';
			$output .= '<select name="'.$name.'_select" id="'.$name.'_select">';
			foreach ($values as $key => $value) {
				$output .= '<option value="'.$value.'">'.$key.'</option>';
			}
			$output .= '</select>';
		$output .= '</div>';

		return $output;
	}

	function get_gear( $slot, $job, $mod, $latent ) {
		$mysqli = new mysqli("localhost","website","5?i}d#nN.G5-","wings");

		if ( $latent == 1 ) {
			$query = "SELECT 
							equipment.name,
							equipment.itemId,
							equipment.level AS level,
							SUBSTR(REVERSE(BIN(equipment.jobs)), ".$job.", 1) AS jobresult,
							equipment.slot,
							equipment.race,
							mods.modId,
							mods.value AS mod_value,
							latents.modId,
							latents.value AS latent_value
							FROM item_equipment AS equipment
							LEFT JOIN item_mods AS mods ON equipment.itemId = mods.itemId
							LEFT JOIN item_latents AS latents ON equipment.itemId = latents.itemId
						WHERE 
							level <= 75 AND 
							race = 255 AND
							(mods.modId = " . $mod. " OR latents.modId = " . $mod. ") AND
							slot = " . $slot . "
						GROUP BY
							equipment.name
						HAVING
							jobresult = 1
						ORDER BY
							mod_value DESC, latent_value DESC, level DESC, equipment.name
						LIMIT 0, 10";
		} else {
			$query = "SELECT 
							equipment.name,
							equipment.itemId,
							equipment.level AS level,
							SUBSTR(REVERSE(BIN(equipment.jobs)), ".$job.", 1) AS jobresult,
							equipment.slot,
							equipment.race,
							mods.itemId,
							mods.modId,
							mods.value AS mod_value
							FROM item_equipment AS equipment
							LEFT JOIN item_mods AS mods ON equipment.itemId = mods.itemId
						WHERE 
							level <= 75 AND 
							race = 255 AND
							mods.modId = " . $mod. " AND
							slot = " . $slot . "
						GROUP BY
							equipment.name
						HAVING
							jobresult = 1
						ORDER BY
							mod_value DESC, level DESC, equipment.name
						LIMIT 0, 10";
		}
	
		// echo $query;
		// echo "<br><br>";
		
		if ($result = $mysqli -> query( $query )) {
			$output = '';
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					// echo "<pre>";
					// 	print_r($row);
					// echo "</pre>";
					// Split the item name into words and capitalize them
					$item_name 			= ucwords(str_replace( "_", " ", $row['name'] ));
					$item_name_array 	= explode( ' ', $item_name );

					if ( substr($item_name_array[0], -1 ) == 's' ) {
						$item_name_array[0] = substr_replace($item_name_array[0], "'s", -1);
					}
					$item_name = implode( '_', $item_name_array );

					$output .=  "<p style='margin: 0 0 5px 0;'>";
						$output .=  "<img data-id='".$row['itemId']."' class='icon' src='https://static.ffxiah.com/images/icon/".$row['itemId'].".png' />";
							$output .=  "<a target='_blank' href='https://ffxiclopedia.fandom.com/wiki/".urlencode($item_name)."'>";
							$output .=  get_item_name( $row['itemId'] );
						$output .=  "</a>";
					$output .=  "</p>";
				}
			}
		}
	
		return $output;
	}
	
	function get_gear_popup( $item_id ) {
		$source_url = 'https://api.ffxiah.com/tt/?v=3&game=ffxi&lang=en&type=item&id='.$item_id;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $source_url);
		$result = curl_exec($ch);
		curl_close($ch);

		$result = str_replace( '\\n', '', $result );
		$result = str_replace( '\\', '', $result );
		$result = str_replace( '";', '', $result );
	
		$start  = strpos( $result, '"' ) + 1;
	
		$result = substr( $result, $start );

		echo $result;
	}

	function get_last_startup() {
		global $mysqli;

		$query = "SHOW GLOBAL STATUS LIKE 'Uptime';";
		$output = '<span>Tables Last Updated: ';
		if ($result = $mysqli -> query( $query )) {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$output .= round( $row['Value'] / 60 / 60 / 24, 0);
				}
			} else {
				$output .= 'NULL';
			}
		}

		$output .= " days ago</span>";

		return $output;
	}

?>