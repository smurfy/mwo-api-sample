<?php
/**
 * smurfy MWO Mechlab plugin
 *
 * version smf 2.0*
 */

	global $smcFunc;

	$direct_install = false;
	if(file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF')){
		require_once(dirname(__FILE__) . '/SSI.php');
		$direct_install = true;
	}
	elseif (!defined('SMF'))
		die('-');

	db_extend('packages');

	$hooks = array(
		'integrate_pre_include' => '$sourcedir/smurfyMechlab.php',
		'integrate_bbc_codes' => 'smurfyMechlab_codes',
		'integrate_bbc_buttons' => 'smurfyMechlab_buttons',
		'integrate_menu_buttons' => 'smurfyMechlab_menu_buttons',
	);

	foreach($hooks AS $hook => $call)
		add_integration_function($hook,$call);

	if($direct_install)
		echo 'Direct install...';

?>