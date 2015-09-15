<?php get_template_part('templates/page', 'header'); ?>
<div class="row">
	<div class="col-xs-12"><img src="http://test.sdss.org/wp-content/uploads/2014/05/segue.jpg" class="img img-responsive" /></div>
	<div class="col-xs-12"><div class="alert alert-default"><p class="lead">Your chances of getting to the right place if you leave Earth on a random trajectory are miniscule. Luckily your chances of getting to the right place on this website are much higher. </p></div></div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="alert alert-success"><h4>It looks like you missed your destination! </h4>
		<p>Sorry, we couldn't find the page you were looking for. Please try searching our website(s) for what you need.</p></div>
		<?php get_search_form( true , 'dr13' ); ?><br />
	</div>
	<div class="col-sm-6">
		<div class="alert alert-info">Or email <a href="mailto:webmaster@sdss.org">webmaster@sdss.org</a> for more help.</div>
	</div>
</div>