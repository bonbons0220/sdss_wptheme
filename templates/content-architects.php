<?php

// get the data from options 
$members_data = get_option( 'sdss_members ' );
$architects_data = get_option( 'sdss_architects ' );

if ( empty( $architects_data ) ) {
	echo "<div class='label label-warning'>No data found</div>";
	return;
}

//display the architects metadata
foreach ( $architects_data as $member_id => $data ) :  
	if ( array_key_exists( $member_id , $members_data ) )
	echo '<p><strong>' . $members_data[$member_id][ 'fullname' ] . '</strong> ';
	echo $data[ 'comment' ] . '</p>' . "\n";
endforeach; 
?>