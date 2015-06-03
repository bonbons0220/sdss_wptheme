<?php
if (!function_exists( 'get_cfc_meta' )) return; 

if ($architects_data = get_cfc_field( 'upload-architects' , 'json-architects-file' )) : 

	$architects_file = str_replace( get_site_url( ) , ABSPATH , $architects_data->guid ) ;
	$contents =  json_decode(file_get_contents( $architects_file ) );
	
	foreach( $contents->architects as $this_architect ) :
		$new_architects[] = array(
			'name'=>$this_architect->name , 
			'description'=>$this_architect->comment, 
			'modified'=>$this_architect->modified , 
		);
	endforeach;
	
	//Get rid of the file and CFC once it's uploaded.
	delete_post_meta( get_the_ID() , 'upload-architects' );
	wp_delete_attachment( $architects_data->ID );
	
	$old_architects = get_post_meta( get_the_ID() , 'architect' , true);
	update_metadata( 'post' , get_the_ID() , 'architect' , $new_architects , $old_architects );

endif;

foreach ( get_cfc_meta( 'architect' ) as $key => $value ) :  
	echo '<p><strong>';
	the_cfc_field('architect', 'name', false, $key);
	echo '</strong> ';
	the_cfc_field('architect', 'description', false, $key);
	echo '</p>';
endforeach; 
	
