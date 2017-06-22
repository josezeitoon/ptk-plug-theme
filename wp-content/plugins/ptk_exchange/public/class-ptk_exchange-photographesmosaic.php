<?php

/**
 * Construction of the content for a for a page of Folder type.
 *
 * @link       josevillalobos.com
 * @since      1.0.0
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/public
 *
 * @author     Jose VILLALOBOS <contact@josevillalobos.com>
 */
class Ptk_exchange_Photographesmosaic {


	public $folder_s = Array();
	


	public function __construct( $foldersfield ) {
	
		foreach($foldersfield as $field){
		
			$dat["id"] = $field['ptk_folders_children'];
			$dat["titre"] = $field['ptk_folders_children_title'];
		
			$this->folder_s[] = $dat;
		
		}
		
	

	}



	
	public function getlistes(){
	
		$liste_s = Array();
	
		foreach($this->folder_s as $folderfield){
		
			$ptkapi = new Ptk_exchange_API();
			
			$folder = $ptkapi->get_folder( $folderfield['id'] );
			
			$liste ["title"]  = $folderfield['titre'] ? $folderfield['titre'] : $folder->title;
			$liste ["photographe_s"] =Array();
			
			foreach($folder->children as $children){
			
				$dat["nom"] =  $children->name_fr;
				$dat["id"] =  $children->id;
				$liste ["photographe_s"][] = $dat;
			
			}
			
			$liste_s [] = $liste ;
		
		}
		
		return $liste_s;
	
	}


	

	


}
