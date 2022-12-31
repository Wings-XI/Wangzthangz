<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://benalman.com/code/projects/jquery-throttle-debounce/jquery.ba-throttle-debounce.js"></script>
<?php
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
    );

    $equipment_slot_id = array(
        // "MAIN  " => 1,
        // "SUB   " => 2,
        // "RANGED" => 4,
        "AMMO" => 8,
        "HEAD" => 16,
        "BODY" => 32,
        "HANDS" => 64,
        "LEGS" => 128,
        "FEET" => 256,
        "NECK" => 512,
        "WAIST" => 1024,
        "EARRING" => 6144,
        "RING" => 24576,
        "BACK" => 32768,
    );

    $races =array(
        "HUME M" => 1,
        "HUME F" => 2,
        "ELVAAN M" => 3,
        "ELVAAN F" => 4,
        "TARU M" => 5,
        "TARU F" => 6,
        "MITHRA" => 7,
        "GALKA" => 8,
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
			"HASTE" => 384,
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
			"NINJA TOOL EXPERTISE" => 308,
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

    $latent = array(
         0 => "HP UNDER PERCENT",
         1 => "HP OVER PERCENT",
         2 => "HP UNDER TP UNDER 100",
         3 => "HP OVER TP UNDER 100",
         4 => "MP UNDER PERCENT",
         5 => "MP UNDER",
         6 => "TP UNDER",
         7 => "TP OVER",
         8 => "SUBJOB",
         9 => "PET ID",
         10 => "WEAPON DRAWN",
         11 => "WEAPON SHEATHED",
         12 => "SIGNET BONUS",
         13 => "STATUS EFFECT ACTIVE",
         14 => "NO FOOD ACTIVE",
         15 => "PARTY MEMBERS",
         16 => "PARTY MEMBERS IN ZONE",
         17 => "SANCTION REGEN BONUS",
         18 => "SANCTION REFRESH BONUS",
         19 => "SIGIL REGEN BONUS",
         20 => "SIGIL REFRESH BONUS",
         21 => "AVATAR IN PARTY",
         22 => "JOB IN PARTY",
         23 => "ZONE",
         24 => "SYNTH TRAINEE",
         25 => "SONG ROLL ACTIVE",
         26 => array(
                "TIME OF DAY",
                "IS DAYTIME",
                "IS NIGHTTIME",
                "IS DUSK-DAWN"
            ),
         27 => "HOUR OF DAY",
         28 => "FIRESDAY",
         29 => "EARTHSDAY",
         30 => "WATERSDAY",
         31 => "WINDSDAY",
         32 => "DARKSDAY",
         34 => "ICEDAY",
         35 => "LIGHTNINGSDAY",
         36 => "LIGHTSDAY",
         37 => "MOON PHASE",
         38 => "JOB MULTIPLE",
         39 => "JOB MULTIPLE AT NIGHT",
         43 => "WEAPON DRAWN HP UNDER",
         44 => "HOME NATION",
         45 => "MP UNDER VISIBLE GEAR",
         46 => "HP OVER VISIBLE GEAR",
         47 => "WEAPON BROKEN",
         48 => "IN DYNAMIS",
         49 => "FOOD ACTIVE",
         50 => "JOB LEVEL BELOW",
         51 => "JOB LEVEL ABOVE",
         52 => "WEATHER ELEMENT",
         53 => "NATION CONTROL",
         54 => "ZONE HOME NATION",
         55 => "MP OVER",
         56 => "WEAPON DRAWN MP OVER",
         57 => "ELEVEN ROLL ACTIVE",
         58 => "IN ASSAULT",
         59 => "VS ECOSYSTEM",
         60 => "VS FAMILY",
    );

    $mysqli = new mysqli("localhost","website","5?i}d#nN.G5-","wings");
    $query = "SELECT *  FROM item_equipment AS equip WHERE equip.itemId = 15114";
    echo $query;
    if ($result = $mysqli -> query( $query )) {
        var_dump($result);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<pre>';
                    print_r($row);
                echo '</pre>';
                $item_name  = $row['name'];
                $item_level = $row['level'];
                $item_jobs  = str_split(strrev(decbin($row['jobs'])));
                $i = 1;
                foreach ($item_jobs as $key => $value) {
                    if ( $value == "1") {
                        $item_jobs_titles .= array_search( $i, $jobs ) . ' ';
                    }
                    $i++;
                }
                $item_slot  = array_search( $row['slot'], $equipment_slot_id );
                $item_race  = $row['race'];
                
                if ( $item_race == '255' ) {
                    $item_race_titles = 'ALL RACES';
                } else {
                    $item_race  = str_split(strrev(decbin($row['race'])));
                    $i = 1;
                    foreach ($item_race as $key => $value) {
                        if ( $value == "1") {
                            $item_race_titles .= array_search( $i, $races ) . ' ';
                        }
                        $i++;
                    }
                }

            }
        }
    }
    echo '<br><br>';
    $query = "SELECT * FROM item_mods AS mods WHERE mods.itemId = 15114";
    echo $query;
    if ($result = $mysqli -> query( $query )) {
        var_dump($result);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<pre>';
                    print_r($row);
                echo '</pre>';
                $item_mods = '';
                if ( $row['modId'] == 1 ) {
                    $item_def = $row['value'];
                } else {
                    $mod_name = array_search( $row['modId'], $mod_id_array );
                    $item_mods .= $mod_name . ' ' . $row['value'];
                }
            }
        }
    }
    echo '<br><br>';
    $query = "SELECT * FROM item_latents AS latents WHERE latents.itemId = 15114 ORDER BY modId";
    echo $query;
    if ($result = $mysqli -> query( $query )) {
        var_dump($result);
        if ($result->num_rows > 0) {
            if ( count($row) > 1) {
                $item_latents = "Latent Effects: ";
            } else {
                $item_latents = "Latent Effect: ";
            }
            $current_latent_id = 0;
            while($row = $result->fetch_assoc()) {
                if ( $row['latentId'] == $current_latent_id ) {
                    $mod_name       = array_search( $row['modId'], $mod_id_array );
                    $mod_value      = ( $row['value'] >= 100 ) ? $row['value'] / 100 : $row['value'];
                    $mod_value      = ( $mod_value < 0 ) ? $mod_value : " +" . $mod_value;
                    $item_latents  .= $mod_name . ' ' . $mod_value;
                } else {
                    $current_latent_id = $row['latentId'];

                    if ( is_array( $latent[$row['latentId']] ) ) {
                        $latent_param = $row['latentParam'] + 1;
                        $latent_name  = $latent[$row['latentId']][$latent_param];
                    } else {
                        $latent_name = $latent[$latent];
                    }

                    $mod_name       = array_search( $row['modId'], $mod_id_array );
                    $mod_value      = ( $row['value'] >= 100 ) ? $row['value'] / 100 : $row['value'];
                    $mod_value      = ( $mod_value < 0 ) ? $mod_value : " +" . $mod_value;
                    $item_latents  .= $latent_name . ' ' . $mod_name . ' ' . $mod_value . ' ';
                }
                echo '<pre>';
                    print_r($row);
                echo '</pre>';
            }
        }
    }
    $output .= '<div class="gear_popup">';
        $output .= "<p>" . $item_name . "</p>";
        $output .= "<p>[" . $item_slot . "] " . $item_race_titles . "</p>";
        $output .= "<p>DEF: " . $item_def  . " " . $item_mods . "</p>";
        $output .= "<p>" . $item_latents . "</p>";
        $output .= "<p>LV." . $item_level . ' ' . $item_jobs_titles . "</p>";
    $output .= '</div>';

    echo $output;
?>