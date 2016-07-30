<?php the_content(); ?>
<?php

$members_data = get_option( 'sdss_members' );
$coco_data = get_option( 'sdss_coco' );
$coco_modified = get_option( 'sdss_coco_modified' );
$roles_data = get_option( 'sdss_roles' );
$affiliations_data = get_option( 'sdss_project' );
$participations_data = get_option( 'sdss_participations' );

echo '<div class="sdss-wrapper">';

//find the info about the project spokesperson
$this_coco = $coco_data[ 'spokesperson' ];
$this_fullname = $members_data[ $this_coco[ 'member_id' ] ][ 'fullname' ];
$this_affil_title = get_affiliation( $this_coco, $affiliations_data, $participations_data );
unset( $coco_data[ 'spokesperson' ] );

// Fail Gracefully
if ( empty( $coco_data ) ) {
	echo "<div class='label label-warning'>No data found</div>";
	return;
}

echo "<h2>The Collaboration Council</h2>\n";
echo "<p>&nbsp;<br/>";
echo "Chair (and SDSS-IV Spokesperson) <strong>" . $members_data[ $this_coco[ 'member_id' ] ][ 'fullname' ] . "</strong>";
if ( $affil_title = get_affiliation( $this_coco, $affiliations_data, $participations_data ) )
	echo " ( $affil_title ).";
echo"</p>\n";

echo "<div class='center-block'><em>Current members of the Collaboration Council and member institutions they represent.</em></div>";


echo "<dl class='dl-horizontal dl-horizontal-third'>\n";
	foreach($coco_data as $this_member_id=>$this_coco){
	
		echo "<dt>" . $members_data[ $this_member_id ][ 'fullname' ] . ": </dt>\n";
		echo "<dd>" . get_affiliation( $this_coco, $affiliations_data, $participations_data ) . "</dd>\n";

	}
echo "</dl>\n";
echo "<p class='modified'>Last modified: $coco_modified</p>";

function get_affiliation( $this_coco, $affiliations_data, $participations_data ){

	if ( empty( $this_coco[ 'affiliation_id' ] ) ) {
		if ( empty( $this_coco[ 'participation_id' ] ) ) 
			return false;

		if ( empty( $participations_data[ $this_coco[ 'participation_id' ] ][ 'title' ] ) ) 
			return false;
	
		return $participations_data[ $this_coco[ 'participation_id' ] ][ 'title' ];
	
	}
		
	if ( empty( $affiliations_data[ $this_coco[ 'affiliation_id' ] ][ 'title' ] ) ) 
		return false;

	return $affiliations_data[ $this_coco[ 'affiliation_id' ] ][ 'title' ];
		
}
echo '</div>';
