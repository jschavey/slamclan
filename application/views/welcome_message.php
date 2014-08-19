<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}

	.dynamic {
		color: green;
		font-weight: bold;
	}
	</style>

	<script type="text/javascript" src="<?php echo base_url();?>assets/jscript/d3api.js" ></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<script>
	$( document ).ready( function() {
		$( "button#submit" ).click( function() {

			D3API.getHero({
				"battletagName": "emb3r",
				"battletagCode": "1997",
				"heroId": heroId,
				"success": function success(data, url, options) {
					var el = callback("getHero", true, data, url, options);
						
					var elItems = document.createElement("div"),
                        loadedItem = false,
						html = '<img src="' + D3API.Media.paperdoll(data) + '" alt="" /><br />';
							
					for (var type in data.items) {
						html += '<img src="' + D3API.Media.item(data.items[type]) + '" alt="" />';
                            
                	    if (!loadedItem) {
                            loadedItem = true;
                            D3API.getItem({
                                "item": data.items[type],
                                "success": function(data, url, options) {
                                    callback("getItem", true, data, url, options);
                                },
                                "error": function(data, url, options) {
                                    callback("getItem", true, data, url, options);
                                }
                            });
                        }
					}
                    html += '<br />';
					for (var type in data.skills) {
                        for (var i=0; i<data.skills[type].length; i++) {
                            html += '<img src="' + D3API.Media.skill(data.skills[type][i]) + '" alt="" />';
                        }
                    }
						
					elItems.innerHTML = html;
					el.appendChild(elItems);
				},
				"error": function error(data, url, options) {
					callback("getHero", false, data, url, options);
				}
			});	
		});
	});
	</script>
</head>
<body>

<div id="container">
	<h1>Item</h1>

	<input id="item" type="text" />

	<button id="submit">Submit</button>
	<div id="item"></div>
</div>

<div id="container">
	<h1>Basic Fetish Damage Formula</h1>

	<div id="body">
		<p>This is the typical formula for Sycophant or Fetish Army damage:</p>
		<p>[ (weapon damage) x (1 + (Intel / 100)) ] x [ APS ] x [ Fetish Tooltip ]</p>
		<p>[ (<span class="dynamic"><?= $weaponDamage ?></span>) * (1 + (<span class="dynamic"><?= $intelligence ?></span> / 100)) ] x [ <span class="dynamic"><?= $aps ?></span> ] x [ 180% ]</p>
		<p></p>

		<p>where [ Fetish Tooltip ]</p>
		<p>= 180% for Sycophant-Dagger (Physical)</p>
		<p>= 130% for Sycophant-Dart (Poison)</p>
		<p>= 180% for FA-Dagger (Element follows your choice of rune 1st three runes are Physical)</p>
		<p>= 85% for FA-Torcher (Fire)</p>
		<p>= 130% for FA-HeadHunter (Poison)</p>

	</div>
</div>

<div id="container">
	<h1>Weapon damage</h1>

	<div id="body">
		<p>Your weapon "per hit" (just below the huge DPS number) = <span class="dynamic"><?= $mainHand['perHit']['min'] ?></span> - <span class="dynamic"><?= $mainHand['perHit']['max'] ?></span></p>
		<p>You can either put the Min damage into that formula, or the Max damage, or the Average damage. You will get the damage number for each fetish that is actively attacking.</p>
	</div>
</div>

<div id="container">
	<h1>Fetish Damage Multipliers</h1>

	<div id="body">
		<p>To put into broad categories, we get</p>
		<p>[ Basic Damage ] x [ % Element ] x [ % Skill ] x [ % Elite ] x [ % CHC&CHD ]</p>
		<p>[ <span class="dynamic"><?= $basic ?></span> ] x [ <span class="dynamic"><?= 1 + $element ?></span> ] x [ 1 ] x [ <span class="dynamic"><?= 1 + $elite ?></span> ] x [ 2.4 ] = 10 Multiplier for each fetish army</p>

		<p>The sycophant fetish is not considered Fetish Army, and therefore is not affected by the %FA Skill bonus.</p>

		<p><strong>For some unknown reason, Mask of Jeram pet damage bonus has been grouped together with %Element.</strong></p>

		<p>There are also separate factors to the damage output that is not captured in the generic formula above, and that is the hit-frequency (Tasker & Theo potentially, although not tested yet). It does not alter the damage numbers you see on screen, but as the hit-frequency changes, so does your eDPS.</p>

		<p>We should also note that stacking all into 1 category is not optimal, based on a mathematical function of multiple input factors. A fair distribution of multipliers will be optimal.</p>
		<p>(D x 1.1 x 1.1 x 1.1 x 1.8) < (D x 1.3 x 1.3 x 1.3 x 1.2)</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>