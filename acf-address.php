<?php
/*
Plugin Name: Advanced Custom Fields: Address Field
Plugin URI: https://github.com/benplum/ACF-Field-Address
Description: A simple address field for Advanced Custom Fields Pro.
Version: 1.1.0
Author: Ben Plum
Author URI: https://benplum.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class ACF_Plugin_Address_Field {

  protected static $instance;

  public $file = __FILE__;

  var $settings;

  public static function get_instance() {
    if ( empty( self::$instance ) && ! ( self::$instance instanceof ACF_Plugin_Address_Field ) ) {
      self::$instance = new ACF_Plugin_Address_Field();
    }

    return self::$instance;
  }

  function __construct() {
    $this->settings = array(
      'version' => '1.1.0',
      'url' => plugin_dir_url( __FILE__ ),
      'path' => plugin_dir_path( __FILE__ )
    );

    // add_action( 'acf/register_fields', array( $this, 'include_field' ) ); // v4
    add_action( 'acf/include_field_types', array( $this, 'include_field' ) ); // v5
  }

  function include_field( $version = false ) {
    if ( ! $version ) $version = 5; // 4;

    // load_plugin_textdomain( 'acf', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' );

    include_once 'fields/class-acf-field-address-v' . $version . '.php';
  }

}

ACF_Plugin_Address_Field::get_instance();

include 'includes/updater.php';
