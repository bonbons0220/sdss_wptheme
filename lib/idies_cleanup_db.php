<?php
echo "<pre>";
echo "Disabled";

define('DB_NAME', 'sdsswp_dr13_test');
define('DB_USER', 'sdsswp');
define('DB_PASSWORD', 'BTNjnFO2JXQzgj4DsrnBewR85cb');
define('DB_HOST', 'dsa008');

$mysqli = new mysqli( DB_HOST , DB_USER, DB_PASSWORD, DB_NAME );

//find the revision post ids to be cleaned up
$select_revisions = "SELECT p.id " . 
		"FROM wp_posts p " . 
		"WHERE p.post_type = 'revision'";
$result_select_revisions = $mysqli->query( $select_revisions );
echo $select_revisions . "\n";

$post_ids = array();
while ( $row = $result_select_revisions->fetch_row(  ) ) {
	$post_ids[] = $row[0];
}
$result_select_revisions->close();
echo "Revisions: " . implode($post_ids , ", ") . "\n";

//delete post meta for deleted revisions
$delete_postmeta = "DELETE FROM wp_postmeta WHERE post_id IN (" . implode($post_ids , ", ") . ")" ;
echo $delete_postmeta . " ( Echoed but not queried. )\n";

$delete_posts = "DELETE FROM wp_posts WHERE id IN (" . implode($post_ids , ", ") . ")" ;
echo $delete_posts . " ( Echoed but not queried. )\n";

echo "</pre>";
?>