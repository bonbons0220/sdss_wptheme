<?php 
function header_search_form( $form , $context = '') {

	$home_url = $_SERVER['HTTP_HOST']  . '/' . $context;
	$action_url = 'http://' . $home_url;
	//$home_url = home_url();
	$search_query = is_search() ? get_search_query() : '';
	$placeholder = _('Search');
	$label = _('Search for:');
	
	$form = <<<EOT
	<div class="row"><div class="col-xs-12  align-right">
	<form role="search" method="get" class="search-form form-inline" action="$action_url">
		<div class="input-group">
			<input type="search" value="$search_query" name="s" class="search-field form-control" placeholder="$placeholder on $home_url">
			<label class="hide">$label</label>
			<span class="input-group-btn">
			<button type="submit" class="search-submit btn btn-default">$placeholder</button>
			</span>
		</div>
	</form>
	</div></div>
EOT;
	return $form;
}

add_filter( 'get_search_form', 'header_search_form' , 10 , 1 );