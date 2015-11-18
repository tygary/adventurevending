<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title><?php wp_title('|', true, 'right'); ?></title>	
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<script src="/lib/js/jquery.min.js"></script>
		<script src="/lib/js/jquery.smint.js"></script>

		        <?php wp_head(); ?>
		</head>
	<body id="page-top" class="index" <?php body_class(); ?>>		
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top <?php if (!is_front_page()) { echo "not_home"; } ?>">
	<div class="header_container">
        <div class="container">		
		<div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
			 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="navbar-header page-scroll">               
				 <?php
              if(get_theme_mod( 'logo_upload')!=''){?>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(get_theme_mod( 'logo_upload')); ?>" alt="logo"></a>
              <?php }else{ ?>
              <h1 style="margin-top:0"><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>
              <?php } ?>
				</div>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				</div>
				 
				
				 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<?php if (is_front_page()) { ?>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="position: relative;">
					<ul class="sf-menu nav navbar-nav navbar-right" id="scrollingMenu">
						<a href="#top" class="subNavBtn">Home</a>
						<a href="#project" class="subNavBtn">The Project</a>
						<a href="#participate" class="subNavBtn">Participate</a>
						<a href="#news" class="subNavBtn">News</a>
						<a href="#us" class="subNavBtn">Us</a>
						<a href="#contact" class="subNavBtn end">Contact Us</a>
					</ul>
				</div>
				<?php } else { ?>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php NovelLitemenu_nav(); ?>
				</div>
				<?php } ?>
				</div>
            <!-- Collect the nav links, forms, and other content for toggling -->
			</div>
        </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
		</div>
    </nav>
	 <?php if (current_user_can('manage_options')) { ?>
	<style>
	.navbar-default {
	margin-top: 32px;
	}
	</style>
	<?php } ?>