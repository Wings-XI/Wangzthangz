jQuery(document).ready(function ( $) {
	$( '.gear_results' ).on( 'mouseenter', '.icon', $.debounce(1000, function(event) {
		event.preventDefault();

		var item_id 		= $(this).attr("data-id");
		var position 		= $(this).position();
		var position_left 	= position.left + 35;
		var position_top 	= position.top + 25;

		$('.gear_popup').css({"left": position_left, "top": position_top, "display": "block"});
		// $('.gear_popup').toggle();

		$(this).on('mouseout', function() {
			// $('.gear_popup').toggle();
			$('.gear_popup').css({"display": "none"});
			$('.gear_popup').html('<div class="loading-container"><img class="loading" src=\'./assets/loading.gif\' /></div>');
		});

		$.ajax(directory_root.concat('/inc/init.php'), {
			type: 'POST',
			data: { item_id: item_id, callback: 'get_gear_popup' },
			success: function (data,status,xhr) {
				$('.gear_popup').empty();
				$('.gear_popup').html(data);
			},
			error: function (jqXhr, textStatus, errorMessage) {
				console.log(errorMessage);
			}
		});
	}));

	$( '.gear_results' ).on( 'mouseout', function() {
		$('.gear_popup').css({"display": "none"});
		$('.gear_popup').html('<div class="loading-container"><img class="loading" src=\'./assets/loading.gif\' /></div>');
	});	
	
	$( '#gear_form .submit' ).on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('.gear_results').empty();

		var selected_job    = $('#jobs_select').val();
		var selected_slot   = $('#slot_select').val();
		var selected_mod    = $('#modifier_select').val();

		if(document.getElementById('latent').checked) {
			var latent_value = 1;
		} else {
			var latent_value = 0;
		}
		// var latent_value = 0;


		$.ajax(directory_root.concat('/inc/init.php'), {
			type: 'POST',  // http method
			data: { job: selected_job, slot: selected_slot, mod: selected_mod, latent: latent_value, callback: 'get_gear' },  // data to submit
			success: function (data,status,xhr) {   // success callback function
				$('.gear_results').html(data);
			},
			error: function (jqXhr, textStatus, errorMessage) { // error callback 
				$('.gear_results').append('Error: ' + errorMessage);
			}
		});
	});

	$( '#zone_select' ).on('change', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('.mob_data_container').empty();

		var selected_zone = $(this).val();
		var selected_th   = $('input[name=th]:checked').val();

		$.ajax(directory_root.concat('/inc/init.php'), {
			type: 'POST',  // http method
			data: { zone: selected_zone, th: selected_th, callback: 'get_zone_mobs' },  // data to submit
			success: function (data,status,xhr) {   // success callback function
				$('.mob_data_container').html(data);
			},
			error: function (jqXhr, textStatus, errorMessage) { // error callback 
				$('.mob_data_container').append('Error: ' + errorMessage);
			}
		});
	});

	$('input[type=radio][name=th]').change(function() {
		var selected_th 	= $(this).val();
		var selected_zone 	= $('#zone_select').val();

		$.ajax(directory_root.concat('/inc/init.php'), {
			type: 'POST',  // http method
			data: { zone: selected_zone, th: selected_th, callback: 'get_zone_mobs' },  // data to submit
			success: function (data,status,xhr) {   // success callback function
				$('.mob_data_container').html(data);
			},
			error: function (jqXhr, textStatus, errorMessage) { // error callback 
				$('.mob_data_container').append('Error: ' + errorMessage);
			}
		});
	});

	$( '#bcnm_select' ).on('change', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('.bcnm_data_container').empty();

		var selected_bcnm = $(this).val();

		$.ajax(directory_root.concat('/inc/init.php'), {
			type: 'POST',  // http method
			data: { bcnm: selected_bcnm, callback: 'get_bcnm_drops' },  // data to submit
			success: function (data,status,xhr) {   // success callback function
				$('.bcnm_data_container').html(data);
			},
			error: function (jqXhr, textStatus, errorMessage) { // error callback 
				$('.bcnm_data_container').append('Error: ' + errorMessage);
			}
		});
	});

	$( '#chest_coffer_select' ).on('change', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('.chest_coffer_data_container').empty();

		var selected_chest_coffer = $(this).val();

		$.ajax(directory_root.concat('/inc/init.php'), {
			type: 'POST',  // http method
			data: { chest_coffer: selected_chest_coffer, callback: 'get_chest_coffer_drops' },  // data to submit
			success: function (data,status,xhr) {   // success callback function
				$('.chest_coffer_data_container').html(data);
			},
			error: function (jqXhr, textStatus, errorMessage) { // error callback 
				$('.chest_coffer_data_container').append('Error: ' + errorMessage);
			}
		});
	});

	$( '#guild_select' ).on('change', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('.guild_data_container').empty();

		var selected_guild = $(this).val();

		$.ajax(directory_root.concat('/inc/init.php'), {
			type: 'POST',  // http method
			data: { guild: selected_guild, callback: 'get_guild_point_items' },  // data to submit
			success: function (data,status,xhr) {   // success callback function
				$('.guild_data_container').html(data);
			},
			error: function (jqXhr, textStatus, errorMessage) { // error callback 
				$('.guild_data_container').append('Error: ' + errorMessage);
			}
		});
	});

	$( '#cd_zone_select' ).on('change', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('.chocobo_digging_data_container').empty();

		var selected_cs_zone = $(this).val();

		$.ajax(directory_root.concat('/inc/init.php'), {
			type: 'POST',  // http method
			data: { cd_zone: selected_cs_zone, callback: 'get_chocobo_digging' },  // data to submit
			success: function (data,status,xhr) {   // success callback function
				$('.chocobo_digging_data_container').html(data);
			},
			error: function (jqXhr, textStatus, errorMessage) { // error callback 
				$('.chocobo_digging_data_container').append('Error: ' + errorMessage);
			}
		});
	});

	// Handle Responsive Tables
	$('table').each(function(index, el) {
		$(this).addClass('responsive');
	});

	// Responsive Tables
	if ( $('table.responsive').length > 0 ) {
		var tableheadCound = 1;
		$('table.responsive th').each(function() {
			$("<style type='text/css'> table.responsive td:nth-of-type("+tableheadCound+"):before { content: \""+$(this).text()+": \"; } table.responsive td:before { position: absolute; top: -9999px; left: -9999px; }</style>").appendTo("head");
			tableheadCound++;
		});
	}	

	// Handle Accordions
	$( 'body' ).on('click', '.accordion', function(event) {
		event.preventDefault();
		/* Act on the event */
		$(this).next('.panel').toggle();
	});
});