<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		
		<title><?php wp_title(''); ?></title>
		
		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<!-- <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico"> -->
				
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
	</head>
	
	<body <?php body_class(); ?>>
		<a name="top"></a>

		<?php // set some constants for use in header
			$sitename = get_bloginfo('name');
			$homeurl = get_home_url();
			$styledir = get_bloginfo('stylesheet_directory');
		?>
	
		<div id="container">
			
			<header class="header" role="banner">

				<!-- ORANGE UT LOGO & MENU BAR -->
				<!-- THE CODE/lOGO CAN BE EDITED IN HEADER.PHP, 
				THE MENU CONTENTS IN WP CONTROL PANEL > HEADER -->
				<div class="ut-header">
					<script type="text/javascript">



</script>
					<div class="wrap clearfix">
						<a href="#skipnav" class="screen-reader-shortcut">Skip Navigation</a>
						<a id="ut-logo" href="http://www.utexas.edu/" title="The University of Texas at Austin" rel="nofollow"><img src="<?php echo $styledir; ?>/library/images/logo-ut.png" alt="The University of Texas at Austin" /></a>

						<div class="searchBox">
		                <a id="searchsite" name="searchsite"></a>
		               <!--  <form style="margin: 0px; padding: 0px;" id="searchform" action="http://www.google.com/u/universityoftexas" method="get">
		                    <label for="q" class="screen-reader-shortcut">Search</label> 
		                    <input type="text" class="text_input" value="Search the School of Social Work" name="q" id="q" onfocus="this.value=''" onblur="javascript:if(this.value.length === 0){this.value='Search the School of Social Work'}" />
		                    <input type="submit" class="button search black square" id="searchsubmit" value="Search" />
		                    <input type="hidden" value="www.utexas.edu/ssw" name="domains" />
		                    <input type="hidden" checked="checked" value="www.utexas.edu/ssw" name="sitesearch" /> 
		                </form>-->

		                <!-- Include Javascript/No Javascript Google Custom Search Forms -->

<script type="text/javascript">
document.write(' <form style="margin: 0px; padding: 0px;" name="cse_searchbox" action="/ssw/search-results" method="get" id="cse_searchbox">');
//document.write(' <fieldset style="margin: 0px; padding: 0px; border:0;" >');
document.write(' <label for="cseq" class="screen-reader-shortcut">Search THIS SITE</label>');
document.write(' <input type="hidden" name="cx" value="006470498568929423894:etsxpcor8wm" />');
document.write(' <input type="hidden" name="cof" value="FORID:10" />');
document.write(' <input type="hidden" name="as_sitesearch" value="www.utexas.edu/ssw" />');
document.write(' <input type="text" class="text_input"  name="q" value="" placeholder="Search the School of Social Work" id="cseq"  />');
document.write(' <input type="submit" class="button search black square" name="sa" value="Search" />');
//document.write(' </fieldset>');
document.write(' </form>');

</script>
<noscript>
<!-- Begin Disabled JavaScript Google CSE Search Form -->
<!-- Contents shown only when JavaScript is disabled -->
<form name="cse_searchbox_nonjs" action="http://www.google.com/cse" id="cse_searchbox_nonjs"> 
<label for="cseq" class="screen-reader-shortcut">Search the School of Social Work</label>
<input type="hidden" name="cx" value="006470498568929423894:etsxpcor8wm" />
<input type="hidden" name="as_sitesearch" value="www.utexas.edu/ssw" />
<input type="text" name="q" class="text_input" value="" value="" placeholder="Search the School of Social Work" id="cseq" />
<input type="submit" class="button search black square" name="sa" value="Search" />
</form>
</noscript>
		            	</div>





					</div><!-- .wrap.clearfix -->


				</div>
			
				<!-- SSW LOGO, MENU(S) AND SEARCH -->
				<div id="inner-header" class="wrap clearfix">
					
					<a id="logo" href="<?php echo $homeurl; ?>" title="<?php echo $sitename; ?>" rel="nofollow"><img src="<?php echo $styledir; ?>/library/images/logo-ssw-new-blu.png" alt="<?php echo $sitename; ?>" /></a>
					
					

					<nav role="navigation">
						<?php echo bones_ancillary_nav(); ?>
						<?php echo bones_main_nav(); ?>
					</nav>
					<a name="skipnav"></a>
				</div> <!-- end #inner-header -->
				
			</header> <!-- end header -->