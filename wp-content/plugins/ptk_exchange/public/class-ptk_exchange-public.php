<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       josevillalobos.com
 * @since      1.0.0
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/public
 * @author     Jose VILLALOBOS <contact@josevillalobos.com>
 */
class Ptk_exchange_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ptk_exchange-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ptk_exchange-public.js', array( 'jquery' ), filemtime(plugin_dir_path( dirname( __FILE__ ) ). 'public/js/ptk_exchange-public.js'), false );

	}
	

	public function contentptk($content){
	
		global $post;

		$templatepageID = $post->ID;
		$templatepageTitle = "";
		
		
		
		// TRUE if the ID is on the url
		//the page displayed is "folder"  
		
		
		//if the ID is on the url
		if(isset($_GET["ref"])) {
		
			$ptk_folder_id =  $_GET["ref"] ;
			$dynamicpage = TRUE;
		
		}else{
		
			$dynamicpage = FALSE;
		
		}
		
	//var_dump($ptk_folder_id,$templatepageID);
		//the page is dynamic
		//we search if a template exists on pages 
		if($dynamicpage){
		
			$query = Array(
			'numberposts' => 1,
			'post_type'		=> 'page',
			 'meta_key' => 'ptk_folder_id',
			 'meta_value'	=> $ptk_folder_id
			 );
			if( $templateposts = get_posts($query) ){
				
				$post = $templateposts[0];
				$templatepageID = $templateposts[0]->ID;
				$templatepageTitle = $templateposts[0]->post_title_ml;
			} 
		
		}

		
		
		
		
		
		$cats = get_the_category() ;
		//var_dump($cats);
		
		
		//MORE THAN 1 possible
		//EG. CORPORATE HAS CUSTOM AND PTK FOLDER 
		foreach($cats as $cat){
		
			
			switch ($cat->slug) {
			
				case "ptk_folder" :
				 
					// the level of the folder (1 or 2), diferent presentation
					// 1 is "folder with folders"
					// 2 is "folder with series"
					$level = 1;
				
					
					
					//ver....
					//get custom fields of page with categoty ptk_folder
					// 
					$ptk_folder_id = $ptk_folder_id  ? $ptk_folder_id : get_field("ptk_folder_id");
					

					
					// If I don't have a folder Ref Error (TODO 404)
					if(!$ptk_folder_id) return "pas de réf";

					
					

					$ptkapi = new Ptk_exchange_API();
					
					// creation of the folder 
					$folder = $ptkapi->get_folder($ptk_folder_id);


					if (!$folder) {
						
						// change to header .. 404
						echo "404";
						break;
					
					}


					
					//FOLDER OF FOLDERS (1rst LEVEL)
					// OR FOLDER OF SERIES (2nd LEVEL)
					
					if($folder->nbSeries){
					
						// request Series from PTK, Json 2 array returned
						// an Array of series (Ptk_exchange_API_serie) returned
						$ptkitems = $ptkapi->get_series_from_ptk_folderseries($ptk_folder_id,'fr');
						$level = 2 ;
						
						
					}else{
						
						//subfolders
						// an Array of folders (Ptk_exchange_API_serie) returned
						$ptkitems = $folder->get_my_folders();
						$level = 1 ;
					
					}
					

					//the class that organise the mosaic and will call the view
					$foldermosaic = new Ptk_exchange_Foldermosaic ($level);



					if ($v =  get_field("ptk_folder_def_blocs_par_ligne",$templatepageID) ) $foldermosaic->default_blocs_per_line = $v;
					if ($v =  get_field("ptk_folder_def_hauteur_ligne",$templatepageID) ) $foldermosaic->default_h_line = $v;
					if ($v =  get_field("ptk_folder_no_pictures",$templatepageID) ) $foldermosaic->default_no_pictures = $v;
					if ($v =  get_field("ptk_folder_def_format",$templatepageID) ) $foldermosaic->default_format = $v;
					$foldermosaic->default_crop = get_field("ptk_folder_def_crop",$templatepageID);

					
										
					
					$foldermosaic->set_customline_s(get_field("ptk_folder_custom_line",$templatepageID));
					
					
					//var_dump($ptkitems );
					
					//if template for this ref I take the title 
					$foldermosaic->title = ($templatepageTitle) ?
					$templatepageTitle :
					$folder->title;
					
					
					//var_dump($foldermosaic->title);
					
					$line_s = $foldermosaic->get_linesbloc_by_ptk_items($ptkitems);


					if ($line_s) require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ptk_exchange-public-display-foldermosaic.php';
				
					//return "";
					break;
								
				case "ptk_custom_folder" :
				

					// maybe  possibility of level 2 on the admin options
					$level = 1;
					
					$foldermosaic = new Ptk_exchange_Foldermosaic ($level);
					
					if($ptk_folder_id == 369 || $templatepageID==122) $foldermosaic->hautdouble = "hautdouble";
					
					//default values 
					if ($v =  get_field("def_blocs_par_ligne",$templatepageID) ) $foldermosaic->default_blocs_per_line = $v;
					if ($v =  get_field("def_hauteur_ligne",$templatepageID) ) $foldermosaic->default_h_line = $v;
					if ($v =  get_field("def_format",$templatepageID) ) $foldermosaic->default_format = $v;


					$foldermosaic->default_crop = get_field("def_crop",$templatepageID);
					
					
					$line_s = $foldermosaic->get_linesbloc_by_customblocs(get_field("blocs"));

					
//					var_dump($line_s );

					if ($line_s) require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ptk_exchange-public-display-foldermosaic.php';
				
					//return "";
					break;
					
				case "ptk_serie" :
				
					//the series always dynamic ID on the url
					//a template page with option could be created on admin (?)
					
					if( isset($_GET["ref"]) ) {
					
						$id = $_GET["ref"];
					
					}else{
						
						// change to header .. 404
						echo "404";
						return "";
					
					}

					

					$seriemosaic = new Ptk_exchange_Seriemosaic ($id);
					
					$line_s = $seriemosaic->get_linesbloc_by_children();
					
					//var_dump($line_s);
					if ($line_s) require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ptk_exchange-public-display-seriemosaic.php';
				
					//return "";
					break;

				case "ptk_photographes" :
				
					//the series is never dynamic
					//a template page with option could be created on admin (?)
					

					

					$photographemosaic = new Ptk_exchange_Photographesmosaic (get_field("ptk_folders"));
					
					
					//$line_s = $seriemosaic->get_linesbloc_by_children();
					
					$liste_s = $photographemosaic->getlistes();
					
					
					//wow ! I must change this echo!!!!
					echo '<div id="photographes" class="row">';
					foreach ($liste_s as $liste){
					
						//var_dump($liste);
					
						require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ptk_exchange-public-display-photographesmosaic.php';
					
					}
					echo '</div>';
					
					//var_dump($line_s);
					//if ($line_s) require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ptk_exchange-public-display-seriemosaic.php';
				
					//return "";
					break;

			
				default :
				
					//return $content."<h3>ID:".$post->ID." PTKCONTENT DEFAULT</h3>"; 
					break;
			
			
			}
		
		
		}

		//return $content."<h3>ID:".$post->ID."PTKCONTENT".$pagecat."</h3>";
	}
	
	

}
