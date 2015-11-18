<?php
/*
  Template Name: Blog Page
 */
?>
<?php get_header(); ?>
<div class="page_heading_container" <?php if (NovelLite_get_option('NovelLite_headbg') != '') { ?>
 style="background: url(<?php echo NovelLite_get_option('NovelLite_headbg'); ?>) no-repeat center;"
 <?php } else {} ?>>
  <div class="container">
        <div class="row">
		<div class="col-md-12">
<div class="page_heading_content">
<h1><?php the_title(); ?></h1>
</div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<div class="page-container">
    <div class="container">
        <div class="row">
            <div class="page-content">
                <div class="col-md-9">
                    <div class="content-bar gallery"> 
                       <!-- *** Post loop starts *** -->
                    <?php
                    get_template_part('loop', 'index');
                    ?> 

                    <!-- *** Post loop ends*** -->
                    <div class="clearfix"></div>
                    <nav id="nav-single"> <span class="nav-previous">
                            <?php
                            next_posts_link(__('&larr; Older posts', 'novellite'));
                            ?>
                        </span> <span class="nav-next">
                            <?php
                            previous_posts_link(__('Newer posts &rarr;', 'novellite'));
                            ?>
                        </span> </nav>
                    <div class="clearfix"></div>
                    </div>
                </div>
				<div class="col-md-3">
		<!--Start Sidebar-->
		<?php get_sidebar(); ?>
		<!--End Sidebar-->
		</div> 
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>