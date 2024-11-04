<?php
/**
 * Plugin Name: Elementor Forms Range Date Field
 * Description: Custom addon that adds a "range-date" field to Elementor Forms Widget.
 * Version:     1.0.0
 * Author:      Miguel Angel Matias Rendon
 * Author URI:  https://miguelangelmatias.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package ERF_Elementor_Form_Range_Date_Field
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Add the custom range-date field to Elementor forms.
 *
 * @param \ElementorPro\Modules\Forms\Registrars\Form_Fields_Registrar $form_fields_registrar .
 */
function register_range_date_field( $form_fields_registrar ) {
	require_once __DIR__ . '/form-fields/erf-range-date.php';

	$form_fields_registrar->register( new Range_Date() );
}
add_action( 'elementor_pro/forms/fields/register', 'register_range_date_field' );

function register_script_field_range_date( $form_fields_registrar ) {
	wp_register_script( 'elementor-range-date', plugin_dir_url( __FILE__ ) . '/js/elementor-range-date.js', array( 'jquery', 'flatpickr' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'register_script_field_range_date' );
