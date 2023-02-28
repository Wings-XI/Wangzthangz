import re
import os
from pathlib import Path

tpz_zone = {
    0: "rank_2_mission",
    1: "tails_of_woe",
    2: "dismemberment_brigade",
    3: "the_secret_weapon",
    4: "hostile_herbivores",
    5: "shattering_stars",
    6: "shattering_stars",
    7: "shattering_stars",
    8: "carapace_combatants",
    9: "shooting_fish",
    10: "dropping_like_flies",
    11: "horns_of_war",
    12: "under_observation",
    13: "eye_of_the_tiger",
    14: "shots_in_the_dark",
    15: "double_dragonian",
    16: "todays_horoscope",
    17: "contaminated_colosseum",
    18: "kindergarten_cap",
    19: "last_orc-shunned_hero",
    20: "beyond_infinity",
    32: "save_the_children",
    33: "holy_crest",
    34: "wings_of_fury",
    35: "petrifying_pair",
    36: "toadal_recall",
    37: "mirror_mirror",
    64: "rank_2_mission",
    65: "worms_turn",
    66: "grimshell_shocktroopers",
    67: "on_my_way",
    68: "thief_in_norg",
    69: "3_2_1",
    70: "shattering_stars",
    71: "shattering_stars",
    72: "shattering_stars",
    73: "birds_of_a_feather",
    74: "crustacean_conundrum",
    75: "grove_guardians",
    76: "hills_are_alive",
    77: "royal_jelly",
    78: "final_bout",
    79: "up_in_arms",
    80: "copycat",
    81: "operation_desert_swarm",
    82: "prehistoric_pigeons",
    83: "palborough_project",
    84: "shell_shocked",
    85: "beyond_infinity",
    96: "rank_2_mission",
    97: "steamed_sprouts",
    98: "divine_punishers",
    99: "saintly_invitation",
    100: "treasure_and_tribulations",
    101: "shattering_stars",
    102: "shattering_stars",
    103: "shattering_stars",
    104: "creeping_doom",
    105: "charming_trio",
    106: "harem_scarem",
    107: "early_bird_catches_the_wyrm",
    108: "royal_succession",
    109: "rapid_raptors",
    110: "wild_wild_whiskers",
    111: "seasons_greetings",
    112: "royale_ramble",
    113: "moa_constrictors",
    114: "v_formation",
    115: "avian_apostates",
    116: "beyond_infinity",
    128: "temple_of_uggalepih",
    129: "jungle_boogymen",
    130: "amphibian_assault",
    131: "project_shantottofication",
    132: "whom_wilt_thou_call",
    160: "shadow_lord_battle",
    161: "where_two_paths_converge",
    162: "kindred_spirits",
    163: "survival_of_the_wisest",
    164: "smash_a_malevolent_menace",
    192: "through_the_quicksand_caves",
    193: "legion_xi_comitatensis",
    194: "shattering_stars",
    195: "shattering_stars",
    196: "shattering_stars",
    197: "cactuar_suave",
    198: "eye_of_the_storm",
    199: "scarlet_king",
    200: "cat_burglar_bares_fangs",
    201: "dragon_scales",
    224: "moonlit_path",
    225: "moon_reading",
    226: "waking_the_beast_fullmoon",
    227: "battaru_royale",
    256: "return_to_delkfutts_tower",
    257: "indomitable_triumvirate_vs3",
    258: "dauntless_duo_vs2",
    259: "solitary_demolisher_vs1",
    260: "heroines_combat",
    261: "mercenary_camp",
    262: "ode_of_life_bestowing",
    288: "ark_angels_1",
    289: "ark_angels_2",
    290: "ark_angels_3",
    291: "ark_angels_4",
    292: "ark_angels_5",
    293: "divine_might",
    320: "celestial_nexus",
    352: "fiat_lux",
    353: "darkness_descends",
    354: "bonds_of_mythril",
    385: "maiden_of_the_dusk",
    416: "trial_by_wind",
    417: "carbuncle_debacle",
    418: "trial-size_trial_by_wind",
    419: "waking_the_beast",
    420: "sugar-coated_directive",
    448: "trial_by_lightning",
    449: "carbuncle_debacle",
    450: "trial-size_trial_by_lightning",
    451: "waking_the_beast",
    452: "sugar-coated_directive",
    480: "trial_by_ice",
    481: "class_reunion",
    482: "trial-size_trial_by_ice",
    483: "waking_the_beast",
    484: "sugar-coated_directive",
    512: "rank_5_mission",
    513: "come_into_my_parlor",
    514: "e-vase-ive_action",
    515: "infernal_swarm",
    516: "heir_to_the_light",
    517: "shattering_stars",
    518: "shattering_stars",
    519: "shattering_stars",
    520: "demolition_squad",
    521: "die_by_the_sword",
    522: "let_sleeping_dogs_die",
    523: "brothers_d_aurphe",
    524: "undying_promise",
    525: "factory_rejects",
    526: "idol_thoughts",
    527: "awful_autopsy",
    528: "celery",
    529: "mirror_images",
    530: "furious_finale",
    531: "clash_of_the_comrades",
    532: "those_who_lurk_in_shadows",
    533: "beyond_infinity",
    544: "trial_by_fire",
    545: "trial-size_trial_by_fire",
    546: "waking_the_beast",
    547: "sugar-coated_directive",
    576: "trial_by_earth",
    577: "puppet_master",
    578: "trial-size_trial_by_earth",
    579: "waking_the_beast",
    580: "sugar-coated_directive",
    608: "trial_by_water",
    609: "trial-size_trial_by_water",
    610: "waking_the_beast",
    611: "sugar-coated_directive",
    640: "flames_for_the_dead",
    641: "follow_the_white_rabbit",
    642: "when_hell_freezes_over",
    643: "brothers",
    644: "holy_cow",
    672: "head_wind",
    673: "like_the_wind",
    674: "sheep_in_antlions_clothing",
    675: "shell_we_dance",
    676: "totentanz",
    677: "tango_with_a_tracker",
    678: "requiem_of_a_sin",
    679: "antagonistic_ambuscade",
    704: "darkness_named",
    705: "test_your_mite",
    706: "waking_dreams",
    736: "century_of_hardship",
    737: "return_to_the_depths",
    738: "bionic_bug",
    739: "pulling_the_strings",
    740: "automaton_assault",
    741: "mobline_comedy",
    768: "ancient_flames_beckon",
    769: "simulant",
    770: "empty_hopes",
    800: "ancient_flames_beckon",
    801: "you_are_what_you_eat",
    802: "empty_dreams",
    832: "ancient_flames_beckon",
    833: "playing_host",
    834: "empty_desires",
    864: "desires_of_emptiness",
    865: "pulling_the_plug",
    866: "empty_aspirations",
    896: "storms_of_fate",
    897: "wyrmking_descends",
    928: "ouryu_cometh",
    960: "ancient_vows",
    961: "savage",
    962: "fire_in_the_sky",
    963: "bad_seed",
    964: "bugard_in_the_clouds",
    965: "beloved_of_the_atlantes",
    966: "uninvited_guests",
    967: "nest_of_nightmares",
    992: "one_to_be_feared",
    993: "warriors_path",
    1024: "when_angels_fall",
    1056: "dawn",
    1057: "apocalypse_nigh",
    1088: "call_to_arms",
    1089: "compliments_to_the_chef",
    1090: "puppetmaster_blues",
    1091: "breaking_the_bonds_of_fate",
    1092: "legacy_of_the_lost",
    1120: "tough_nut_to_crack",
    1121: "happy_caster",
    1122: "omens",
    1123: "achieving_true_power",
    1124: "shield_of_diplomacy",
    1152: "making_a_mockery",
    1153: "shadows_of_the_mind",
    1154: "beast_within",
    1155: "moment_of_truth",
    1156: "puppet_in_peril",
    1184: "rider_cometh",
    1290: "nw_apollyon",
    1291: "sw_apollyon",
    1292: "ne_apollyon",
    1293: "se_apollyon",
    1294: "cs_apollyon",
    1295: "cs_apollyon_ii",
    1296: "central_apollyon",
    1297: "central_apollyon_ii",
    1298: "temenos_western_tower",
    1299: "temenos_northern_tower",
    1300: "temenos_eastern_tower",
    1301: "central_temenos_basement",
    1302: "central_temenos_basement_ii",
    1303: "central_temenos_1st_floor",
    1304: "central_temenos_2nd_floor",
    1305: "central_temenos_3rd_floor",
    1306: "central_temenos_4th_floor",
    1307: "central_temenos_4th_floor_ii",
}

zone_ids = dict(zip(tpz_zone.values(), tpz_zone.keys()))

re_require = re.compile('^(require).*', re.I)
re_comment = re.compile('.*--.*')
re_commentline = re.compile('^--.*')
re_commentblock = re.compile('^--\[\[')
re_commentblockend = re.compile('(--]]|]]--|^]])')
re_addparens = re.compile('^[\S]*')
re_localvar = re.compile('local ([\w\.]+)')
re_globalvar = re.compile('^[\w\.]+')
re_arrayvar = re.compile('([\w\.]+)\s+=')
re_arrayvar_value = re.compile('=\s+([\w\.]+)')
re_brkarrayvar = re.compile('(\[[\S]+\])\s+=')
re_merge = re.compile('\s*\),\s*array\(\n')

acceptable_filename = re.compile('.+(.lua)$')

def convert(filename: str, keep_comments=True, merge_arrays=False, replace_ids=True):
    directory = 'C:/Wings-Flibe/wangzthangz/tools/' # Change this to where tool resides

    fp = directory + filename
    
    if not Path(fp).exists() or not acceptable_filename.match(filename):
        print('Invalid filename')
        return
    
    with open(fp, 'r') as f:
        src = f.readlines()
      
    for i, line in enumerate(src):
        # Remove requires
        if re_require.match(line):
            src[i] = None
            continue

        # Convert comments, remove if asked to
        if re_commentblock.match(line):
            src[i] = line.replace('--[[', '/* ', 1) if keep_comments else None
            continue
        elif re_commentblockend.match(line):
            src[i] = line.replace(']]' , '*/', 1) if keep_comments else None
            continue
        elif re_commentline.match(line):
            src[i] = "# " + src[i] if keep_comments else None
            continue
        
        temp = line
        localvar = re_localvar.findall(temp)
        globalvar = re_globalvar.findall(temp)
        arrayvar = re_arrayvar.findall(temp)
        arrayvar_value = re_arrayvar_value.findall(temp)
        brkarrayvar = re_brkarrayvar.findall(temp)

         # Replace simple items
        temp = temp.replace('{', 'array(')
        temp = temp.replace('}', ')')
        temp = temp.replace('--', '#', 1)

        # Replace less simple items
        if localvar:
            temp = temp.replace(f'local {localvar[0]}', f'${localvar[0]}')
        elif globalvar:
            globalvar_item = globalvar[0].replace('.', '_')
            temp = temp.replace(globalvar[0], f'${globalvar_item}')
        elif arrayvar:
            
            temp = temp.replace('=', '=>')
            for array_item in arrayvar:
                arrayvar_item = array_item.replace('.', '_')
                temp = temp.replace(array_item, f'"{arrayvar_item}"', 1)
                
                if len(arrayvar_value) > 0:
                    for value_item in arrayvar_value:
                        if not value_item.isdigit():
                            arrayvar_value_item = value_item.replace('.', '_')
                            temp = temp.replace(value_item, f'"{arrayvar_value_item}"', 1)


        if brkarrayvar:
            item = brkarrayvar[0]
            item = item.replace('[', '')
            item = item.replace(']', '')
            if item.isdigit() and replace_ids:
                bcnm_name = tpz_zone[int(item)]
                item = f"$bcnms_master_table['{bcnm_name}']"
                temp = temp.replace(brkarrayvar[0], f'{item}')
            else:
                item = item.replace('.', '_')
                temp = temp.replace(brkarrayvar[0], f'"{item}"')
                
        src[i] = temp
    # ----------------

    while None in src:
        src.remove(None)
    
    base = os.path.splitext(filename)[0]

    with open(f'{directory}output_{base}.php', 'w') as w:
        for line in src:
            w.write(line)
            
    if merge_arrays:
        with open(f'{directory}output_{base}.php', 'r') as f:
            text = f.read()
            matched = re_merge.findall(text)
            if matched:
                text = text.replace(matched[0], '\n')
        with open(f'{directory}output_{base}.php', 'w') as w:
            w.write(text)

def main():
    # file = 'treasure.lua'
    file = input('Name of file to convert: ')
    comments = input('Keep comments?[y/n]: ').upper()
    keep_comments = not (comments in ['N', 'NO', 'NARP', 'NOPE', 'HELL NAW', 0])

    convert(file, keep_comments)

if __name__ == '__main__':
    main()

