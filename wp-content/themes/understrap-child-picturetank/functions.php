<?php






function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

   //oooooo// wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
   //oooooo//  wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array(), filemtime(get_stylesheet_directory() . '/css/child-theme.css') );
    wp_enqueue_script( 'angularjs', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js', array(), "1.6.4", false );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.js', array(), filemtime(get_stylesheet_directory() . '/js/child-theme.js'), true );
}



if(  function_exists( 'themify_icons_add_menu_item_title_filter' ) ) {
	remove_filter( 'wp_nav_menu_args', 'themify_icons_add_menu_item_title_filter'  );

	function ptk_themify_icons_add_menu_item_title_filter( $args ) {
		add_filter( 'the_title', 'ptk_themify_icons_the_title', 10, 2 );
		return $args;
	}
	add_filter( 'wp_nav_menu_args', 'ptk_themify_icons_add_menu_item_title_filter' );


	/**
	 * Append icon to a menu item
	 *
	 * @since 1.0
	 */
	function ptk_themify_icons_the_title( $title, $id ) {
		if( $icon = themify_icons_get_menu_icon( $id ) ) {
			wp_enqueue_style( 'themify-icons' );
			$title = '<i class="themify-menu-icon ' . themify_get_icon( $icon ) . '"></i><span class="themify-title" >' . $title.'</span>';
		}

		return $title;
	}

}






/* Disable WordPress Admin Bar for all users but admins. */
  show_admin_bar(false);