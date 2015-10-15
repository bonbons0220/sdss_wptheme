<?php
/*
 * This file contains functions that import the json files for SDSS Personnel into the WP database.
 * 
 */
add_action( 'init', 'sdss_process_jsons' );

function sdss_process_jsons() {
	
	if ( false === ( $option  = get_option( 'sync_json_options' ) ) ) return;
	if ( 0 === strcmp( 'yes' , $option[0]['sync-json'] ) ) {
		
		//loop through the files to load
		$file_prefixes = array( 
			'project', 
			'affiliations', 
			'architects', 
			'coco', 
			'leaders', 
			'mc', 
			'members', 
			'roles',
		);
		foreach( $file_prefixes as $this_prefix ) {
			
			// read data if file exists
			$$this_prefix = @file_get_contents( __DIR__ . "/../../../uploads/" . $this_prefix . ".txt" );
			if ( !(false === ( $$this_prefix ) ) ) {

				$$this_prefix = json_decode( $$this_prefix );
				
				//Delete the files so we don't keep reading them.
				if ( false === unlink( __DIR__ . "/../../../uploads/" . $this_prefix . ".txt" ) ) idies_comment(" Could not remove $this_prefix.txt ");
			
			}

		}
	}

	//participation groups and project affiliations
	if ( !empty( $project ) ) {
	
		foreach( $project->participations as $this_participation ) {
			$participations_data[ $this_participation->participation_id ] = array( 
				'title'=>$this_participation->title, 
			);
			foreach( $this_participation->affiliations as $this_affiliation ) {
				$project_data[ $this_affiliation->affiliation_id ] = array(
					'title' => $this_affiliation->title ,
					'type' => '', 
					'participation_id' => $this_participation->participation_id, 
				);
			}
		}

		foreach( $project->associate_members as $this_affiliation ) {
			$project_data[ $this_affiliation->affiliation_id ] = array(
				'title' => $this_affiliation->title ,
				'type' => 'associate_member', 
				'participation_id' => '', 
			);
		}
		
		foreach( $project->full_members as $this_affiliation ) {
			$project_data[ $this_affiliation->affiliation_id ] = array(
				'title' => $this_affiliation->title ,
				'type' => 'full_member', 
				'participation_id' => '', 
			);
		}
		
		update_option( 'sdss_participations' , $participations_data );
		update_option( 'sdss_project' , $project_data );

	}
	
	// members
	if ( !empty( $members )|| !empty( $coco ) || !empty( $mc ) ) {
		if ( !empty( $members ) ) {
		
			foreach( $members->members as $this_member ) {
				$members_data[ $this_member->member_id ] = array(
					'affiliation_id' => $this_member->affiliation_id ,
					'fullname' => $this_member->fullname , 
					'mc' => false ,
				);
			}
		} else {
		
			//need members data
			$members_data = get_option( 'sdss_members ' );
		}

		// Management Committee (MC)))
		if ( !empty( $mc ) ) {
		
			//clear old mc data
			array_walk( $members_data , create_function( '&$v' , '$v["mc"] = false;' ) );
		
			//enter new mc data
			foreach( $mc->mc as $this_mc ) {
				if ( array_key_exists ( $this_mc->member_id , $members_data ) ) $members_data[ $this_mc->member_id ]['mc'] = true;
			}
		} 
		
		//update members if any of these was uploaded
		update_option( 'sdss_members' , $members_data );
	
	} 

	// All affiliations
	if ( !empty( $affiliations ) ) {
		
		foreach( $affiliations->affiliations as $this_affiliation ) {
			$affiliation_data[ $this_affiliation->affiliation_id ] = array(
					'title'=>$this_affiliation->title,
					'fulladdress'=>$this_affiliation->fulladdress,
					'address'=>$this_affiliation->address,
					'department'=>$this_affiliation->department,
					'identifier'=>$this_affiliation->identifier,
			);
		}
		update_option( 'sdss_affiliation' , $affiliation_data );
	}

	// Collaboration Council
	if ( !empty( $coco ) ) {
		
		$coco_data['spokesperson']['member_id'] = $coco->spokesperson->member_id;
		$coco_data['spokesperson']['affiliation_id'] = @$coco->spokesperson->affiliation_id;
		$coco_data['spokesperson']['participation_id'] = @$coco->spokesperson->participation_id;
		
		foreach( $coco->coco as $this_coco ) {
			$coco_data[ $this_coco->member_id ] = array(
					'affiliation_id'=>$this_coco->affiliation_id,
					'participation_id'=>$this_coco->participation_id,
			);
		}
		update_option( 'sdss_coco' , $coco_data );
	}

	// Architects
	if ( !empty( $architects ) ) {
		foreach( $architects->architects as $this_architect ) {
			$architects_data[ $this_architect->member_id ] = array(
				'comment' => $this_architect->comment ,
			);
		}
		update_option( 'sdss_architects' , $architects_data );
	}

	// Roles
	if ( !empty( $roles ) ) {
		foreach( $roles->roles as $this_role ) {
			$roles_data[ $this_role->role_id ] = array(
				'parent_role_id' => $this_role->parent_role_id ,
				'role' => $this_role->role ,
			);
		}
		update_option( 'sdss_roles' , $roles_data );
	}

	// Leaders
	if ( !empty( $leaders ) ) {
		foreach( $leaders->leaders as $this_leader ) {
			$leaders_data[  ] = array(
				'role_id' => $this_leader->role_id ,
				'member_id' => $this_leader->member_id ,
				'current' => $this_leader->current ,
				'chair' => $this_leader->chair ,
			);
		}
		update_option( 'sdss_leaders' , $leaders_data );
	}		
}
