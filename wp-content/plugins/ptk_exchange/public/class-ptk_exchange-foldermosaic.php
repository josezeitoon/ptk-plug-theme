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
class Ptk_exchange_Foldermosaic {

	public $title = "";
	
	public $level = 1;

	public $default_h_line = "untiers";
	public $default_blocs_per_line = 4;
	public $default_no_pictures = FALSE;
	public $default_format = "f_6x6";
	public $default_crop = TRUE;

	public $customline_s = Array();
	
	
	public $hautdouble = "";


	//level 1 or 2
	public function __construct( $level ) {
	
		$this->level = $level ? $level : $this->level;


	}
	
	public function put_title($before,$after){
	
		echo ($this->level == 2 && $this->title) ? $before.__($this->title).$after : "";
	
	}

	public function set_customline_s ($cl) { 
	
	//line number on index and correction if same line number on diferent lines
	
		foreach($cl as $i => $line){
		
			$dat = Array();
			
			// 1 based (human option) to 0 based index (lines on array)
			$l = $line['cl_line_number'] - 1 ;
			
			$dat["custom_format"] = $line['cl_format'];
			$dat["custom_blocs_per_line"] = $line['cl_blocs_per_line'];

			
			$dat["disposition"] = $dat["disposition"] ? $dat["disposition"] : "auto";
			
			//next index if index already exists 
			while( isset($this->customline_s[$l]) ){

				$l++;

			}
			
			//
			$this->customline_s[$l] = $dat;
		
		}
		
		//not necessary to sort but is prettiest ... 
		ksort($this->customline_s);
		
		//var_dump($this->customline_s);
	
	}
	
/*////////
customline_s exemple

	array (size=3)
  0 => 
    array (size=5)
      'cl_line_number' => string '1' (length=1)
      'cl_h_line' => string 'untiers' (length=7)
      'cl_blocs_per_line' => string '2' (length=1)
      'cl_disposition_2' => string 'auto' (length=4)
      'cl_disposition_3' => string '' (length=0)
  1 => 
    array (size=5)
      'cl_line_number' => string '3' (length=1)
      'cl_h_line' => string 'unquart' (length=7)
      'cl_blocs_per_line' => string '3' (length=1)
      'cl_disposition_2' => string '' (length=0)
      'cl_disposition_3' => string 'undemiunquartunquart' (length=20)

cl_format
f_6x6 : format carré
f_24x36 : 24x36
f_4x3 : 4x3
f_16x9 : 16x9 (pano)
f_12x4 : 12x4 (pano + )
f_auto : hauteur auto
1t2t-24x36 : verticale + horizontale 24x36
2t1t-24x36 : horizontale 24x36 + verticale
1t2t-4x3 : verticale + horizontale 4x3
2t1t-4x3 : horizontale 4x3 + verticale
1t2t-6x6 : carrée + horizontale
2t1t-6x6 : horizontale + carrée

f_6x6
f_24x36
f_4x3
f_16x9
f_12x4
f_auto
f_1t2t-24x36
f_1t2t-4x3
f_1t2t-6x6
f_2t1t-24x36
f_2t1t-4x3
f_2t1t-6x6
///////////////////*/




	/**
	 * All the blocs (Ptk_exchange_Bloc) organized on an Array on lines 
	 * info coming from ptkAPI
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $ptkitems         an array of series or folders
	 * @return   array                                  The collection of the lines conataining the objects Ptk_exchange_Bloc .
	 */

	public function get_linesbloc_by_ptk_items($ptkitems){
	
	
					$line_s = Array();
					
					$ptkapi = new Ptk_exchange_API();
					
					//the line number 0 based
					$nbline = -1;
					$line_s[0] = Array();
					
					//$this->customline_s;


					// index of block displayed
					$ib = 0;
					
					//blocks per line by default
					$count_down = $this->default_blocs_per_line ? $this->default_blocs_per_line : 3;
					
					//$h_line =  $this->default_h_line;
					
					$classformat_line = $this->default_format."_".$this->default_blocs_per_line;
					
					$crop_line = $this->default_crop;
					
					// the position on line 0 based
					$bloc_pos_on_line = 0;
					
					$width_s = Array();

					if($ptkitems){

						foreach($ptkitems as $serieOrFolder){
							
							//var_dump($nbline);
							
							// FIRST BLOC OR FOR NEW LINE
							if( !--$count_down || $ib==0) {

								$nbline++;
								

								$line_s[$nbline] = Array();
								
								// number of blocks per line
								$count_down = $this->default_blocs_per_line ? $this->default_blocs_per_line : 3;
								
								// height of blocs on this line
								//$h_line = $this->default_h_line;
								
								// class (for imbox height) for this line
								$classformat_line = $this->default_format."_".$this->default_blocs_per_line;
								
								//the position of the bloc on the line, reset
								$bloc_pos_on_line = 0;
								
								//used for custom widths
								$width_s = Array();
								
								//do I have a custom line for this line?
								if( isset($this->customline_s[$nbline]) ){
							
									//set the new "ims per line" for this line
									$count_down = isset( $this->customline_s[$nbline]["custom_blocs_per_line"] ) ?
									$this->customline_s[$nbline]["custom_blocs_per_line"] :
									$count_down ;
									
									
									//spécial formats for 2 images 
									if( in_array( $this->customline_s[$nbline]["custom_format"], [
									
									"f_1t2t-24x36","f_2t1t-24x36","f_1t2t-4x3","f_2t1t-4x3","f_1t2t-6x6","f_2t1t-6x6"
									
									] ) ) $count_down = 2;

									//the height for every block on this line
									//$h_line = $this->customline_s[$nbline]["custom_h_line"];
									
									
									
									//the class that gives the height of the imbox
									//in relation with the format and the numbers of blocs
									$classformat_line = isset($this->customline_s[$nbline]["custom_format"]) ?
									$this->customline_s[$nbline]["custom_format"]."_".$count_down:
									$this->default_format."_".$this->default_blocs_per_line;
									
									
									
									
									//find the custom widths for each bloc
									//($count_down for the number of blocs)
									$width_s = Ptk_exchange_Bloc :: classes4disposition($count_down,$this->customline_s[$nbline]["custom_format"] );

							
								}		

							}
							
							
		
							// create displayblock
							$bloc =  new Ptk_exchange_Bloc();
		
							//$ref,$width,$class,$classimbox,$titre,$subhead,$intro,$poster,$link,$noposter,$error,$level

							$bloc->ref = $serieOrFolder->id;
							//$width = "auto";
							$bloc->titre = $serieOrFolder->title;
							$bloc->subhead = $serieOrFolder->type == "serie" ? $serieOrFolder->author : "";
							$bloc->intro = $serieOrFolder->story;
							$bloc->poster = $ptkapi->get_ptk_photo($serieOrFolder->thumb,800);
							//var_dump($poster);
							
							$bloc->class = "";
							
							
							//$bloc->classimbox =  $this->default_format."_".$this->default_blocs_per_line;
			
							$bloc->classimbox =  $classformat_line;
				
							
							
							$bloc->error =  $bloc->poster ? "" : "image not found";
							
							$bloc->classimbox .=  $bloc->poster ? "" : " noimage";

							//add class to fit the image, don't crop
							$bloc->classimbox .=  !$crop_line ? " fit" : "";
							
							//dont show image if by default 
							$bloc->noposter = $this->default_no_pictures ? $this->default_no_pictures: FALSE;
							
							//dont show image if no ref and is a folder
							//for series we show a blak box
							$bloc->noposter = !$serieOrFolder->thumb && $serieOrFolder->type == "folder" ?
							 TRUE : FALSE;
							
							$bloc->link = $serieOrFolder->type == "folder" ?
							"/folder/?ref=".$serieOrFolder->id:
							"/serie/?ref=".$serieOrFolder->serieRandomId;
							
							

							//var_dump($noposter);
							
							$bloc->level = $this->level;
							

							//must be corrected
							$bloc->thumb = $serieOrFolder->thumb ;
							
							//if custom width for this bloc
							if( isset($width_s[$bloc_pos_on_line]) ){
							
								$bloc->class = $width_s[$bloc_pos_on_line] ;
							
							}else{//width depending of number of blocs per line
								$bloc->setAutoWidthOneOf($bloc_pos_on_line,$this->default_blocs_per_line);
							}
							
							//
							
							$bloc->class .=  $bloc->noposter ? " noposter" : "";
							
							//add this block to the line
							$line_s[$nbline][] = $bloc ;
		
							
		
							$ib++;
							$bloc_pos_on_line++;
	
	
	
						}


					}
					
					return $line_s;
	
	}
	
	/**
	 * All the blocs (Ptk_exchange_Bloc) organized on an Array on lines
	 * info coming from admin wp custom field
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $blocs            The field "blocs" from WP page "ptk_custom_folder"
	 * @return   array                                  The collection of the lines conataining the objects Ptk_exchange_Bloc .
	 */
	public function get_linesbloc_by_customblocs($blocs){
	
		$line_s = Array();
		$nbline = 0;
		$line_s[0] = Array();
		$countByLine = 0;
		//$hline = "auto";
		
		
		// index of block displayed
		$ib = 0;
		
		//blocks per line by default
		$count_down = $this->default_blocs_per_line ? $this->default_blocs_per_line : 3;
		//echo "default cd :";
		//var_dump($count_down);
		//$h_line =  $this->default_h_line;
		
		$classformat_line = $this->default_format."_".$this->default_blocs_per_line;
		
		$crop_line = $this->default_crop;
		
		// the position on line 0 based
		$bloc_pos_on_line = 0;
		
		
		//default widths in case the first bloc is not a "new line"
		$width_s = Ptk_exchange_Bloc :: classes4disposition($count_down,$this->default_format);
		
		
		$ptkapi = new Ptk_exchange_API();
		
		
		//CROP OPTION

		if(is_array($blocs)){

			foreach($blocs as $i => $bloc){
			
					//echo $i."-PRENL cd ".$count_down."<br>";
				if(  $bloc['bloc_type']=='newline' || !$count_down-- ){
				
					//echo "NEWLINE - bloc_type :".$bloc['bloc_type']."cd ".$count_down;
		
		
		
		
					//$hline = $bloc['bloc_type']=='newline' ? $bloc['bloc_hauteur'] : $hline ;
					
					//new data if new line, keep precedent if not
					$count_down = 
						$bloc['bloc_type']=='newline' ? 
						$bloc['bloc_line_blocs_per_line'] :
						$this->default_blocs_per_line ;






					//spécial formats for 2 images 
					if($bloc['bloc_type']=='newline'){
						if( in_array( $bloc['bloc_line_format'], [
					
							"f_1t2t-24x36","f_2t1t-24x36","f_1t2t-4x3","f_2t1t-4x3","f_1t2t-6x6","f_2t1t-6x6"
					
						] ) ) $count_down = 2;

					}
					//the las line option become the default
					
					
					$this->default_blocs_per_line = $count_down;





					$classformat_line = 
						$bloc['bloc_type']=='newline' ? 
						$bloc['bloc_line_format']."_".$count_down :
						 $classformat_line ;

					


					$width_s = Ptk_exchange_Bloc :: classes4disposition($count_down,substr( $classformat_line,0,-2) );

					//the position of the bloc on the line, reset
					$bloc_pos_on_line = 0;
					
					
					if($i>0){
					
						if(count($line_s[$nbline])){
						
						//// nop 	Ptk_exchange_Bloc :: checkautowidth($line_s[$nbline]);
						
						}
						
						$nbline++;
						$countByLine = 0;
						$line_s[$nbline] = Array();
						
					
					}
				
				
				}
				
				if($bloc['bloc_type']!='newline'){
				


					// create displayblock
					$displayblock = new Ptk_exchange_Bloc();

					$displayblock->type = $bloc['bloc_type'] ; //serie , folder
					$displayblock->ref = $bloc["bloc_ref"];


					$displayblock->classimbox =  $classformat_line;
					
					//add class to fit the image, don't crop
					$displayblock->classimbox .=  !$crop_line ? " fit" : "";

					$displayblock->subhead = $bloc["bloc_subhead"];
					

					if($displayblock->type=="serie"){
						if( $serie = $ptkapi->get_serie($bloc["bloc_ref"],'fr')){
					
							$displayblock->titre = $serie->title;
							$displayblock->thumb = $serie->thumb;
							$displayblock->link = "/serie/?ref=".$bloc["bloc_ref"]; //randomID !!
							$displayblock->subhead = $displayblock->subhead ? $displayblock->subhead : $serie->author;
							
							$displayblock->intro = $serie->story;
						
						
							//thumb is an index of the images list
							if($bloc["bloc_thumb_by"]=="index"){
						
								$i = $bloc["bloc_thumb_index"] > 0 ? $bloc["bloc_thumb_index"] - 1 : 0;
								if ( isset($serie->photoList[$i]) ) {
									$displayblock->thumb = $serie->photoList[$i]->randomId;
								}
							
							}
						
						
						}else{
							$displayblock->error =  "serie not found";
						}
					}elseif($displayblock->type=="folder"){
					
						if( $folder = $ptkapi->get_folder($bloc["bloc_ref"])){
					
							$displayblock->titre = $folder->title;
							$displayblock->thumb = $folder->thumb;
							$displayblock->link = "/folder/?ref=".$folder->id;					
						
						}else{
							$displayblock->error =  "folder not found";
						}
					
					}

					//override title
					$displayblock->titre = $bloc["bloc_title"] ? $bloc["bloc_title"] : $displayblock->titre;
					
					//override thumb
					if($bloc["bloc_thumb_by"]=="ref"){
					
						$displayblock->thumb = $bloc["bloc_thumb_ref"] ? $bloc["bloc_thumb_ref"] : $displayblock->thumb;
						
					}
					
					
					
					
					$displayblock->poster = $ptkapi->get_ptk_photo($displayblock->thumb,800);
					
					$displayblock->error =  $displayblock->poster ? "" : "image not found";


					//TEMP
					$displayblock->noposter = FALSE;
					
					$displayblock->level = 1 ;
					
					$displayblock->classimg = "pos_".$bloc["bloc_crop_position"] ;

					
//					$displayblock->bloc->thumb = $thumb ;
					
					
					
					////////////
								//echo "<br>bloc_pos_on_line".$bloc_pos_on_line."<br>";

					if( isset($width_s[$bloc_pos_on_line]) ){
					
						$displayblock->class = $width_s[$bloc_pos_on_line] ;
					
					}else{//width depending of number of blocs per line
						
						$displayblock->setAutoWidthOneOf($bloc_pos_on_line,$this->default_blocs_per_line);
						
					}
					
					

					$line_s[$nbline][] = $displayblock;
					$countByLine++;
					$bloc_pos_on_line++;
			
				}
						
				
				//check auto for the last line
				//Ptk_exchange_Bloc :: checkautowidth($line_s[$nbline]);
				
	
			}


		}
					
		return $line_s;
	
	}
	


}
