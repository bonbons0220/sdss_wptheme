<?php

//***********//
// Functions //
//***********//

/*
 * show_leadership: Display the leadership roles
 * Recursive: walks the role tree from the roles with no parents on down.
 */
function show_leadership( $roles , $leaders, $members, $parent_id = null ) {

	//find the ids of the roles with this parent id
	foreach( $roles as $this_role_id=>$this_role ) {
		if ( $parent_id == $this_role['parent_role_id'] ) {
			$the_parents[ $this_role_id ] = $this_role;
		}
	}

	//for each role with this parent id show all the roles that have this parent id
	if ( !empty( $the_parents ) ) {
		echo "<br><ul>\n";
		foreach( $the_parents as $this_parent_role_id=>$this_parent ) {
			echo "<li>" . $this_parent['role'] . ": " ;
			show_leaders( $leaders, $members , $this_parent_role_id );
			show_leadership( $roles , $leaders, $members, $this_parent_role_id );
			echo "</li>\n";
		}
		echo "</ul>\n";
	}
}

/*
 * show_leaders: Show the leaders names, 
 *   separated by "*, " 
 *   adds <sup>*</sup> if mc
 */
function show_leaders( $leaders , $members , $role_id ) {
		$and = "";
		echo "<strong>";
		foreach( $leaders as $this_leader ) {
			if ( ( $this_leader['role_id'] == $role_id) && 
				( $this_leader['current'] ) &&
				( array_key_exists( $this_leader['member_id'] , $members ) ) ) {
					echo $and . $members[ $this_leader[ 'member_id' ] ][ 'fullname' ];
					if ( $members[ $this_leader[ 'member_id' ] ][ 'mc' ] ) echo "<sup>*</sup>";
					$and = ", ";
			}
		}
		echo "</strong>";
}

// get the data from options 
$leaders_data = get_option( 'sdss_leaders' );
$members_data = get_option( 'sdss_members ' );
$roles_data = get_option( 'sdss_roles' );
$leaders_modified = get_option( 'sdss_leaders_modified' );

// Fail Gracefully
if ( empty( $leaders_data ) ) {
	echo "<div class='label label-warning'>No data found</div>";
	return;
}

show_leadership( $roles_data , $leaders_data, $members_data );
echo "<p class='modified'>Last modified: $leaders_modified</p>";
