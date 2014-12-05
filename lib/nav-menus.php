<?php 
/**
 * Put some help at the top of the admin menus page.
 */
// Catch any boj_action parameter in query string
add_action( 'admin_init', 'sdss_menu_actions' );

// Do requested action 
function sdss_menu_actions() {

    add_action( 'admin_notices', 'sdss_menu_message' );
	return;
}

function sdss_menu_message() {
	if( current_user_can( 'manage_options' ) ) {
		$screen = get_current_screen();
		if ( strpos ( $screen->id , "nav-menus" ) === 0 ) {
			echo "<div class='updated'>";
			echo "<dl><dt>SDSS Menu Names:</dt>\n";
			echo "<dd>";
			echo "Menu names should begin and end with a slash, e.g. /dr12/, /dr12/algorithms/, /surveys/.<br>\n";
			echo "Menu names should be assigned according to the Parent Page you want them to show up on. For example, the menu /dr12/ will show up on all pages that start with /dr12/ including /dr12/, /dr12/data_access/, /dr12/spectro/, etc.<br>\n";
			echo "/dr12/spectro/ will show up on all pages below /dr12/spectro/, such as /dr12/spectro/overview/, etc.\n";
			echo "</dd>\n";
			echo "<dl><dt>SDSS Menu Locations:</dt>\n";
			echo "<dd>";
			echo "Menu locations that start with Secondary Tier will display below the primary navigation. Menu locations that start with Sidebar will display on the right hand sidebar. The order (first, second, etc) is not important.\n";
			echo "</dd>\n";
			echo "<dl><dt>SDSS Menu Styles:</dt>\n";
			echo "<dd>";
			echo "To indent a sidebar menu item, assign it the CSS style 'indent'.\n";
			echo "</dd>\n";
			echo "</div>\n";
		}
	}
}
 
 /**
 * Show menus for sdss theme in the right place at the right time.
 */
 class sdss_nav_menus
{
	private $menus_used = array();
	private $themelocations;
	private $menulocations;	

	public $currentlocation;
	
	/**
	 * Get the theme locations and the menus that are assigned there.
	 */
	function __construct( ) {
	
   		$this->themelocations = get_registered_nav_menus();
		$this->menulocations = get_nav_menu_locations();

		$this->get_menus_used();
}
	
	/**
	 * Show the assigned menu at this location, if the menu name is in the page's hierarchy.
	 */
	public function show( $thislocation ) {
		//see if there are any menus to show in this location.
		if (WP_DEBUG) echo "<!-- DEBUG";
		
		//the menu's slug will start with $thislocation if it's used here
		foreach ($this->menus_used as $this_menu ) {
			
			if ( strpos( $this_menu[0] , $thislocation ) === 0 ) {
				//echo "show $this_menu[0] on pages starting with $this_menu[2]\n";
				if ( strpos( $this->get_permalink() , $this_menu[2] ) === 0 ) {
					if (WP_DEBUG) echo "\n";
					$this->currentlocation  = $this_menu[0];
					echo " true for $this->currentlocation ";
					if (WP_DEBUG) echo "-->\n";
					return true;				
				}
			}
		}
		
		$this->currentlocation  = '';
		echo " false for this page ";
		if (WP_DEBUG) echo "-->\n";
		return false;
	}
	
	function get_menus_used(  )
    {

		//find all the menu locations that have been assigned menu objects
		foreach ( $this->themelocations as $thisslug => $thislocation ) {
			$menuid = $this->menulocations[$thisslug];
			if ($menuid) {
			
				$menuobj = wp_get_nav_menu_object($menuid);
				$this->menus_used[] = array($thisslug, $menuid,  $menuobj->name ) ;
				
			}
		}
		
		return;
	}
		
	//get this page's permalink
	function get_permalink(   )
    {
		$thispage= get_post(  );
		$thispermalink = '/' . $thispage->post_name . '/';
		foreach( get_ancestors( $thispage->ID , 'page' ) as $thisancestorid ) {
			$thisancestor = get_post( $thisancestorid );
			$thispermalink = '/' . $thisancestor->post_name . $thispermalink;		
		}
		
		return $thispermalink;
	}
}	
?>
