<?php
// get the data from options 
$publications_data = get_option( 'sdss_publications' );

// Fail Gracefully
if ( empty( $publications_data ) ) {
	echo "<div class='label label-warning'>No data found</div>";
	return;
}

$indx = count( $publications_data );
echo "<ul class='fa-ul'>";
foreach ( $publications_data as $publication_id => $this_pub ) :  
	// default url to use for publication title
	$dflt_url = ( !empty( $this_pub[ 'adsabs_url' ] ) ) ? $this_pub[ 'adsabs_url' ] : 
				( !empty( $this_pub[ 'doi_url' ] ) ) ? $this_pub[ 'doi_url' ] : 
				( !empty( $this_pub[ 'arxiv_url' ] ) ) ? $this_pub[ 'arxiv_url' ] : false ;
	echo "<li><i class='fa-li fa fa-book'></i>";
	if ( $dflt_url ) echo "<a target='_blank' href='$dflt_url' >";
	echo "<strong>" . $this_pub[ 'title' ] . "</strong>";
	if ( $dflt_url ) echo "</a>";
	echo '<br />' . $this_pub[ 'authors' ] .  '. ' ;
	if ( $this_pub[ 'journal_reference' ]) {
		echo $this_pub[ 'journal_reference' ];
	} else {
		echo '<em>' . $this_pub[ 'status' ] . '</em>';
	}	
	if ( !empty($this_pub[ 'adsabs' ] ) ) echo "; <a href='" . $this_pub[ 'adsabs_url' ] . "' target='_blank'>adsabs:" . $this_pub[ 'adsabs' ] . "</a>";
	if ( !empty($this_pub[ 'doi' ] ))  echo "; <a href='" . $this_pub[ 'doi_url' ] . "' target='_blank'>doi:" . $this_pub[ 'doi' ] . "</a>";
	if ( !empty($this_pub[ 'arxiv_url' ] ) ) echo "; <a href='" . $this_pub[ 'arxiv_url' ] . "' target='_blank'>arXiv:" . $this_pub[ 'arxiv' ] . "</a>";
	echo '.</li>';
endforeach; 
echo '</ul>';
?>