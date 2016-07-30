<?php
/**
 * Custom functions for SDSS
 */

/**
 * FILTERS
 */

add_filter('roots_wrap_base', 'roots_wrap_base_cpts'); // Add our function to the roots_wrap_base filter
function roots_wrap_base_cpts($templates) {
	$cpt = get_post_type(); // Get the current post type
	if ($cpt) {
		array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
	}
	return $templates; // Return our modified array with base-$cpt.php at the front of the queue
}

// Don't let users use Visual content editing - it screws up special characters.
add_filter( 'user_can_richedit' , '__return_false', 50 );

function sdss_add_attachment_gallery( $form_fields, $post ) {
	
	//Show In SDSS Gallery Checkbox
    $value = (bool) get_post_meta( $post->ID, '_gallery', true );
    $checked = ($value) ? 'checked' : '';
    $form_fields['gallery'] = array(
		'label' => __( 'Show in SDSS Gallery' ),
        'input' => 'html',
		'html' => "<input type='checkbox' " . 
					" $checked " . 
					"name='attachments[{$post->ID}][gallery]' " .
					"id='attachments-".$post->ID."-gallery' " .
					">",
        'value' => $value,
	);
	
	// License / Image Use textarea
    $form_fields['license'] = array(
		'label' => __( 'License' ),
        'input' => 'html',
		'html' => "<textarea class='widefat'" . 
					"name='attachments[{$post->ID}][license]' " .
					"id='attachments-".$post->ID."-license' " .
					">" . get_post_meta($post->ID, "_license", true ) .
					"</textarea>",
		'extra_rows' => array("row1" => "<em>Only fill in License field if not under the SDSS General Image Use Policy.<em><br>&nbsp;") ,
	);
	
    $form_fields['credit'] = array(
		'label' => __( 'Image Credit' ),
        'input' => 'html',
		'html' => "<textarea class='widefat'" . 
					"name='attachments[{$post->ID}][credit]' " .
					"id='attachments-".$post->ID."-credit' " .
					">" . get_post_meta($post->ID, "_credit", true ) .
					"</textarea>",
	);
	
	
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'sdss_add_attachment_gallery', 10, 2 );

function sdss_save_attachment_gallery( $attachment_id ) {
    
	$gallery = ( isset( $_REQUEST['attachments'][$attachment_id]['gallery'] ) &&
				( $_REQUEST['attachments'][$attachment_id]['gallery'] == 'on' ) ) 
				? '1' : '0';
	update_post_meta( $attachment_id, '_gallery', $gallery );
    if ( isset( $_REQUEST['attachments'][$attachment_id]['license'] ) ) {
        $license = $_REQUEST['attachments'][$attachment_id]['license'] ;
        update_post_meta( $attachment_id, '_license', $license );
    }
    if ( isset( $_REQUEST['attachments'][$attachment_id]['credit'] ) ) {
        $credit = $_REQUEST['attachments'][$attachment_id]['credit'] ;
        update_post_meta( $attachment_id, '_credit', $credit );
    }
}
add_action( 'edit_attachment', 'sdss_save_attachment_gallery' );

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

/**
 * ACTIONS
 */
//function sdss_add_categories_to_attachments() {
//    register_taxonomy_for_object_type( 'category', 'attachment' );
//}
//add_action( 'init' , 'sdss_add_categories_to_attachments' );

// apply tags to attachments
function sdss_add_tags_to_attachments() {
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'sdss_add_tags_to_attachments' );

/**
 * USEFUL FUNCTIONS
 */

/*
 * Create a comment to insert on a page. 
 * Doesn't work yet... --Bonnie
 */
function idies_comment( $var , $pagename="" ) {
	
	global $idies_debug_comment;
	
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

/*
 * Display the affiliations and participation group information.
 * Echo by default. If $return is true, then return the string.
 */
function sdss_get_project_affiliations( $return = false , $h2=2 ) {
	
	$h2 = "h" . intval($h2);

	$affiliations_modified = get_option( 'sdss_affiliations_modified' );
	
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
	$result .= "<p class='modified'>Last modified: $affiliations_modified</p>";

	if ( $return ) return $result;
	
	echo $result;
	return true;
	
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


?>