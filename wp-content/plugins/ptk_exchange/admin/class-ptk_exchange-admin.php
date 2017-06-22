<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       josevillalobos.com
 * @since      1.0.0
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/admin
 * @author     Jose VILLALOBOS <contact@josevillalobos.com>
 */
class Ptk_exchange_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}



	/**
	 * Add categories to pages
	 *
	 * @since	1.0.0
	 */
	function add_taxonomies_to_pages() {
	// register_taxonomy_for_object_type( 'post_tag', 'page' );
	register_taxonomy_for_object_type( 'category', 'page' );

	}


	/**
	 * Add specific categories once  on load plugin
	 *
	 * @since	1.2.8
	 */
	public function add_specific_categories( ){

		wp_insert_term(
			'ptk folder',
			'category',
			array(
			  'description'	=> 'page folder picture tank ',
			  'slug' 		=> 'ptk_folder'
			)
		);

		wp_insert_term(
			'ptk custom folder',
			'category',
			array(
			  'description'	=> 'page custom folder ',
			  'slug' 		=> 'ptk_custom_folder'
			)
		);

		wp_insert_term(
			'ptk serie',
			'category',
			array(
			  'description'	=> 'page de type serie texte + planche contact',
			  'slug' 		=> 'ptk_serie'
			)
		);
	}








	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ptk_exchange_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ptk_exchange_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ptk_exchange-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ptk_exchange_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ptk_exchange_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ptk_exchange-admin.js', array( 'jquery' ), $this->version, false );

	}

}
