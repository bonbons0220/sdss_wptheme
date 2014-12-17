<?php 
/**
 * Perform actions for sdss theme.
 */
add_action( 'admin_init', 'sdss_menu_actions' );
add_action( 'admin_menu', 'sdss_shortcodes_menu' );

/**
 * Add notices 
**/ 
function sdss_menu_actions() {

    add_action( 'admin_notices', 'sdss_menu_message' );
	return;
}

/**
 * Add shortcodes menu
**/
function sdss_shortcodes_menu() {
	add_theme_page( 'Theme Information', 'SDSS Theme Information Page',
		'edit_pages', __FILE__, 'sdss_shortcodes_page' );
}

/**
 * Add shortcodes page
**/
function sdss_shortcodes_page() {
?>
<h2>SDSS Theme Information Page</h2>
<h3>Menus</h3>
<dl><dt>SDSS Menu Names:</dt>
<dd>Menu names should begin and end with a slash, e.g. /dr12/, /dr12/algorithms/, /surveys/.<br>
Menu names should be assigned according to the Parent Page you want them to show up on. For example, the menu /dr12/ will show up on all pages that start with /dr12/ including /dr12/, /dr12/data_access/, /dr12/spectro/, etc.<br>
/dr12/spectro/ will show up on /dr12/spectro/ and all pages below, such as /dr12/spectro/overview/.
</dd>
<dl><dt>SDSS Menu Locations:</dt>
<dd>
Menu locations that start with Secondary Tier will display below the primary navigation. Menu locations that start with Sidebar will display on the right hand sidebar. The order (first, second, etc) is not important.
</dd>
<dl><dt>SDSS Menu Styles:</dt>
<dd><strong>indent</strong><br>
To indent a sidebar menu item, assign it the CSS style 'indent'.
</dd>
<dd><strong>heading</strong><br>
To create a non-navigable item, with a slightly heavier font, assign it the CSS style 'heading'.
</dd>
</dl>
<h3>Shortcodes</h3>
<p>The following shortcodes are currently supported:</p>
<dl><dt>Table of Contents: <br>[SDSS_TOC]</dt>
<dd>Create a table of Contents from h2, h3, h4 selectors. Optionally specify which <strong>selectors</strong> to use, whether to start out <strong>open</strong> (default is closed), and whether to <strong>clear</strong> (display subsequent content below instead of to the right).<br><br>
<strong>Examples of usage: </strong>
<ul>
<li>[SDSS_TOC]: default. Uses h2, h3, h4 (default) selectors. Initially closed. Wrap following text to the right. </li>
<li>[SDSS_TOC selectors="h2"]: Use only h2 selector. Initially closed. Wrap following text to the right. </li>
<li>[SDSS_TOC selectors="h2,h3" open]: Use h2 and h3 selectors. Initially open. Wrap following text to the right. </li>
<li>[SDSS_TOC clear]: Use default selectors. Initially closed. Subsequent content displays below TOC. </li>
</ul>
<strong>Notes: </strong>
<ul>
<li>Do not include spaces in the list of selectors.</li>
<li>Place this directly below a heading and in front of and on same line as a paragraph. If precedes a paragraph, use 'clear' option.</li>
</ul>
</dd>
<dt>To Top Link: [SDSS_TOTOP]</dt>
<dd>Displays an up arrow and link to top of page. Useful for long pages. Place above headings or at and of page.
</dd>
<dt>PANELS can be nested<br>
Story panel: <br>
[SDSS_STORY]<br>
[/SDSS_STORY]</dt>
<dd>Put a title above and a frame around a story. Specify # columns.
</dd>
<dt>Figure panel: <br>
[SDSS_FIGURE]<br>
[/SDSS_FIGURE]</dt>
<dd>Put a title above and frame around and a caption below a figure. Specify # columns.
</dd>
</dl>

<?php
}

/**
 * Add notice to menu page
**/ 
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
		
		//the menu's slug will start with $thislocation if it's used here
		foreach ($this->menus_used as $this_menu ) {
			
			if ( strpos( $this_menu[0] , $thislocation ) === 0 ) {
				if ( strpos( $this->get_permalink() , $this_menu[2] ) === 0 ) {
					$this->currentlocation  = $this_menu[0];
					return true;				
				}
			}
		}
		
		$this->currentlocation  = '';
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

//Add menu and nav shortcode support
//add_action( 'after_setup_theme', 'sdss_nav_shortcode_setup' );

/* Add shortcodes 
 *	[SDSS_TOC selectors="h2, h3"] Shows a table of contents containing all h2 and h3 selectors
 *	[SDSS_TOTOP] Shows an up arrow and "Back to top" that takes you to the top of the current page.
 */
//function sdss_nav_shortcode_setup() {
add_shortcode('SDSS_TOC','sdss_toc_inject');
add_shortcode('SDSS_TOTOP','sdss_totop_inject');
add_shortcode('SDSS_FIGURE','sdss_figure_style');
add_shortcode('SDSS_STORY','sdss_story_style');
add_shortcode('SDSS_VIDEO','sdss_video_style');
add_shortcode('SDSS_CLEAR','sdss_clear');
//}

function sdss_totop_inject(  ) {

	$injection = '<div class="totop-wrapper" >'."\n";
	$injection .= '<span class="well well-sm" >'."\n";
	$injection .= '<a href="#">'."\n";
	$injection .= '<span class="glyphicon glyphicon-circle-arrow-up">'."\n";
	$injection .= '</span></a><span><a href="#">Back to Top</a></span>'."\n";
	$injection .= '</span></div>'."\n";

	return $injection;	
}

/**
 * Wrap a story in a panel, align left or right, set max width and title
 **/
function sdss_clear(  ){
	return '<div class="clearfix"></div>';
}

/**
 * Wrap a story in a panel, align left or right, set max width and title
 **/
function sdss_video_style( $attr, $content = null ){

	if (empty($content)) $content = "No Content"; //no video?

	$video_content = '<div class="visible-lg"><iframe width="1136px" height="639px" src="' . $content . '" frameborder="0" allowfullscreen></iframe></div>'."\n";
	$video_content .= '<div class="visible-md"><iframe width="938px" height="528px" src="' . $content . '" frameborder="0" allowfullscreen></iframe></div>'."\n";
	$video_content .= '
	<div class="visible-sm"><iframe width="720px" height="405px" src="' . $content . '" frameborder="0" allowfullscreen></iframe></div>'."\n";
	$video_content .= '
	<div class="visible-xs"><iframe width="400px" height="225px" src="' . $content . '" frameborder="0" allowfullscreen></iframe></div>'."\n";
	
	return $video_content;
}

/**
 * Wrap a story in a panel, align left or right, set max width and title
 **/
function sdss_story_style( $attr, $content = null ){
	
	if (empty($content)) $content = "No Content"; //no story?
	
	//formatting width and alignment
	$num_columns =  (empty($attr['columns'])) ? 6 : intval($attr['columns']) ;
	$story_columns =  ' col-md-' . $num_columns . ' ' ;
	$story_columns .= (4 >= $num_columns ) ? ' col-sm-6 ' : '' ;	
	$story_columns .= ' col-xs-12 ' ;	
	$story_align = (empty($attr['align'])) ? '' : ' sdss-story-' . esc_attr($attr['align']) . ' ' ;
	
	//title/heading - can contain html like <h3></h3> etc
	$story_title = (empty($attr['title'])) ? '' : '<div class="panel-heading">' . $attr['title'] . '</div>' ;
	//$story_title = (empty($attr['title'])) ? '' : $attr['title'] ;

	//content
	$story_content = (!empty($content)) ? '<div class="panel-body">' . do_shortcode($content) . '</div>' : '' ;

	//wrap bodies 
	$story_content =  '<div class="panel panel-default sdss-story " >' . $story_title . $story_content . '</div>' ; 
	
	//assemble in wrapper
	$story_content = '<div class="sdss-wrapper ' . $story_align . $story_columns  . '" >' . $story_content . '</div>';
	return $story_content;
	
}

function sdss_figure_style( $attr, $content = null ){
	
	if (empty($attr['image'])) return $content; //no image ?!?!?
	
	//set alignment, number of columns and alt text
	$num_columns =  (empty($attr['columns'])) ? 6 : intval($attr['columns']) ;
	$fig_columns =  ' col-md-' . $num_columns . ' ' ;
	$fig_columns .= (4 >= $num_columns ) ? ' col-sm-6 ' : '' ;	
	$fig_columns .= ' col-xs-12 ' ;	
	$fig_align = (empty($attr['align'])) ? '' : ' sdss-fig-' . esc_attr($attr['align']) . ' ' ;
	$fig_alt = (!empty($attr['alt'])) ? ' alt="' . esc_attr($attr['alt']) . '" ' : ' alt="' . esc_attr($content) . '" ';
	
	//wrap title
	$fig_title = (empty($attr['title'])) ? '' : '<div class="panel-heading">' . $attr['title'] . '</div>' ;
	
	//set up image tag
	$fig_content = '<img class="img-responsive" src="' . $attr['image'] . '" '  . $fig_alt .  '/>';
	$fig_content = (!empty($attr['link'])) ? '<a href="' . $attr['link'] . '" target="_blank" >' . $fig_content . '</a>' : $fig_content ;
	
	//wrap bodies 
	$fig_content = '<div class="panel-body">' . $fig_content . '</div>' ;
	$fig_caption = (!empty($content)) ? '<div class="panel-body caption">' . $content . '</div>' : '' ;
	$fig_content = '<div class="panel panel-default sdss-figure" >' . $fig_title . $fig_content  . $fig_caption  . '</div>' ; 
	
	//assemble in wrapper
	$fig_content = '<div class="sdss-wrapper ' . $fig_align . $fig_columns . '">' . $fig_content . '</div>';
	return $fig_content;
	
}

function sdss_toc_inject( $attr = array()){

	if (empty($attr['selectors'])) {
		$selectors = '' ;
	} else {
		$selectors = explode(",",$attr['selectors']);
		foreach ($selector as $thisselector) $thisselector = trim($thisselector);
		$selectors = ' class="toc-' . implode("-",$selectors) . '" ';
	}
	
	//set up string variables for opened/closed table of contents, and clear afterwards
	$open = (in_array('open',$attr)) ? array( '' , 'in' ) : array( 'collapsed' , '') ;
	$clear = (in_array('clear',$attr)) ? '<span class="clearfix"></span>' : '' ;
	$injection = '<div id="toc-wrapper">'."\n";
	$injection .= '<div class="tocify-title">'."\n";
	$injection .= '<a class="accordion-toggle ' . $open[0] . ' " data-toggle="collapse" href="#toc-body" ';
	$injection .= 'aria-expanded="true" aria-controls="toc-body">Table&nbsp;of&nbsp;Contents</a>'."\n";
	$injection .= '</div>'."\n";
	$injection .= '<div id="toc-body" class="collapse ' . $open[1] . ' ">'."\n";
	$injection .= '<div id="toc"' . $selectors . ">";
	$injection .= '</div></div></div>' . $clear;

	return $injection;
	
} 
?>
