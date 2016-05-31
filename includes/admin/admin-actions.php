<?php
/**
 * Admin Actions
 *
 * @package     KBS
 * @subpackage  Admin/Actions
 * @copyright   Copyright (c) 2016, Mike Howard
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Processes all KBS actions sent via POST and GET by looking for the 'kbs-action'
 * request and running do_action() to call the function
 *
 * @since	0.1
 * @return	void
 */
function kbs_process_actions() {
	if ( isset( $_POST['kbs-action'] ) ) {

		if ( isset( $_FILES ) )	{
			$_POST['FILES'] = $_FILES;
		}

		do_action( 'kbs-' . $_POST['kbs-action'], $_POST );

	}

	if ( isset( $_GET['kbs-action'] ) ) {

		if ( isset( $_FILES ) )	{
			$_POST['FILES'] = $_FILES;
		}

		do_action( 'kbs-' . $_GET['kbs-action'], $_GET );

	}

}
add_action( 'admin_init', 'kbs_process_actions' );

/**
 * Admin action field.
 *
 * Prints the output for a hidden form field which is required for admin post forms.
 *
 * @since	0.1
 * @param	str		$action		The action identifier
 * @param	bool	$echo		True echo's the input field, false to return as a string
 * @return	str		$input		Hidden form field string
 */
function kbs_admin_action_field( $action, $echo = true )	{
	$name = apply_filters( 'kbs-action_field_name', 'kbs-action' );
	
	$input = '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $action . '" />';
	
	if( ! empty( $echo ) )	{
		echo apply_filters( 'kbs-action_field', $input, $action );
	}
	else	{
		return apply_filters( 'kbs-action_field', $input, $action );
	}
	
} // kbs_admin_action_field
