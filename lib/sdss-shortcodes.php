<?php 
/**
 * Perform actions for sdss theme.
 */

 add_action( 'admin_menu', 'sdss_shortcodes_menu' );

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


/* Add shortcodes 
 *	[SDSS_TOC selectors="h2, h3"] Shows a table of contents containing all h2 and h3 selectors
 *	[SDSS_TOTOP] Shows an up arrow and "Back to top" that takes you to the top of the current page.
 */
add_shortcode('SDSS_TOC','sdss_toc_inject');
add_shortcode('SDSS_TOTOP','sdss_totop_inject');
add_shortcode('SDSS_TODO','sdss_todo_showhide');
add_shortcode('SDSS_FIGURE','sdss_figure_style');
add_shortcode('SDSS_GROUP','sdss_group_style');
add_shortcode('SDSS_STORY','sdss_story_style');
add_shortcode('SDSS_VIDEO','sdss_video_style');
add_shortcode('SDSS_CLEAR','sdss_clear');
add_shortcode('SDSS_SUMMARY','sdss_summary_style');

/**
 * Wrap a story in a panel, align left or right, set max width and title
 **/
function sdss_clear(  ){
	return '<div class="clearfix"></div>';
}

/*
 * Put in a button that takes you to the top of the page.
 */
function sdss_totop_inject(  ) {

	$injection =  sdss_clear() . '<div class="totop-wrapper" >'."\n";
	$injection .= '<span class="well well-sm" >'."\n";
	$injection .= '<a href="#">'."\n";
	$injection .= '<span class="glyphicon glyphicon-circle-arrow-up">'."\n";
	$injection .= '</span></a><span><a href="#">Back to Top</a></span>'."\n";
	$injection .= '</span></div>' . sdss_clear();

	return $injection;	
}

/*
 * Show the TODO when WP_DEBUG is true. Hide otherwise.
 */
function sdss_todo_showhide( $attr, $content = null ) {
	
	if (empty($content)) return; //no CONTENT

	$injection = ( defined('WP_DEBUG') && constant( 'WP_DEBUG' ) === true ) ?  '<div class="show" >' . "\n" : '<div class="hide" >' . "\n";
	$injection .= '<div class="bg-todo">' . do_shortcode($content) . '</div>' . "\n" . '</div>';
	return $injection;	
}

/**
 * Wrap a story in a panel, align left or right, set max width and title
 **/
function sdss_video_style( $attr, $content = null ){

	if (empty($content)) $content = "No Content"; //no video?

	$num_columns =  (empty($attr['columns'])) ? 12 : intval($attr['columns']) ;
	$video_columns =  ' col-md-' . $num_columns . ' ' . ' col-xs-12 ' ;
	$video_align = (empty($attr['align'])) ? '' : ' align' . esc_attr($attr['align']) . ' ' ;
	$video_title = (empty($attr['title'])) ? '' : '<div class="panel-heading">' . $attr['title'] . '</div>' ;
	$video_content = '<div class="responsive-video"><iframe src="' . $content . '" width="100%" height="auto" frameborder="0" allowfullscreen></iframe></div>';
	$video_content =  '<div class="panel-body">' . $video_content . '</div>';
	$video_content =  '<div class="panel panel-default sdss-wrapper ' . $video_align . $video_columns . '">' . $video_title . $video_content . '</div>';
	
	return $video_content;
}

/** 
 * Wrap a group in a panel, align left or right, set max width and title
 **/
function sdss_group_style( $attr, $content = null ){
	
	if (empty($content)) $content = "No Content"; //no group?
	
	//formatting width and alignment
	$num_columns =  (empty($attr['columns'])) ? 12 : intval($attr['columns']) ;
	$group_columns =  ' col-md-' . $num_columns . ' col-xs-12 ' ;	
	$group_align = (empty($attr['align'])) ? '' : ' align' . esc_attr($attr['align']) . ' ' ;
	
	//title/heading - can contain html like <h3></h3> etc
	$group_title = (empty($attr['title'])) ? '' : '<div class="panel-heading">' . $attr['title'] . '</div>' . "\n" ;

	//content
	$group_content = (!empty($content)) ? '<div class="panel-body">' . "\n" . do_shortcode($content) . '</div>' . "\n" : '' ;

	//wrap bodies 
	$group_content =  '<div class="panel panel-default sdss-group " >' . "\n" . $group_title . $group_content . '</div>' . "\n" ; 
	
	//assemble in wrapper
	$group_content = '<div class="sdss-group-wrapper ' . $group_align . $group_columns  . '" >' . "\n" . $group_content . '</div>' . "\n";
	return $group_content;
	
}

/** 
 * Wrap a story in a panel, align left or right, set max width and title
 **/
function sdss_story_style( $attr, $content = null ){
	
	if (empty($content)) $content = "No Content"; //no story?
	
	//formatting width and alignment
	$num_columns =  (empty($attr['columns'])) ? 6 : intval($attr['columns']) ;
	$story_columns =  ' col-md-' . $num_columns . ' col-xs-12 ' ;	
	$story_align = (empty($attr['align'])) ? '' : ' sdss-story-' . esc_attr($attr['align']) . ' ' ;
	
	//title/heading - can contain html like <h3></h3> etc
	$story_title = (empty($attr['title'])) ? '' : '<div class="panel-heading">' . $attr['title'] . '</div>' . "\n"  ;

	//content
	$story_content = (!empty($content)) ? '<div class="panel-body">' . "\n"  . do_shortcode($content) . '</div>' . "\n"  : '' ;

	//wrap bodies 
	$story_content =  '<div class="panel panel-default sdss-story " >' . "\n"  . $story_title . $story_content . '</div>' . "\n"; 
	
	//assemble in wrapper
	$story_content = '<div class="sdss-wrapper ' . $story_align . $story_columns  . '" >' . "\n"  . $story_content . '</div>' . "\n" ;
	return $story_content;
	
}

/** 
 * Wrap a summary in a panel, align left or right, set max width and title
 **/
function sdss_summary_style( $attr, $content = null ){
	
	if (empty($content)) $content = "No Content"; //no story?
	
	//content
	//$summary_content = '<div class="sdss-summary col-xs-11 col-xs-offset-0 col-md-10 col-md-offset-1">' . do_shortcode($content) . '</div>' ;
	$summary_content = '<div>' . do_shortcode($content) . '</div>' ;
	$summary_content .= sdss_clear() ;
	
	return $summary_content;
	
}

function sdss_figure_style( $attr, $content = null ){
	
	//allow image to be called src
	$thisimage = (!empty($attr['image'])) ? $attr['image'] : ((!empty($attr['src'])) ? $attr['src'] : '') ;
		
	//allow link to be called href
	$thislink = (!empty($attr['link'])) ? $attr['link'] : ((!empty($attr['href'])) ? $attr['href'] : '') ;
	
	//set alignment, number of columns and alt text
	$num_columns =  (empty($attr['columns'])) ? 6 : intval($attr['columns']) ;
	$fig_columns =  ' col-md-' . $num_columns . ' col-xs-12 ' ;	
	$fig_align = (empty($attr['align'])) ? '' : ' sdss-fig-' . esc_attr($attr['align']) . ' ' ;
	$fig_alt = (!empty($attr['alt'])) ? ' alt="' . esc_attr($attr['alt']) . '" ' : ' alt="' . esc_attr($content) . '" ';
	
	//wrap title
	$fig_title = (empty($attr['title'])) ? '' : '<div class="panel-heading">' . $attr['title'] . '</div>' ;
	
	//set up image tag
	$fig_content = (!empty($thisimage)) ? '<img class="img-responsive" src="' . $thisimage . '" '  . $fig_alt .  '/>' :  '' ;
	$fig_content = (!empty($thislink)) ? '<a href="' . $thislink . '" target="_blank" >' . $fig_content . '</a>' : $fig_content ;
	
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
		foreach ($selectors as $thisselector) $thisselector = trim($thisselector);
		$selectors = ' class="toc-' . implode("-",$selectors) . '" ';
	}
	
	//set up string variables for opened/closed table of contents, and clear afterwards
	//$open = (in_array('open',$attr)) ? array( '' , 'in' ) : array( 'collapsed' , '') ;
	//$clear = (in_array('clear',$attr)) ? '<span class="clearfix"></span>' : '' ;
	$open = (empty($attr['open'])) ? array( 'collapsed' , '') : array( '' , 'in' ) ;
	$injection = '<div id="toc-wrapper">'."\n";
	$injection .= '<div class="tocify-title">'."\n";
	$injection .= '<a class="accordion-toggle ' . $open[0] . ' " data-toggle="collapse" href="#toc-body" ';
	$injection .= 'aria-expanded="true" aria-controls="toc-body">Table&nbsp;of&nbsp;Contents</a>'."\n";
	$injection .= '</div>'."\n";
	$injection .= '<div id="toc-body" class="collapse ' . $open[1] . ' ">'."\n";
	$injection .= '<div id="toc"' . $selectors . ">";
	$injection .= '</div></div></div>';

	return $injection;
	
} 
?>
