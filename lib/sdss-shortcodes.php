<?php 
/**
 * Perform actions for sdss theme.
 */

add_action( 'admin_menu', 'sdss_shortcodes_menu' );

 /**
 * Add shortcodes menu
**/
function sdss_shortcodes_menu() {
	add_theme_page( 'Theme Information', 'SDSS Theme Information',
		'edit_pages', __FILE__, 'sdss_shortcodes_page' );
}

/**
 * Add shortcodes page
**/
function sdss_shortcodes_page() {
?>
<div class="wrap">
<h2 >SDSS Theme Information</h2>
<h3 class="dashicons-before dashicons-menu">SDSS Menus</h3>
<table class="form-table" style="valign:top;">
<tr>
<th valign="top" rowspan="2">Names:</th>
<td>Menu names should begin and end with a slash, e.g. /dr12/, /dr12/algorithms/, /surveys/.</td>
</tr>
<tr>
<td>Menu names should be assigned according to the Parent Page you want them to show up on. For example: 
<ul>
<li>the menu /dr12/ will show up on all pages that start with /dr12/ including /dr12/, /dr12/data_access/, /dr12/spectro/, etc.</li>
<li>/dr12/spectro/ will show up on /dr12/spectro/ and all pages below, such as /dr12/spectro/overview/.</li>
</ul>
</td>
</tr>
<tr>
<th valign="top" rowspan="3">Locations:</th>
<td>Menu locations that start with Secondary Tier will display below the primary navigation.</td>
</tr>
<tr>
<td>Menu locations that start with Sidebar will display on the right hand sidebar. The order (first, second, etc) is not important.</td>
</tr>
<tr>
<td>Menus that start with CPT will display in the sidebar for that Custom Post Type. These may need to be added in the backend as needed.</td>
</tr>
<tr>
<th valign="top">SDSS CSS Styles:</th>
<td><strong>indent</strong>: Indents a sidebar menu item with the CSS style 'indent'.<br>
&nbsp;<br>
<strong>heading</strong>: Create a non-navigable item with a bold font with the CSS style 'heading'.<br>
&nbsp;<br>
<strong>disable</strong>: Use the class 'disable' to disable any menu item.<br>
&nbsp;<br>
<strong>no-overflow</strong>: Surround a wide table with &lt;div class='no-overflow'&gt;&lt;table...&gt;...&lt;/table&gt;&lt;/div&gt; to add a horizontal scrollbar.<br>
&nbsp;<br>
<strong>external</strong>: Add an externl-link type arrow to a link with &lt;a class="external"&gt; or &lt;li class="external"&gt;&lt;a&gt;. Note that this should also cause the link to open in a new window.<br>
&nbsp;<br>
<strong>acknowledgements</strong>: Make the font 70%  smaller with this class. <br>
Example: &lt;span class="acknowledgements"&gt;...&lt;span&gt;<br>
&nbsp;<br>
<strong>highlighter</strong>: Highlight text black on yellow. <br>
Example: &lt;span class="highlighter"&gt;...&lt;span&gt;<br>
&nbsp;<br>
<strong>reference</strong>: Paragraph with hanging indent. <br>
Example: &lt;p class="reference"&gt;...&lt;p&gt;<br>
&nbsp;<br>
<strong>equation</strong>: Center and pad equations. <br>
Example: &lt;p class="equation"&gt;...&lt;p&gt;<br>
&nbsp;<br>
<strong>updateddr13</strong>: adds a 'Updated for DR13' badge to a span. <br>
Example: &lt;span class="updateddr13"&gt;...&lt;span&gt;<br>
&nbsp;<br>
<strong>fordr13</strong>: adds a 'New for DR13' badge to a span. <br>
Example: &lt;span class="fordr13"&gt;...&lt;span&gt;<br>
&nbsp;<br>
<strong>fordr12</strong>: adds an 'Up to DR12' badge to a span. <br>
Example: &lt;span class="fordr12"&gt;...&lt;span&gt;<br>
&nbsp;<br>
<strong>todo</strong>: Highlight a "To Do" note with this class. Can be used with &lt;span&gt;, &lt;div&gt;, or &lt;p&gt;. <br>
Note that when testng goes live, the display for anything with a class "todo" will be set to none, rendering it invisible.<br>
&nbsp;<br>
</td>
</tr>
<tr>
<th valign="top">Menus for Custom Post Types [CPT]</th>
<td>To add a menu to a custom post type, the menu must be called cpt_"cpt-name", and added to the theme initialization file, init.php by the web developer. Use the menus admin interface to assign a menu to that cpt (menus can be assigned to more than one location). </td>
</tr>
</table>

<h3 class="dashicons-before dashicons-media-text">Boilerplate Shortcodes</h3>
<p>Boilerplate shortcodes allow you to input standardized text into page or post content. This is very useful, e.g. for licensing information. </p>
<table class="form-table">
<tr valign="top">
<th>[sdss_boilerplate which="..."]</th>
<td>Use this shortcode to insert boilerplate into a Page or Post content area. </td>
</tr>
<tr valign="top">
<th>Acknowledgements</th>
<td>[sdss_boilerplate which="acknowledgements"]</td>
</tr>
<tr valign="top">
<th>TeX Acknowledgements</th>
<td>[sdss_boilerplate which="tex-acknowledgements"]</td>
</tr>
<tr valign="top">
<th>SDSS Image Use Policy</th>
<td>[sdss_boilerplate which="image-use-policy"]</td>
</tr>
<tr valign="top">
<th>
SDSS Options page
</th>
<td>
View/Edit the boilerplate content on this page. 
</td>
</tr>
<tr valign="top">
<th>
WCK Option Fields Creator > Boilerplate > Edit
</th>
<td>Add new boilerplate to use in the website on this page. <br>
When you give your boilerplate a <strong>Field Title</strong>, a <em>slug</em> will automatically be generated by transforming it to lowercase and replacing all spaces to "-" and removing all special characters. Use the <em>slug</em> as the boilerplate argument for which="slug". <br>
For example, if you create a new boilerplate called <strong>Creative License</strong>, its slug will be <em>creative-license</em>, and the shortcode you would use to add it to your page would be <br/>
[sdss_boilerplate which="creative-license"]
</td>
</tr>
</table>

<h3 class="dashicons-before dashicons-admin-tools">Formatting Shortcodes</h3>
<p>The following shortcodes are currently supported:</p>
<dl><dt>Table of Contents: <br>[SDSS_TOC]</dt>
<dd><em>This currently doesn't not work well and should be replaced with a different tool</em>>Create a table of Contents from h2, h3, h4 selectors. Optionally specify which <strong>selectors</strong> to use, whether to start out <strong>open</strong> (default is closed), and whether to <strong>clear</strong> (display subsequent content below instead of to the right).<br><br>
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
<dt>SDSS Gallery: [SDSS_GALLERY]</dt>
<dd><em>Show Media which have Show In Gallery checked.</em><br>
SDSS_GALLERY can take the following attributes:<br>
tags: A csv list of tags to show. Default=''<br>
order: How to order the images. Default='rand'. Other possible values are 'title', 'date'.
</dd>
<dt>To Top Link: [SDSS_TOTOP]</dt>
<dd>Displays an up arrow and link to top of page. Useful for long pages. Place above headings or at and of page.
</dd>
<dt>Group panel: [SDSS_GROUP][/SDSS_GROUP]</dt>
<dd>SDSS_GROUP can take the following attributes:<br>
columns: default=12<br>
align: default=left<br>
title: default = ''<br>
[SDSS_GROUP columns="10" align="right" title="&gt;h4 id='mystory'&lt;My Story&gt;/h4&lt;"][/SDSS_GROUP]
</dd>
<dt>Story panel: [SDSS_STORY][/SDSS_STORY]</dt>
<dd>Stories can standalone, or can be inside of a group.<br>
Stories cannot be nested inside of other stories.
Stories can take the following attributes:<br>
columns: default=6<br>
align: default=left<br>
title: default = ''<br>
[SDSS_STORY columns="4" align="left" title="&gt;h3 id='yourstory'&lt;Your Story&gt;/h4&lt;"][/SDSS_STORY]
</dd>
<dt>Figure panel: [SDSS_FIGURE][/SDSS_FIGURE]</dt>
<dd>Figures can be standalone, or can be inside of a story or group.<br>
Figures can take the following attributes:<br>
image: default '';
link: default '';
href: default '';
columns: default '6' ;
align: default 'left';
alt: default '';
title: default '':
</dd>
<dt>Show WCK Custom Fields: <br>
[SDSS_SHOW_CFC for='type']</dt>
<dd>Show Custom fields generated by the WordPress Creative Kit.<br>
The function to display the custom fields must be written for each Custom Field Type.<br>
Currently supported Custom Field types:
<ul><li>type='FAST'</li></ul></dd>
<dt>SDSS Technical Publications: [SDSS_TECHPUBS category='Technical Paper in Journal' identifier='SDSS-IV Paper' ]</dt>
<dd>
</dd>
<dt>Show Contact Info: <br>
[SDSS_CONTACT role='role' field='field']</dt>
<dd>Show Contact information for a role. <br>
The 'role' attribute is the position in question. It is case sensitive and must match the role as listed on the Key People page<br>
The 'field' attribute is the type of information to show, and can be either 'fullname' or 'affiliation'.<br>
Example: [SDSS_CONTACT role='Director' field='fullname']
</dd>
</dl>
</div>
<?php
}


/* Add shortcodes 
 *	[SDSS_TOC selectors="h2, h3"] Shows a table of contents containing all h2 and h3 selectors
 *	[SDSS_TOTOP] Shows an up arrow and "Back to top" that takes you to the top of the current page.
 */
add_shortcode('SDSS_TOC','sdss_toc_inject');
add_shortcode('SDSS_TOTOP','sdss_totop_inject');
add_shortcode('SDSS_TODO','sdss_todo_showhide');
add_shortcode('SDSS_GALLERY','sdss_gallery');
add_shortcode('SDSS_FIGURE','sdss_figure_style');
add_shortcode('SDSS_GROUP','sdss_group_style');
add_shortcode('SDSS_STORY','sdss_story_style');
add_shortcode('SDSS_VIDEO','sdss_video_style');
add_shortcode('SDSS_CLEAR','sdss_clear');
add_shortcode('SDSS_SUMMARY','sdss_summary_style');
add_shortcode('SDSS_SHOW_CFC','sdss_show_cfc');
add_shortcode('SDSS_TECHPUBS','sdss_techpubs');
add_shortcode('SDSS_CONTACT','sdss_contact');

add_shortcode('sdss_boilerplate','sdss_boilerplate');

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );

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

	$injection =  sdss_clear() . '<div class="totop-wrapper" >';
	$injection .= '<span class="well well-sm" >';
	$injection .= '<a href="#">';
	$injection .= '<span class="glyphicon glyphicon-circle-arrow-up">';
	$injection .= '</span></a><span><a href="#">Back to Top</a></span>';
	$injection .= '</span></div>' . sdss_clear();

	return $injection;	
}

/*
 * Show the TODO when WP_DEBUG is true. Hide otherwise.
 */
function sdss_todo_showhide( $attr, $content = null ) {
	
	if (empty($content)) return; //no CONTENT

	$injection = ( defined('WP_DEBUG') && constant( 'WP_DEBUG' ) === true ) ?  '<div class="show" >' : '<div class="hide" >';
	$injection .= '<div class="bg-todo">' . do_shortcode($content) . '</div>' . '</div>';
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
	$group_title = (empty($attr['title'])) ? '' : '<div class="panel-heading">' . $attr['title'] . '</div>' ;

	//content
	$group_content = (!empty($content)) ? '<div class="panel-body">' . do_shortcode($content) . '</div>' : '' ;

	//wrap bodies 
	$group_content =  '<div class="panel panel-default sdss-group " >' . $group_title . $group_content . '</div>' ; 
	
	//assemble in wrapper
	$group_content = '<div class="sdss-group-wrapper ' . $group_align . $group_columns  . '" >' . $group_content . '</div>';
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
	$story_title = (empty($attr['title'])) ? '' : '<div class="panel-heading">' . $attr['title'] . '</div>'  ;

	//content
	$story_content = (!empty($content)) ? '<div class="panel-body">' . do_shortcode($content) . '</div>'  : '' ;

	//wrap bodies 
	$story_content =  '<div class="panel panel-default sdss-story " >'  . $story_title . $story_content . '</div>'; 
	
	//assemble in wrapper
	$story_content = '<div class="sdss-wrapper ' . $story_align . $story_columns  . '" >' . $story_content . '</div>' ;
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
	$injection = '<div id="toc-wrapper">';
	$injection .= '<div class="tocify-title">';
	$injection .= '<a class="accordion-toggle ' . $open[0] . ' " data-toggle="collapse" href="#toc-body" ';
	$injection .= 'aria-expanded="true" aria-controls="toc-body">Table&nbsp;of&nbsp;Contents</a>';
	$injection .= '</div>';
	$injection .= '<div id="toc-body" class="collapse ' . $open[1] . ' ">';
	$injection .= '<div id="toc"' . $selectors . ">";
	$injection .= '</div></div></div>';

	return $injection;
	
} 

/*
 * Show the SDSS Option (as defined on SDSS Options page on the admin menu)
 */
function sdss_boilerplate( $attr = array() ) {
	
	if ( empty( $attr[ 'which' ] ) ) return "";
	$which = $attr[ 'which' ];

	if ( strcmp( 'affiliations' , $which ) === 0 ) {
		return sdss_get_project_affiliations( true , 4 );
	}
	
	$options  = get_option( 'sdss_boilerplate' );
	
	$injection = $options[0][$which];
	
	return $injection;	
}

/** 
 * Show the FAST teams, from WordPress Creative Kit Meta Data
 **/
function sdss_show_fast(  ){	

	// Make sure WCK Pro Installed
	if ( !function_exists( 'get_cfc_meta' ) )  return "<!-- WCK Pro not installed. Cannot show FAST Teams -->";
	$result = "";
	//$align=array('pull-left','pull-right');
	$align=array('pull-left','pull-right');
	$i=1;
	
	$this_cfc_all_meta = get_cfc_meta( 'fast-team' );
	if ( !empty( $this_cfc_all_meta ) ) :
		$result = '<div class="fast-sidebar">';
		foreach( $this_cfc_all_meta as $this_cfc_meta) :
			$result .=  "<div class='well well-sm'>";
			$result .= ( strlen( $this_cfc_meta['link'] ) > 0 ) ? 
				"<h3><a href='" . $this_cfc_meta['link'] . "'>" . $this_cfc_meta['title'] . "</a></h3>" : 
				"<h3>" . $this_cfc_meta['title'] . "</h3>" ;
			$result .= ( strlen( $this_cfc_meta['link'] ) > 0 ) ? 
				"<div class='" . $align[$i] . "'><a href='" . $this_cfc_meta['link'] . "'>" :
				"<div class='" . $align[$i] . "'>";
			$result .= wp_get_attachment_image($this_cfc_meta['logo']);
			$result .= ( strlen( $this_cfc_meta['link'] ) > 0 ) ? 
				"</a></div>" :
				"</div>";
			$result .= wpautop ( $this_cfc_meta['description'] );

			$result .= "<div class='clearfix'></div></div>";
		endforeach;
		$result .=  "</div>";
	endif;
	return $result;
}

/** 
 * Show a custom field generated by WordPress Creative Kit
 **/
function sdss_show_cfc( $attr ){
	
	if ( empty( $attr[ 'for' ] ) ) return '';
	
	switch( $attr[ 'for' ] ) {
		// Show the FAST Teams metadata
		case "FAST":
			return sdss_show_fast();
			break;
	}
	
	return $result;
}

// Custom User Associative Array Sorting Function
// Sort technical publications by 
// 		'identifier': reverse alphabetical, will work for SDSS-VIII down to SDSS-I
//		then by 
//		'survey': alphabetical
//
function idies_sort_technical( $a , $b ) {
    if ( $a['identifier'] == $b[ 'identifier' ] ) :
		if ( $a['survey'] == $b[ 'survey' ] ) :
			return ( floatval( $a['arxiv'] ) < floatval( $b[ 'arxiv' ] ) ) ? 1 : -1;	
		else :
			return ( $a['survey'] <  $b[ 'survey' ] ) ? 1 : -1;	
		endif;
	else :
		return ( $a['identifier'] >  $b[ 'identifier' ] ) ? 1 : -1;	
	endif;
}

/** 
 * get_technical
 * Get Technical publications in $category, 
 * with identifier starting with $identifier
 * and list under $h2
 **/
function get_technical( $category, $identifier ){
	$technical_data = array();

	// get the data from options 
	$publications_data = get_option( 'sdss_publications' );
	$publications_modified = get_option( 'sdss_publications_modified' );

	foreach ( $publications_data as $this_pub ) :  

		if ( ( $category == $this_pub[ 'category' ] ) && 
			 ( !strpos( $this_pub[ 'identifier' ] , $identifier ) ) ) {
			$this_pub[ 'identifier' ] = $identifier;
			$technical_data[] = $this_pub;
		}
	endforeach;
	uasort( $technical_data , 'idies_sort_technical' );

	return $technical_data;
}

/** 
 * show_technical
 * Show nicely formatted Technical publications 
 **/
function show_technical( $technical_data, $identifier="" ){
	
	$this_survey = "";
	$result = "";

	foreach ( $technical_data as $this_pub ) : 
	 
		if ( $this_survey == ''  ) {
			$this_survey = $this_pub['survey'];
			$result .= "<h3 id=" . sanitize_title( $identifier . "-" . $this_survey ) . ">" . $this_survey . "</h3>"
				. "<ul class='fa-ul'>";
		} elseif ( $this_survey != $this_pub[ 'survey' ] ) {
			$this_survey = $this_pub['survey'];
			$result .= "</ul>" 
				. "<h3 id=" . sanitize_title( $identifier . "-" . $this_survey ) . ">" . $this_survey . "</h3>"
				. "<ul class='fa-ul'>";
		}
		
		// default url to use for publication title
		$dflt_url = ( !empty( $this_pub[ 'adsabs_url' ] ) ) ? $this_pub[ 'adsabs_url' ] : 
					( !empty( $this_pub[ 'doi_url' ] ) ) ? $this_pub[ 'doi_url' ] : 
					( !empty( $this_pub[ 'arxiv_url' ] ) ) ? $this_pub[ 'arxiv_url' ] : false ;
					
		$result .=  "<li><i class='fa-li fa fa-book'></i>";
		//if ( $dflt_url ) $result .=  "<a target='_blank' href='$dflt_url' >";
		//$result .=  "<strong>" . $this_pub[ 'title' ] . "</strong>";
		//if ( $dflt_url ) $result .=  "</a><br>";
		
		// Deal with v long author list. If more than 3, list 3 and add et al
		$authors = ( substr_count ( $this_pub[ 'authors' ] , ", " ) > 2 ) ?
			implode( ", " , array_slice( explode ( ", " , $this_pub[ 'authors' ] ) , 0 , 3 ) ) . ", <em>et al</em>" :
			( ( substr_count ( $this_pub[ 'authors' ] , ", " ) == 2 ) ?
			implode( ", " , array_slice( explode ( ", " , $this_pub[ 'authors' ] ) , 0 , 3 ) ) :
			$this_pub['authors'] );
		
		$result .=  $authors .  '. ' ;
		$result .=  '"' . $this_pub[ 'title' ] . '", ';
		if ( $this_pub[ 'journal_reference' ]) {
			$result .=  $this_pub[ 'journal_reference' ];
		} else {
			$result .=  '<em>' . $this_pub[ 'status' ] . '</em>';
		}	
		if ( !empty($this_pub[ 'adsabs' ] ) ) $result .=  "; <a href='" . $this_pub[ 'adsabs_url' ] . "' target='_blank'>adsabs:" . $this_pub[ 'adsabs' ] . "</a>";
		if ( !empty($this_pub[ 'doi' ] ))  $result .=  "; <a href='" . $this_pub[ 'doi_url' ] . "' target='_blank'>doi:" . $this_pub[ 'doi' ] . "</a>";
		if ( !empty($this_pub[ 'arxiv_url' ] ) ) $result .=  "; <a href='" . $this_pub[ 'arxiv_url' ] . "' target='_blank'>arXiv:" . $this_pub[ 'arxiv' ] . "</a>";
		$result .=  '.</li>';
	endforeach;
	$result .=  '</ul>';

	return $result;
}

/** 
 * sdss_techpubs
 * Show Technical publications with attributes that start with $identifier
 **/
function sdss_techpubs( $attr ){

	$category = ( empty( $attr[ 'category' ] ) ) ? 'Technical Paper in Journal' : $attr[ 'category' ] ; 
	$identifier = ( empty( $attr[ 'identifier' ] ) ) ? 'SDSS-IV ' : $attr[ 'identifier' ] ; 
	
	$technical_data = get_technical( $category , $identifier );
	if ( empty( $technical_data ) ) return '' ;
	$result = show_technical( $technical_data, $identifier );
	
	return $result;
}

/** 
 * sdss_gallery
 * Show Gallery of SDSS Pics
 **/
function sdss_gallery( $attr ){
	
	$tags = ( empty( $attr[ 'tags' ] ) ) ? '' : $attr[ 'tags' ]; 
	$order = ( empty( $attr[ 'order' ] ) ) ? 'rand' : $attr[ 'order' ]; 
	
	$args = array( 
		'post_type' => 'attachment', 
		'posts_per_page' => -1,
		'orderby' => $order, 
		'post_status' => 'any', 
		'post_parent' => null ,
		'meta_key'         => '_gallery',
		'meta_value'         => 1,
		'tag' 				=> $tags,
	); 
	$attachments = get_posts( $args );
	$result = '';
	?>
	<div class="row">
	<?php
	if ( $attachments ) {
		foreach ( $attachments as $post ) {
			setup_postdata( $post );
			$result .= "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>";
			$result .= "<div class='thumbnail sdss-thumbnail'>";
			$result .= "<div class='caption'><h2 class='text-center'><small>";
			$result .= get_the_title( $post->ID);
			$result .="</small></h2></div>";
			$result .= wp_get_attachment_link( $post->ID, 'thumbnail', true ) ;
			$result .=  get_the_excerpt( $post->ID );
			$result .= "</div></div>";
		}
		wp_reset_postdata();
	}
	?>    
	</div>	
	<?php
	return $result;
}

/** 
 * sdss_contact
 * Show Contact Information for a Key SDSS-IV person.
 **/
function sdss_contact( $attr ){
	
	$result = '';
	if ( empty( $attr[ 'role' ] ) || ( empty( $attr[ 'field' ] ) ) ) return '';
	if ( ! in_array( $attr[ 'field' ] , array( 'fullname' , 'affiliation' ) ) ) return ''; 
	
	$role = $attr[ 'role' ]; 
	$field = $attr[ 'field' ]; 
	
	$role_id=-1;
	$member_id=-1;
	
	$roles_data = get_option( 'sdss_roles' );
	foreach( $roles_data as $this_role_key=>$this_role ) {
		if ( $this_role['role'] == $role ) {
			$role_id = $this_role_key;
			break;
		}
	}
	if ($role_id == -1 ) return "No '$role' found";
	
	$leaders_data = get_option( 'sdss_leaders' );
	foreach( $leaders_data as $this_leader ) {
		if ( ( $this_leader['role_id'] == $role_id) && 
				( $this_leader['current'] ) ) {
			$member_id = $this_leader['member_id'];
			break;
		}
	}
	if ($member_id == -1 ) return "Member not found '$member_id' found";

	$members_data = get_option( 'sdss_members ' );
	$affiliation_data = get_option( 'sdss_affiliation ' );

	if ( array_key_exists( $member_id , $members_data ) ) {
		$fullname = $members_data[$member_id]['fullname'];
		$affiliation_id = $members_data[$member_id]['affiliation_id'];
		$affiliation = ( array_key_exists( $affiliation_id , $affiliation_data ) ) ? $affiliation_data[$affiliation_id]['title'] : '' ;
	} else {
		$fullname = 'TBD';
	}
	return $$field;
}

?>
