<?php
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query. 
* E.g., it puts together the home page when no home.php file exists.
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
*/
?>
<?php get_header(); ?> 
    <!-- Header -->
    <div id="slides_full" class="NovelLite_slider">	
<input type="hidden" id="txt_slidespeed" value="<?php if (get_theme_mod('NovelLite_slider_speed','') != '') { echo stripslashes(get_theme_mod('NovelLite_slider_speed')); } else { ?>3000<?php } ?>"/>
    <ul class="slides-container">
        <li>
            <?php if (get_theme_mod('first_slider_image','') != '') { ?>
                <a href="<?php
                if (get_theme_mod('first_slider_link','') != '') {
                    echo get_theme_mod('first_slider_link');
                }
                ?>" >
                    <img  src="<?php echo get_theme_mod('first_slider_image'); ?>" alt="Slide Image 1"/></a>
            <?php } else { ?>
                <img  src="<?php echo get_template_directory_uri(); ?>/images/slider1.jpg" alt="Slide Image 1"/>
            <?php } ?>
			<div class="slider_overlay"></div>
            <div class="container container_caption">
                <?php if (get_theme_mod('first_slider_heading','') != '') { ?>
                    <h1><a href="<?php
                        if (get_theme_mod('first_slider_link','') != '') {
                            echo get_theme_mod('first_slider_link');
                        }
                        ?>"><?php echo get_theme_mod('first_slider_heading'); ?></a></h1>
                    <?php } else { ?>
                    <h1>Business Theme</h1>
                <?php } ?> 
				<div class="clearfix"></div>
                <?php if (get_theme_mod('first_slider_desc') != '') { ?>
                    <p>					   
                        <?php echo get_theme_mod('first_slider_desc'); ?>
                    </p>
                <?php } else { ?>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br/>Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                <?php } ?>
				
				
				<div class="clearfix"></div>
				<div class="main-slider-button">
			<?php if (get_theme_mod('first_button_text','') != '') { ?>
				<a href="<?php
                                if (get_theme_mod('first_button_link','') != '') {
                                    echo stripslashes(get_theme_mod('first_button_link'));
                                } else {
                                    echo "#";
                                }
                                ?>" class="theme-slider-button">
				<?php echo stripslashes(get_theme_mod('first_button_text')); ?>
				
				</a>
				<?php } else { ?>
				<a href="#" class="theme-slider-button">Buy Now!</a>
				<?php } ?>
				</div>	
            </div>
        </li>
        <?php if (get_theme_mod('second_slider_image','') != '') { ?>
            <li>
                <?php if (get_theme_mod('second_slider_image','') != '') { ?>
                    <a href="<?php
                    if (get_theme_mod('second_slider_link','') != '') {
                        echo get_theme_mod('second_slider_link');
                    }
                    ?>" >
                        <img  src="<?php echo get_theme_mod('second_slider_image'); ?>" alt="Slide Image 2"/></a>
                <?php } else { ?>
                <?php } ?>
                <?php if (get_theme_mod('second_slider_heading','') != '') { ?>
                    <div class="container container_caption">
                        <?php if (get_theme_mod('second_slider_heading','') != '') { ?>
                            <h1><a href="<?php
                                if (get_theme_mod('second_slider_link','') != '') {
                                    echo get_theme_mod('second_slider_link');
                                }
                                ?>"><?php echo stripslashes(get_theme_mod('second_slider_heading')); ?></a></h1>
								<div class="clearfix"></div>
                                <?php
                            } else {
                                
                            }
                            ?>
                            <?php if (get_theme_mod('second_slider_desc','') != '') { ?>
                            <p>					   
                                <?php echo stripslashes(get_theme_mod('second_slider_desc')); ?>
                            </p>
                            <?php
                        } else {
                            
                        }
                        ?>	
<div class="clearfix"></div>
				<div class="main-slider-button">
			<?php if (get_theme_mod('second_button_text','') != '') { ?>
				<a href="<?php
                                if (get_theme_mod('second_button_link','') != '') {
                                    echo stripslashes(get_theme_mod('second_button_link'));
                                } else {
                                    echo "#";
                                }
                                ?>" class="theme-slider-button">
				<?php echo stripslashes(get_theme_mod('second_button_text')); ?>
				
				</a>
				<?php } else { ?>
				<a href="#" class="theme-slider-button">Buy Now!</a>
				<?php } ?>
				</div>
 </div>
                <?php } ?>
				<div class="slider_overlay"></div>
            </li>
        <?php } ?>
    </ul>
    <nav class="slides-navigation">
        <a href="#" class="next">Next</a>
        <a href="#" class="prev">Previous</a>
    </nav>
</div>
    <!-- Services Section -->
    <section id="section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
				<?php if (get_theme_mod('col_heading','') != '') { ?>
						<h2 class="section-heading"><?php echo stripslashes(get_theme_mod('col_heading')); ?></h2>
                        <?php } else { ?>
                            <h2 class="section-heading">Services</h2>
                        <?php } ?>
                        <?php if (get_theme_mod('col_sub','') != '') { ?>
                            <h3 class="section-subheading text-muted"><?php echo stripslashes(get_theme_mod('col_sub','')); ?></h3>
                        <?php } else { ?>
							<h3 class="section-subheading text-muted">Phasellus elementum odio faucibus diam sollicitudin</h3>
                        <?php } ?>
                </div>
            </div>
            <div class="row text-center servies">
                <div class="col-md-4">
                   <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa <?php
						if (get_theme_mod('first_feature_font_icon','') != '') {
							echo stripslashes(get_theme_mod('first_feature_font_icon',''));
						} else {
							?> fa-microphone <?php } ?> fa-stack-1x fa-inverse"></i>
                    </span>
					<?php if (get_theme_mod('first_feature_heading','') != '') { ?>
                                <a href="<?php
                                if (get_theme_mod('first_feature_link','') != '') {
                                    echo stripslashes(get_theme_mod('first_feature_link',''));
                                } else {
                                    echo "#";
                                }
                                ?>"><h4 class="service-heading"><?php echo stripslashes(get_theme_mod('first_feature_heading','')); ?></h4></a>
                               <?php } else { ?>
                                <a href="#"><h4 class="service-heading">E-Commerce</h4></a>
								 <?php } if (get_theme_mod('first_feature_desc','') != '') { ?>
                                <p class="text-muted"><?php echo stripslashes(get_theme_mod('first_feature_desc','')); ?></p>
                            <?php } else { ?>
                               <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                            <?php } ?>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa <?php
                                if (get_theme_mod('second_feature_font_icon','') != '') {
                                    echo stripslashes(get_theme_mod('second_feature_font_icon',''));
                                } else {
                                    ?> fa-rocket <?php } ?> fa-stack-1x fa-inverse"></i>
                    </span>
					<?php if (get_theme_mod('second_feature_heading','') != '') { ?>
                                <a href="<?php
                                if (get_theme_mod('second_feature_link','') != '') {
                                    echo stripslashes(get_theme_mod('second_feature_link',''));
                                } else {
                                    echo "#";
                                }
                                ?>"><h4 class="service-heading"><?php echo stripslashes(get_theme_mod('second_feature_heading','')); ?></h4></a>
                               <?php } else { ?>
                                <a href="#"><h4 class="service-heading">Responsive Design</h4></a>
								 <?php } if (get_theme_mod('second_feature_desc','') != '') { ?>
                                <p class="text-muted"><?php echo stripslashes(get_theme_mod('second_feature_desc','')); ?></p>
                            <?php } else { ?>
                               <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                            <?php } ?>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa <?php
                                if (get_theme_mod('third_feature_font_icon','') != '') {
                                    echo get_theme_mod('third_feature_font_icon','');
                                } else {
                                    ?>fa-signal <?php } ?> fa-stack-1x fa-inverse"></i>
                    </span>
					<?php if (get_theme_mod('third_feature_heading','') != '') { ?>
                                <a href="<?php
                                if (get_theme_mod('third_feature_link','') != '') {
                                    echo stripslashes(get_theme_mod('third_feature_link',''));
                                } else {
                                    echo "#";
                                }
                                ?>"><h4 class="service-heading"><?php echo stripslashes(get_theme_mod('third_feature_heading','')); ?></h4></a>
                               <?php } else { ?>
                                <a href="#"><h4 class="service-heading">Web Security</h4></a>
								 <?php } if (get_theme_mod('third_feature_desc','') != '') { ?>
                                <p class="text-muted"><?php echo stripslashes(get_theme_mod('third_feature_desc','')); ?></p>
                            <?php } else { ?>
                               <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                            <?php } ?>
                </div>
            </div>
        </div>
    </section>
	<!-- *** Testimonial Slider Starts *** -->
<?php if (get_theme_mod('testimonial_parallax_image','') != '') { ?>
<section class="testimonial-wrapper" id="section2" data-type="background" style="background: url(<?php echo get_theme_mod('testimonial_parallax_image',''); ?>) center repeat fixed;">
<?php } else { ?>
 <section class="testimonial-wrapper" id="section2">
 <?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="testimonial-inner animated bottom-to-top">
				<?php if (get_theme_mod('testimonial_heading','') != '') { ?>
                    <h1 class="testimonial-header"><?php echo get_theme_mod('testimonial_heading',''); ?></h1>
					<?php } else { ?>
                    <h1 class="testimonial-header">Show Multiple Testimonials.</h1>
					<?php } ?>
                    <ul class="bxslider">
					<!-- *Testimonial 1 Starts* -->
					<?php if (get_theme_mod('first_author_desc','') != '') { ?>
                        <li>
                            <img src="<?php if (get_theme_mod('first_author_image','') != '') { ?><?php echo get_theme_mod('first_author_image',''); } else { echo get_template_directory_uri(); ?>/images/testimonial-image.png<?php } ?>" onMouseOver="javascript: this.title='';" title="<a class='arrow'></a>
							<?php echo get_theme_mod('first_author_desc',''); ?>	
							<p><a class='testimonial'><?php echo get_theme_mod('first_author_name','') ; ?></a></p>">
                        </li>
					<?php } else { ?>
					
					<?php } ?>
					<!-- *Testimonial 1 Ends* -->

                    <!-- *Testimonial 2 Starts* -->
					<?php if (get_theme_mod('second_author_desc','') != '') { ?>
                        <li>
                            <img src="<?php if (get_theme_mod('second_author_image','') != '') { ?><?php echo get_theme_mod('second_author_image',''); } else { echo get_template_directory_uri(); ?>/images/testimonial-image.png <?php } ?>" onMouseOver="javascript: this.title='';" title="<a class='arrow'></a>
							<?php echo get_theme_mod('second_author_desc',''); ?>
							<p><a class='testimonial'><?php echo get_theme_mod('second_author_name',''); ?></a></p>">
                        </li>
					<?php } else { ?>
					<li>
								<img src="<?php echo get_template_directory_uri(); ?>/images/testimonial-image.png" onMouseOver="javascript: this.title='';" title="<a class='arrow'></a>NovelLite comes with amazing business features. It is perfect for a business website with required features.<p><a class='testimonial'>NovelLite</a></p>">
					</li>
					<?php } ?>
					<!-- *Testimonial 2 Ends* -->					
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- About Section -->	
    <section id="section3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">                    
					<?php if (get_theme_mod('blog_head_','') != '') { ?>
					<h2 class="section-heading"><?php echo stripslashes(get_theme_mod('blog_head_','')); ?></h2>
				<?php } else { ?>
					<h2 class="section-heading">Latest Post</h2>
				<?php } ?>
				<?php if (get_theme_mod('blog_desc_','') != '') { ?>
					<h3 class="section-subheading text-muted"><?php echo stripslashes(get_theme_mod('blog_desc_','')); ?></h3>
				<?php } else { ?>
					<h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
				<?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
				<div class="home_blog_content gallery">				
                     <?php
                                global $post;
                                $query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3));
                                $i = 0;
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) : $query->the_post();
                                        $i++;
                                        $z = .2 * $i;
                                        ?>
                                        <!--Start post-->
                                        <div class="post animated" style="-webkit-animation-delay: <?php echo $z; ?>s;
                                             -webkit-animation-delay: <?php echo $z; ?>s; -moz-animation-delay: <?php echo $z; ?>s; -o-animation-delay: <?php echo $z; ?>s; -ms-animation-delay: <?php echo $z; ?>s;">	
                                            <div class="post_inner">	
                                                <div class="post_thumbnil">
                                                        <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
    
                                                            <a href="<?php post_permalink() ?>"> <?php the_post_thumbnail('post_thumbnail_front'); ?></a>	 
                                                            <a rel='prettyPhoto[gallery2]' href="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID, 'thumbnail')); ?>"><span class="image_link"></span></a>	
                                                            <?php
                                                        } ?>
                                                    </div>
                                               
                                                <div class="post_content">			 
                                                    <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> </h1>
                                                    <ul class="post_meta">
                                                        <li class="posted_by"><span>by </span><?php the_author_posts_link(); ?></li>
                                                        <li class="posted_on"><span></span><?php echo get_the_time('M, d, Y') ?></li>						
                                                    </ul>
                                                    <?php echo NovelLite_trim_excerpt(20); ?>
                                                </div>
                                                <div class="post_content_bottom">
                                                    <span class="post_comment"><i class="fa fa-comments"></i><?php comments_popup_link(NO_CMNT, ONE_CMNT, '% ' . CMNT); ?></span>							
                                                    <span class="read_more"><a class="read_more" href="<?php the_permalink() ?>"><?php echo READ_MORE; ?></a><i class="fa fa-share-square-o"></i></span>
                                                </div>
                                            </div>									
                                        </div>
                                        <?php
                                    endwhile;
                                } else {
                                    ?>
                                    <div class="post">
                                        <p>
                                            <?php echo SORRY_NO_POSTS_MATCHED_YOUR_CRITERIA; ?>
                                        </p>
                                    </div>
                                <?php } ?>
                </div>
            </div>
			</div>
        </div>
    </section>
    <!-- Team Section -->
    <section id="section4" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">                  
					<?php if (get_theme_mod('team_head_','') != '') { ?>
                            <h2 class="section-heading"><?php echo stripslashes(get_theme_mod('team_head_','')); ?></h2>
                        <?php } else { ?>
                            <h2 class="section-heading">Our Amazing Team</h2>
                        <?php } ?>
                        <?php if (get_theme_mod('team_desc_','') != '') { ?>
                            <h3><?php echo stripslashes(get_theme_mod('team_desc_','')); ?></h3>
                        <?php } else { ?>
                           <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                        <?php } ?>
					
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
					<?php if (get_theme_mod('our_team_img_first','') != '') { ?>
					<a href="<?php echo get_theme_mod('our_team_link_first',''); ?>"><img src="<?php echo get_theme_mod('our_team_img_first',''); ?>" class="img-responsive img-circle" alt="Feature Image 1"/></a>
					<?php } else { ?>
                    <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/team/Team-Placeholder.jpg" class="img-responsive img-circle" alt=""></a>
					<?php } ?>
					   <?php if (get_theme_mod('our_team_heading_first','') != '') { ?>
				<a href="<?php echo get_theme_mod('our_team_link_first',''); ?>"><h4><?php echo stripslashes(get_theme_mod('our_team_heading_first','')); ?></h4></a>
			<?php } else { ?>
            <a href="#"><h4>Kay Garland</h4></a>
			<?php } ?>
			<?php if (get_theme_mod('our_team_subhead_first','') != '') { ?>
			<p class="text-muted"><?php echo stripslashes(get_theme_mod('our_team_subhead_first','')); ?></p>
			<?php } else { ?>       
			<p class="text-muted">Lead Designer</p>
			<?php } ?>
			<?php if (get_theme_mod('our_team_desc_first','') != '') { ?>
			<p><?php echo stripslashes(get_theme_mod('our_team_desc_first','')); ?></p>
			<?php } else { ?>
			<p> Phasellus elementum odio faucibus diam sollicitudin, in bibendum quam feugiat.</p>
			<?php } ?>  
		                    </div>
                </div>
                <div class="col-sm-4">
				<div class="team-member">	
					<?php if (get_theme_mod('our_team_img_second','') != '') { ?>
					<a href="<?php echo get_theme_mod('our_team_link_second',''); ?>"><img src="<?php echo get_theme_mod('our_team_img_second',''); ?>" class="img-responsive img-circle" alt="Feature Image 1"/></a>
					<?php } else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/team/Team-Placeholder.jpg" class="img-responsive img-circle" alt="">
					<?php } ?>
					   <?php if (get_theme_mod('our_team_heading_second','') != '') { ?>
				<a href="<?php echo get_theme_mod('our_team_link_second',''); ?>"><h4><?php echo stripslashes(get_theme_mod('our_team_heading_second','')); ?></h4></a>
			<?php } else { ?>
            <a href="#"><h4>Larry Parker</h4></a>
			<?php } ?>
			<?php if (get_theme_mod('our_team_subhead_second','') != '') { ?>
			<p class="text-muted"><?php echo stripslashes(get_theme_mod('our_team_subhead_second','')); ?></p>
			<?php } else { ?>       
			<p class="text-muted">Lead Marketer</p>
			<?php } ?>
			<?php if (get_theme_mod('our_team_desc_second','') != '') { ?>
			<p><?php echo stripslashes(get_theme_mod('our_team_desc_second','')); ?></p>
			<?php } else { ?>
			<p> Phasellus elementum odio faucibus diam sollicitudin, in bibendum quam feugiat.</p>
			<?php } ?>  
		                    </div>
                </div>
                <div class="col-sm-4">
				<div class="team-member">	
					<?php if (get_theme_mod('our_team_img_third','') != '') { ?>
					<a href="<?php echo get_theme_mod('our_team_link_third',''); ?>"><img src="<?php echo get_theme_mod('our_team_img_third',''); ?>" class="img-responsive img-circle" alt="Feature Image 3"/></a>
					<?php } else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/team/Team-Placeholder.jpg" class="img-responsive img-circle" alt="">
					<?php } ?>
					   <?php if (get_theme_mod('our_team_heading_third','') != '') { ?>
				<a href="<?php echo get_theme_mod('our_team_link_third',''); ?>"><h4><?php echo stripslashes(get_theme_mod('our_team_heading_third','')); ?></h4></a>
			<?php } else { ?>
            <a href="#"><h4>Diana Pertersen</h4></a>
			<?php } ?>
			<?php if (get_theme_mod('our_team_subhead_third','') != '') { ?>
			<p class="text-muted"><?php echo stripslashes(get_theme_mod('our_team_subhead_third','')); ?></p>
			<?php } else { ?>     
            <p class="text-muted">Lead Developer</p>
			<?php } ?>
			<?php if (get_theme_mod('our_team_desc_third','') != '') { ?>
			<p><?php echo stripslashes(get_theme_mod('our_team_desc_third','')); ?></p>
			<?php } else { ?>
			<p> Phasellus elementum odio faucibus diam sollicitudin, in bibendum quam feugiat.</p>
			<?php } ?>  
	             </div>                   
                </div>
            </div>           
        </div>
    </section>	
	 <?php get_template_part('home-contact'); ?>
    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->
	<script>
    // Super Slides
    jQuery(function() {
        var $slides = jQuery('#slides_full');
        Hammer($slides[0]).on("swipeleft", function(e) {
            $slides.data('superslides').animate('next');
        });
        Hammer($slides[0]).on("swiperight", function(e) {
            $slides.data('superslides').animate('prev');
        });
        $slides.superslides({
            hashchange: false
        });
    });
    jQuery('#slides_full').superslides({
        animation: 'fade',
        slide_easing: 'easeInOutCubic',
        play:<?php if ((get_theme_mod('first_slider_image') != '') || (get_theme_mod('second_slider_image') != '') ) { ?>jQuery("#txt_slidespeed").val(),<?php } else { ?>false,<?php } ?>
    });
</script>
<?php get_footer(); ?>