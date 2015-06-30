<?php
/**
 * Custom functions
 */

add_filter('roots_wrap_base', 'roots_wrap_base_cpts'); // Add our function to the roots_wrap_base filter

function roots_wrap_base_cpts($templates) {
	$cpt = get_post_type(); // Get the current post type
	if ($cpt) {
		array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
	}
	return $templates; // Return our modified array with base-$cpt.php at the front of the queue
}

add_filter( 'user_can_richedit' , '__return_false', 50 );

/*
 * Display the affiliations and participation group information.
 * Echo by default. If $return is true, then return the string.
 */
function sdss_get_project_affiliations( $return = false , $h2=2 ) {
	
	$h2 = "h" . intval($h2);
	
	// get the data from options 
	if ( !( ( $project_data = get_option( 'sdss_project' ) ) && 
		 ( $participations_data = get_option( 'sdss_participations' ) ) ) ) return false;

	$full_participation_list = '';
	foreach( $participations_data as $this_participation_id=>$this_participation ){

		$this_participation_list = '';
		foreach( $project_data as $this_project ){
			
			if ( $this_project['participation_id'] == $this_participation_id )
				$this_participation_list .= "<li>" . $this_project['title'] . "</li>\n";
		}
		$this_participation_list = "<strong>" . $this_participation['title'] . "</strong>\n<ul class='none'>\n" . $this_participation_list . "</ul>\n";
		$full_participation_list .= "<li>" . $this_participation_list . "</li>";
	}
	$result  = "<$h2>Participation Groups</$h2>\n<ul\n>" . $full_participation_list . "</ul>";

	$full_member_list = '';
	$associate_member_list = '';
	foreach( $project_data as $this_project ){
		if ( strcmp( "full_member" , $this_project['type']) ===0 ) $full_member_list .= "<li>" . $this_project['title'] . "</li>\n";
		if ( strcmp( "associate_member" , $this_project['type']) ===0 ) $associate_member_list.= "<li>" . $this_project['title'] . "</li>\n";
	}

	$result = "<$h2>Associate Member Institutions</$h2>\n<ul>\n" . $associate_member_list . "</ul>\n" . $result;
	$result = "<$h2>Full Member Institutions</$h2>\n<ul>\n" . $full_member_list . "</ul>\n" . $result;

	$result = "<div class='sdss-wrapper'>" . $result . "</div>";

	if ( $return ) return $result;
	
	echo $result;
	return;
	
}

/*
 * Show some debug values in preformatted style.
 */
function idies_debug( $var ) {
        if ( WP_DEBUG ) :

                echo "<PRE>";

                if (is_array($var)) :
                        print_r($var);
                elseif (is_object($var)) :
                        var_dump($var);
                else :
                        print($var);
                endif;

                echo "</PRE>";

        endif;
        return;
}

/*
 * Insert a comment on a page. 
 * Doesn't work yet... --Bonnie
 */
add_filter( 'the_content', 'idies_add_comment' );
function idies_add_comment( $content  ) {
	
	global $idies_debug_comment;

	if (!( WP_DEBUG ) || empty( $idies_debug_comment ) ) return $content;
	
	
	foreach( $idies_debug_comment as $this_comment ) {
	
		if ( empty( $this_comment[ 'page' ] ) ) {
		
			$content .= $content . $idies_debug_comment ;
			
		} elseif ( $GLOBALS[ 'post' ]->post_name == $this_comment[ 'page' ] ) {
			$content .= $content . $this_comment[ 'comment' ] ;
		}
	}
	return $content;
}

/*
 * Create a comment to insert on a page. 
 * Doesn't work yet... --Bonnie
 */
function idies_comment( $var , $pagename="" ) {
	
	global $idies_debug_comment;
	//$idies_debug_comment = empty( $idies_debug_comment ) ? array() : $idies_debug_comment ;
	
	$this_comment = "<!-- DEBUG \n";

	if (is_object($var)) :
		$this_comment .= var_export( $var , true );
	else :
		$this_comment .= print_r( $var , true );
	endif;

	$this_comment .= "\n -->\n";
	$idies_debug_comment[] = array( 'page'=>$pagename , 'comment'=>$this_comment );

	return;
}

?>