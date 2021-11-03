<?php  
// make sure wp itself is available
if ($_REQUEST["ajax"]){include("../../../wp-load.php");}


//if we receive the 'div'

if (isset($_GET['div'])) {
	$div = $_GET['div'];
//set up args
	 $args = array(	
	 'post_type' => 'product',
	 'post_status' => 'publish',
	 'posts_per_page' => '-1',
	 'tax_query' => array(
			array(
			  'taxonomy' => 'divisions',
					'field' => 'slug',
					'terms' => $div
     ))
	 );
	 //query all prods in chosen division
	 $query = new WP_Query( $args );
if($query->have_posts()){
	$posts = $query->get_posts();
	$namearray = array();
	foreach ($posts as $post){
	//	loop through each, adding its machinery type to an array
			// get division name for class
		$terms = get_the_terms( $post->ID , 'category' );
		//$terms = array_unique($terms);
	//$out = var_dump($terms);

		foreach ( $terms as $term ) {
		
		$termname = $term->name;
		//add to namearray
		array_push($namearray, $termname);
		

		}

			
	}
	$namearray = array_unique($namearray);
	foreach($namearray as $name){
		$options .= '<option value="'.$name.'">'.$name.'</option>';
	}
	
}
		
	else {$out = "noposts";} 
	 


//add their machinery types to an array
//loop through array outputting the form select html 	

//class="selectpicker" should be on the select below

	$fixedouttop = '
	<div class="wrap-cont">
		<div class="select-wrap">
			<select name="machinerytype" id="machinerytype"  multiple class="selectpicker" title="Machinery Type  &nbsp; (Multiple Select)" data-width="100%" data-dropup-auto="false" onchange="">';
	$fixedoutmiddle = $options;					
	$fixedoutbottom ='	
			</select>	
		</div>
	</div>		
	';
	

$out .=  $fixedouttop;
$out .=  $fixedoutmiddle;
$out .=  $fixedoutbottom;
    echo $out;
}

else {echo ("<p>error</p>");}
?>