<?php
     //  =============================
     //  = Default Theme Customizer Settings  =
     //  @ NovelLite Theme
     //  =============================


add_action( 'customize_controls_enqueue_scripts', 'th_customize_control_enqueue_scripts');
function th_customize_control_enqueue_scripts() {
wp_enqueue_script( 'th-customize-controls', get_template_directory_uri(). '/js/customize-script.js', array( 'customize-controls' ) );
wp_register_style( 'ctypo-customize-controls', get_template_directory_uri(). '/css/customize-control.css');
}

/*theme customizer*/
function NovelLite_customize_register( $wp_customize ) {
 
     //  =============================
     //  = Genral Settings     =
   	 //  =============================

  $wp_customize->get_section('title_tagline')->title = esc_html__('General Settings', 'novellite');
   $wp_customize->get_section('title_tagline')->priority = 3;
		//Logo upload
     $wp_customize->add_setting('logo_upload', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
      $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo_upload', array(
        'label'    => __('Logo Upload', 'novellite'),
        'section'  => 'title_tagline',
        'settings' => 'logo_upload',
    )));

     //  =============================
     //  = Home Page Slider Settings       =
   	 //  =============================

     $wp_customize->add_panel( 'home_page_slider', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Home Slider Settings', 'novellite'),
    'description'    => '',
) );

       //slider speed
 $wp_customize->add_section('section_slider_speed', array(
        'title'    => __('Slider Speed', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_page_slider',
    ));
    $wp_customize->add_setting('NovelLite_slider_speed', array(
        'default'           => 3000,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_int'
    ));
    $wp_customize->add_control('NovelLite_slider_speed', array(
        'label'    => __('Slider Speed Options', 'novellite'),
        'section'  => 'section_slider_speed',
        'settings' => 'NovelLite_slider_speed',
         'type'       => 'text',
    ));

    //First slider image

     $wp_customize->add_section('section_slider_first', array(
        'title'    => __('First Slider', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_page_slider',
    ));
    $wp_customize->add_setting('first_slider_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'first_slider_image', array(
        'label'    => __('Slider Image Upload', 'novellite'),
        'section'  => 'section_slider_first',
        'settings' => 'first_slider_image',
    )));
    $wp_customize->add_setting('first_slider_heading', array(
        'default'           => 'Heading 1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('first_slider_heading', array(
        'label'    => __('Slider Heading', 'novellite'),
        'section'  => 'section_slider_first',
        'settings' => 'first_slider_heading',
         'type'       => 'text',
    ));
 
    $wp_customize->add_setting('first_slider_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'

    ));
    $wp_customize->add_control('first_slider_desc', array(
        'label'    => __('Description for slider', 'novellite'),
        'section'  => 'section_slider_first',
        'settings' => 'first_slider_desc',
         'type'       => 'textarea',
    ));
       $wp_customize->add_setting('first_slider_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control('first_slider_link', array(
        'label'    => __('Link for slider', 'novellite'),
        'section'  => 'section_slider_first',
        'settings' => 'first_slider_link',
         'type'       => 'text',
    ));

         $wp_customize->add_setting('first_button_text', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('first_button_text', array(
        'label'    => __('Text for button', 'novellite'),
        'section'  => 'section_slider_first',
        'settings' => 'first_button_text',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('first_button_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('first_button_link', array(
        'label'    => __('Link for button', 'novellite'),
        'section'  => 'section_slider_first',
        'settings' => 'first_button_link',
         'type'       => 'text',
    ));

    //Second slider image

     $wp_customize->add_section('section_slider_second', array(
        'title'    => __('Second Slider', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_page_slider',
    ));
    $wp_customize->add_setting('second_slider_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'second_slider_image', array(
        'label'    => __('Slider Image Upload', 'novellite'),
        'section'  => 'section_slider_second',
        'settings' => 'second_slider_image',
    )));
    $wp_customize->add_setting('second_slider_heading', array(
        'default'           => 'Heading 1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('second_slider_heading', array(
        'label'    => __('Slider Heading', 'novellite'),
        'section'  => 'section_slider_second',
        'settings' => 'second_slider_heading',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('second_slider_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('second_slider_desc', array(
        'label'    => __('Description for slider', 'novellite'),
        'section'  => 'section_slider_second',
        'settings' => 'second_slider_desc',
         'type'       => 'textarea',
    ));
    $wp_customize->add_setting('second_slider_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control('second_slider_link', array(
        'label'    => __('Link for slider', 'novellite'),
        'section'  => 'section_slider_second',
        'settings' => 'second_slider_link',
         'type'       => 'text',
    ));

   

    $wp_customize->add_setting('second_button_text', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('second_button_text', array(
        'label'    => __('Text for button', 'novellite'),
        'section'  => 'section_slider_second',
        'settings' => 'second_button_text',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('second_button_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('second_button_link', array(
        'label'    => __('Link for button', 'novellite'),
        'section'  => 'section_slider_second',
        'settings' => 'second_button_link',
         'type'       => 'text',
    ));
//-------------------End Sldier Panel----------------------------//


                //  =============================
                 //  = Three Column Settings       =
                 //  =============================

    $wp_customize->add_panel( 'home_three_col', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Three Column Feature Settings', 'novellite'),
    'description'    => '',
) );


 $wp_customize->add_section('section_three_col_heading', array(
        'title'    => __('Feature Heading & Sub Heading', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_three_col',
    ));
    $wp_customize->add_setting('col_heading', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('col_heading', array(
        'label'    => __('Home Three Column Feature Heading', 'novellite'),
        'section'  => 'section_three_col_heading',
        'settings' => 'col_heading',
         'type'       => 'text',
    ));

       $wp_customize->add_setting('col_sub', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('col_sub', array(
        'label'    => __('Home Page Three Column Sub Heading', 'novellite'),
        'section'  => 'section_three_col_heading',
        'settings' => 'col_sub',
         'type'       => 'text',
    ));


           // Feature First Block
     $wp_customize->add_section('first_feature_block', array(
        'title'    => __('First Feature Section', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_three_col',
    ));
    $wp_customize->add_setting('first_feature_font_icon', array(
        'default'           => 'fa-microphone fa-stack-1x fa-inverse',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('first_feature_font_icon', array(
        'label'    => __('Font Icon', 'novellite'),
        'section'  => 'first_feature_block',
        'settings' => 'first_feature_font_icon',
         'type'       => 'text',
    ));

       $wp_customize->add_setting('first_feature_heading', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('first_feature_heading', array(
        'label'    => __('Feature Heading', 'novellite'),
        'section'  => 'first_feature_block',
        'settings' => 'first_feature_heading',
         'type'       => 'text',
    ));

          $wp_customize->add_setting('first_feature_link', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control('first_feature_link', array(
        'label'    => __('Feature Heading Link', 'novellite'),
        'section'  => 'first_feature_block',
        'settings' => 'first_feature_link',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('first_feature_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('first_feature_desc', array(
        'label'    => __('Feature Description', 'novellite'),
        'section'  => 'first_feature_block',
        'settings' => 'first_feature_desc',
         'type'       => 'textarea',
    ));


    // Feature Second Block
     $wp_customize->add_section('second_feature_block', array(
        'title'    => __('Second Feature Section', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_three_col',
    ));
    $wp_customize->add_setting('second_feature_font_icon', array(
        'default'           => 'fa-rocket fa-stack-1x fa-inverse',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('second_feature_font_icon', array(
        'label'    => __('Font Icon', 'novellite'),
        'section'  => 'second_feature_block',
        'settings' => 'second_feature_font_icon',
         'type'       => 'text',
    ));

       $wp_customize->add_setting('second_feature_heading', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('second_feature_heading', array(
        'label'    => __('Feature Heading', 'novellite'),
        'section'  => 'second_feature_block',
        'settings' => 'second_feature_heading',
         'type'       => 'text',
    ));

          $wp_customize->add_setting('second_feature_link', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control('second_feature_link', array(
        'label'    => __('Feature Heading Link', 'novellite'),
        'section'  => 'second_feature_block',
        'settings' => 'second_feature_link',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('second_feature_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('second_feature_desc', array(
        'label'    => __('Feature Description', 'novellite'),
        'section'  => 'second_feature_block',
        'settings' => 'second_feature_desc',
         'type'       => 'textarea',
    ));

    // Feature Third Block
     $wp_customize->add_section('third_feature_block', array(
        'title'    => __('Third Feature Section', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_three_col',
    ));
    $wp_customize->add_setting('third_feature_font_icon', array(
        'default'           => 'fa-rocket fa-stack-1x fa-inverse',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('third_feature_font_icon', array(
        'label'    => __('Font Icon', 'novellite'),
        'section'  => 'third_feature_block',
        'settings' => 'third_feature_font_icon',
         'type'       => 'text',
    ));

       $wp_customize->add_setting('third_feature_heading', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('third_feature_heading', array(
        'label'    => __('Feature Heading', 'novellite'),
        'section'  => 'third_feature_block',
        'settings' => 'third_feature_heading',
         'type'       => 'text',
    ));

          $wp_customize->add_setting('third_feature_link', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control('third_feature_link', array(
        'label'    => __('Feature Heading Link', 'novellite'),
        'section'  => 'third_feature_block',
        'settings' => 'third_feature_link',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('third_feature_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('third_feature_desc', array(
        'label'    => __('Feature Description', 'novellite'),
        'section'  => 'third_feature_block',
        'settings' => 'third_feature_desc',
         'type'       => 'textarea',
    ));

//-------------------End Three Column Panel----------------------------//


                 //  =============================
                //  = Testimonial Settings       =
                //  =============================

$wp_customize->add_panel( 'home_testimonial', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Home Testimonial Settings', 'novellite'),
    'description'    => '',
) );

//Parallax Background Image
 $wp_customize->add_section('testimonial_bg_heading', array(
        'title'    => __('Testimonial Heading & Background', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_testimonial',
    ));
    $wp_customize->add_setting('testimonial_parallax_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testimonial_parallax_image', array(
        'label'    => __('Parallax Background Image Upload', 'novellite'),
        'section'  => 'testimonial_bg_heading',
        'settings' => 'testimonial_parallax_image',
    )));

// main heading

    $wp_customize->add_setting('testimonial_heading', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('testimonial_heading', array(
        'label'    => __('Testimonial Main Heading', 'novellite'),
        'section'  => 'testimonial_bg_heading',
        'settings' => 'testimonial_heading',
         'type'       => 'text',
    ));

    // Testimonial first 1 
     $wp_customize->add_section('section_testimonial_first', array(
        'title'    => __('1st Testimonial', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_testimonial',
    ));
    $wp_customize->add_setting('first_author_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'first_author_image', array(
        'label'    => __('Author Image Upload', 'novellite'),
        'section'  => 'section_testimonial_first',
        'settings' => 'first_author_image',
    )));

    $wp_customize->add_setting('first_author_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('first_author_desc', array(
        'label'    => __('Testimonial text', 'novellite'),
        'section'  => 'section_testimonial_first',
        'settings' => 'first_author_desc',
         'type'       => 'textarea',
    ));

      $wp_customize->add_setting('first_author_name', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('first_author_name', array(
        'label'    => __('Author Name', 'novellite'),
        'section'  => 'section_testimonial_first',
        'settings' => 'first_author_name',
         'type'       => 'text',
    ));

    // Testimonial first 2
     $wp_customize->add_section('section_testimonial_second', array(
        'title'    => __('2nd Testimonial', 'novellite'),
        'priority' => 20,
         'panel'  => 'home_testimonial',
    ));
    $wp_customize->add_setting('second_author_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'second_author_image', array(
        'label'    => __('Author Image Upload', 'novellite'),
        'section'  => 'section_testimonial_second',
        'settings' => 'second_author_image',
    )));

    $wp_customize->add_setting('second_author_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('second_author_desc', array(
        'label'    => __('Testimonial text', 'novellite'),
        'section'  => 'section_testimonial_second',
        'settings' => 'second_author_desc',
         'type'       => 'textarea',
    ));

      $wp_customize->add_setting('second_author_name', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('second_author_name', array(
        'label'    => __('Author Name', 'novellite'),
        'section'  => 'section_testimonial_second',
        'settings' => 'second_author_name',
         'type'       => 'text',
    ));


    //Home Page Blog heading and sub heading 

    $wp_customize->add_section( 'blog_head_desc', array(
     'title'          => __( 'Home Blog Heading & Sub Heading','novellite' ),
     'priority'       => 20,
) );
       $wp_customize->add_setting('blog_head_', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('blog_head_', array(
        'label'    => __('Home Page Blog Feature Heading', 'novellite'),
        'section'  => 'blog_head_desc',
        'settings' => 'blog_head_',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('blog_desc_', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('blog_desc_', array(
        'label'    => __('Home Page Blog Feature Sub Heading', 'novellite'),
        'section'  => 'blog_head_desc',
        'settings' => 'blog_desc_',
         'type'       => 'textarea',
    ));


   //-------------------End Blog Heading and SubHeading----------------------------//


        //  =============================
        //  = Our Team Settings       =
        //  =============================
    // team panel
$wp_customize->add_panel( 'our_team', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Our Team Feature Settings', 'novellite'),
    'description'    => '',
) );

// team head and sub heading
    $wp_customize->add_section( 'team_head_desc', array(
     'title'          => __( 'Our Team Heading & Sub Heading','novellite' ),
     'theme_supports' => 'custom-background',
     'panel'  => 'our_team'
) );
       $wp_customize->add_setting('team_head_', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('team_head_', array(
        'label'    => __('Our Team Feature Heading', 'novellite'),
        'section'  => 'team_head_desc',
        'settings' => 'team_head_',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('team_desc_', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('team_desc_', array(
        'label'    => __('Our Team Feature Sub Heading', 'novellite'),
        'section'  => 'team_head_desc',
        'settings' => 'team_desc_',
         'type'       => 'textarea',
    ));


//our team first section

     $wp_customize->add_section('our_team_first', array(
        'title'    => __('First Our Team Feature', 'novellite'),
         'panel'  => 'our_team',
    ));
    $wp_customize->add_setting('our_team_img_first', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_first', array(
        'label'    => __('Our Team Image Upload', 'novellite'),
        'section'  => 'our_team_first',
        'settings' => 'our_team_img_first',
    )));
    $wp_customize->add_setting('our_team_heading_first', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('our_team_heading_first', array(
        'label'    => __('Our Team Heading', 'novellite'),
        'section'  => 'our_team_first',
        'settings' => 'our_team_heading_first',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('our_team_subhead_first', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('our_team_subhead_first', array(
        'label'    => __('Our Team Sub Heading', 'novellite'),
        'section'  => 'our_team_first',
        'settings' => 'our_team_subhead_first',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('our_team_desc_first', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('our_team_desc_first', array(
        'label'    => __('Description for Our Team', 'novellite'),
        'section'  => 'our_team_first',
        'settings' => 'our_team_desc_first',
         'type'       => 'textarea',
    ));

       $wp_customize->add_setting('our_team_link_first', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('our_team_link_first', array(
        'label'    => __('Link for Our Team', 'novellite'),
        'section'  => 'our_team_first',
        'settings' => 'our_team_link_first',
         'type'       => 'text',
    ));


//our team second section

     $wp_customize->add_section('our_team_second', array(
        'title'    => __('Second Our Team Feature', 'novellite'),
         'panel'  => 'our_team',
    ));
    $wp_customize->add_setting('our_team_img_second', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_second', array(
        'label'    => __('Our Team Image Upload', 'novellite'),
        'section'  => 'our_team_second',
        'settings' => 'our_team_img_second',
    )));
    $wp_customize->add_setting('our_team_heading_second', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('our_team_heading_second', array(
        'label'    => __('Our Team Heading', 'novellite'),
        'section'  => 'our_team_second',
        'settings' => 'our_team_heading_second',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('our_team_subhead_second', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('our_team_subhead_second', array(
        'label'    => __('Our Team Sub Heading', 'novellite'),
        'section'  => 'our_team_second',
        'settings' => 'our_team_subhead_second',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('our_team_desc_second', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('our_team_desc_second', array(
        'label'    => __('Description for Our Team', 'novellite'),
        'section'  => 'our_team_second',
        'settings' => 'our_team_desc_second',
         'type'       => 'textarea',
    ));

       $wp_customize->add_setting('our_team_link_second', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('our_team_link_second', array(
        'label'    => __('Link for Our Team', 'novellite'),
        'section'  => 'our_team_second',
        'settings' => 'our_team_link_second',
         'type'       => 'text',
    ));

//our team third section

     $wp_customize->add_section('our_team_third', array(
        'title'    => __('Third Our Team Feature', 'novellite'),
         'panel'  => 'our_team',
    ));
    $wp_customize->add_setting('our_team_img_third', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_third', array(
        'label'    => __('Our Team Image Upload', 'novellite'),
        'section'  => 'our_team_third',
        'settings' => 'our_team_img_third',
    )));
    $wp_customize->add_setting('our_team_heading_third', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('our_team_heading_third', array(
        'label'    => __('Our Team Heading', 'novellite'),
        'section'  => 'our_team_third',
        'settings' => 'our_team_heading_third',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('our_team_subhead_third', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('our_team_subhead_third', array(
        'label'    => __('Our Team Sub Heading', 'novellite'),
        'section'  => 'our_team_third',
        'settings' => 'our_team_subhead_third',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('our_team_desc_third', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'

    ));
    $wp_customize->add_control('our_team_desc_third', array(
        'label'    => __('Description for Our Team', 'novellite'),
        'section'  => 'our_team_third',
        'settings' => 'our_team_desc_third',
         'type'       => 'textarea',
    ));

       $wp_customize->add_setting('our_team_link_third', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('our_team_link_third', array(
        'label'    => __('Link for Our Team', 'novellite'),
        'section'  => 'our_team_third',
        'settings' => 'our_team_link_third',
         'type'       => 'text',
    ));


//our team fourth section

     $wp_customize->add_section('our_team_fourth', array(
        'title'    => __('Fourth Our Team Feature', 'novellite'),
         'panel'  => 'our_team',
    ));
    $wp_customize->add_setting('our_team_img_fourth', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_fourth', array(
        'label'    => __('Our Team Image Upload', 'novellite'),
        'section'  => 'our_team_fourth',
        'settings' => 'our_team_img_fourth',
    )));
    $wp_customize->add_setting('our_team_heading_fourth', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('our_team_heading_fourth', array(
        'label'    => __('Our Team Heading', 'novellite'),
        'section'  => 'our_team_fourth',
        'settings' => 'our_team_heading_fourth',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('our_team_subhead_fourth', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('our_team_subhead_fourth', array(
        'label'    => __('Our Team Sub Heading', 'novellite'),
        'section'  => 'our_team_fourth',
        'settings' => 'our_team_subhead_fourth',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('our_team_desc_fourth', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('our_team_desc_fourth', array(
        'label'    => __('Description for Our Team', 'novellite'),
        'section'  => 'our_team_fourth',
        'settings' => 'our_team_desc_fourth',
         'type'       => 'textarea',
    ));

       $wp_customize->add_setting('our_team_link_fourth', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('our_team_link_fourth', array(
        'label'    => __('Link for Our Team', 'novellite'),
        'section'  => 'our_team_fourth',
        'settings' => 'our_team_link_fourth',
         'type'       => 'text',
    ));
    
    //our team fifth section
    
         $wp_customize->add_section('our_team_fifth', array(
            'title'    => __('Fifth Our Team Feature', 'novellite'),
             'panel'  => 'our_team',
        ));
        $wp_customize->add_setting('our_team_img_fifth', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'NovelLite_sanitize_upload'
        ));
       $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_fifth', array(
            'label'    => __('Our Team Image Upload', 'novellite'),
            'section'  => 'our_team_fifth',
            'settings' => 'our_team_img_fifth',
        )));
        $wp_customize->add_setting('our_team_heading_fifth', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('our_team_heading_fifth', array(
            'label'    => __('Our Team Heading', 'novellite'),
            'section'  => 'our_team_fifth',
            'settings' => 'our_team_heading_fifth',
             'type'       => 'text',
        ));
    
        $wp_customize->add_setting('our_team_subhead_fifth', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('our_team_subhead_fifth', array(
            'label'    => __('Our Team Sub Heading', 'novellite'),
            'section'  => 'our_team_fifth',
            'settings' => 'our_team_subhead_fifth',
             'type'       => 'text',
        ));
    
         $wp_customize->add_setting('our_team_desc_fifth', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'NovelLite_sanitize_textarea'
        ));
        $wp_customize->add_control('our_team_desc_fifth', array(
            'label'    => __('Description for Our Team', 'novellite'),
            'section'  => 'our_team_fifth',
            'settings' => 'our_team_desc_fifth',
             'type'       => 'textarea',
        ));
    
           $wp_customize->add_setting('our_team_link_fifth', array(
            'default'           => '#',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control('our_team_link_fifth', array(
            'label'    => __('Link for Our Team', 'novellite'),
            'section'  => 'our_team_fifth',
            'settings' => 'our_team_link_fifth',
             'type'       => 'text',
        ));
        
        //our team sixth section
        
             $wp_customize->add_section('our_team_sixth', array(
                'title'    => __('sixth Our Team Feature', 'novellite'),
                 'panel'  => 'our_team',
            ));
            $wp_customize->add_setting('our_team_img_sixth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'NovelLite_sanitize_upload'
            ));
           $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_sixth', array(
                'label'    => __('Our Team Image Upload', 'novellite'),
                'section'  => 'our_team_sixth',
                'settings' => 'our_team_img_sixth',
            )));
            $wp_customize->add_setting('our_team_heading_sixth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('our_team_heading_sixth', array(
                'label'    => __('Our Team Heading', 'novellite'),
                'section'  => 'our_team_sixth',
                'settings' => 'our_team_heading_sixth',
                 'type'       => 'text',
            ));
        
            $wp_customize->add_setting('our_team_subhead_sixth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('our_team_subhead_sixth', array(
                'label'    => __('Our Team Sub Heading', 'novellite'),
                'section'  => 'our_team_sixth',
                'settings' => 'our_team_subhead_sixth',
                 'type'       => 'text',
            ));
        
             $wp_customize->add_setting('our_team_desc_sixth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'NovelLite_sanitize_textarea'
            ));
            $wp_customize->add_control('our_team_desc_sixth', array(
                'label'    => __('Description for Our Team', 'novellite'),
                'section'  => 'our_team_sixth',
                'settings' => 'our_team_desc_sixth',
                 'type'       => 'textarea',
            ));
        
               $wp_customize->add_setting('our_team_link_sixth', array(
                'default'           => '#',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control('our_team_link_sixth', array(
                'label'    => __('Link for Our Team', 'novellite'),
                'section'  => 'our_team_sixth',
                'settings' => 'our_team_link_sixth',
                 'type'       => 'text',
            ));


//our team seventh section
        
             $wp_customize->add_section('our_team_seventh', array(
                'title'    => __('seventh Our Team Feature', 'novellite'),
                 'panel'  => 'our_team',
            ));
            $wp_customize->add_setting('our_team_img_seventh', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'NovelLite_sanitize_upload'
            ));
           $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_seventh', array(
                'label'    => __('Our Team Image Upload', 'novellite'),
                'section'  => 'our_team_seventh',
                'settings' => 'our_team_img_seventh',
            )));
            $wp_customize->add_setting('our_team_heading_seventh', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('our_team_heading_seventh', array(
                'label'    => __('Our Team Heading', 'novellite'),
                'section'  => 'our_team_seventh',
                'settings' => 'our_team_heading_seventh',
                 'type'       => 'text',
            ));
        
            $wp_customize->add_setting('our_team_subhead_seventh', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('our_team_subhead_seventh', array(
                'label'    => __('Our Team Sub Heading', 'novellite'),
                'section'  => 'our_team_seventh',
                'settings' => 'our_team_subhead_seventh',
                 'type'       => 'text',
            ));
        
             $wp_customize->add_setting('our_team_desc_seventh', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'NovelLite_sanitize_textarea'
            ));
            $wp_customize->add_control('our_team_desc_seventh', array(
                'label'    => __('Description for Our Team', 'novellite'),
                'section'  => 'our_team_seventh',
                'settings' => 'our_team_desc_seventh',
                 'type'       => 'textarea',
            ));
        
               $wp_customize->add_setting('our_team_link_seventh', array(
                'default'           => '#',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control('our_team_link_seventh', array(
                'label'    => __('Link for Our Team', 'novellite'),
                'section'  => 'our_team_seventh',
                'settings' => 'our_team_link_seventh',
                 'type'       => 'text',
            ));

            //our team eighth section
        
             $wp_customize->add_section('our_team_eighth', array(
                'title'    => __('eighth Our Team Feature', 'novellite'),
                 'panel'  => 'our_team',
            ));
            $wp_customize->add_setting('our_team_img_eighth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'NovelLite_sanitize_upload'
            ));
           $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_eighth', array(
                'label'    => __('Our Team Image Upload', 'novellite'),
                'section'  => 'our_team_eighth',
                'settings' => 'our_team_img_eighth',
            )));
            $wp_customize->add_setting('our_team_heading_eighth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('our_team_heading_eighth', array(
                'label'    => __('Our Team Heading', 'novellite'),
                'section'  => 'our_team_eighth',
                'settings' => 'our_team_heading_eighth',
                 'type'       => 'text',
            ));
        
            $wp_customize->add_setting('our_team_subhead_eighth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('our_team_subhead_eighth', array(
                'label'    => __('Our Team Sub Heading', 'novellite'),
                'section'  => 'our_team_eighth',
                'settings' => 'our_team_subhead_eighth',
                 'type'       => 'text',
            ));
        
             $wp_customize->add_setting('our_team_desc_eighth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'NovelLite_sanitize_textarea'
            ));
            $wp_customize->add_control('our_team_desc_eighth', array(
                'label'    => __('Description for Our Team', 'novellite'),
                'section'  => 'our_team_eighth',
                'settings' => 'our_team_desc_eighth',
                 'type'       => 'textarea',
            ));
        
               $wp_customize->add_setting('our_team_link_eighth', array(
                'default'           => '#',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control('our_team_link_eighth', array(
                'label'    => __('Link for Our Team', 'novellite'),
                'section'  => 'our_team_eighth',
                'settings' => 'our_team_link_eighth',
                 'type'       => 'text',
            ));

            //our team ninth section
        
             $wp_customize->add_section('our_team_ninth', array(
                'title'    => __('ninth Our Team Feature', 'novellite'),
                 'panel'  => 'our_team',
            ));
            $wp_customize->add_setting('our_team_img_ninth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'NovelLite_sanitize_upload'
            ));
           $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'our_team_img_ninth', array(
                'label'    => __('Our Team Image Upload', 'novellite'),
                'section'  => 'our_team_ninth',
                'settings' => 'our_team_img_ninth',
            )));
            $wp_customize->add_setting('our_team_heading_ninth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('our_team_heading_ninth', array(
                'label'    => __('Our Team Heading', 'novellite'),
                'section'  => 'our_team_ninth',
                'settings' => 'our_team_heading_ninth',
                 'type'       => 'text',
            ));
        
            $wp_customize->add_setting('our_team_subhead_ninth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('our_team_subhead_ninth', array(
                'label'    => __('Our Team Sub Heading', 'novellite'),
                'section'  => 'our_team_ninth',
                'settings' => 'our_team_subhead_ninth',
                 'type'       => 'text',
            ));
        
             $wp_customize->add_setting('our_team_desc_ninth', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'NovelLite_sanitize_textarea'
            ));
            $wp_customize->add_control('our_team_desc_ninth', array(
                'label'    => __('Description for Our Team', 'novellite'),
                'section'  => 'our_team_ninth',
                'settings' => 'our_team_desc_ninth',
                 'type'       => 'textarea',
            ));
        
               $wp_customize->add_setting('our_team_link_ninth', array(
                'default'           => '#',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control('our_team_link_ninth', array(
                'label'    => __('Link for Our Team', 'novellite'),
                'section'  => 'our_team_ninth',
                'settings' => 'our_team_link_ninth',
                 'type'       => 'text',
            ));


           //  =============================
        //  = lead detail Settings       =
        //  =============================

    $wp_customize->add_section( 'lead_form', array(
     'title'          => __( 'Footer Form Setting', 'novellite' ),
     'priority'       => 20,
) );

    $wp_customize->add_setting('cf_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cf_image', array(
        'label'    => __('Parallax Form Background Image', 'novellite'),
        'section'  => 'lead_form',
        'settings' => 'cf_image',
    )));


       $wp_customize->add_setting('cf_head_', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('cf_head_', array(
        'label'    => __('Form Heading', 'novellite'),
        'section'  => 'lead_form',
        'settings' => 'cf_head_',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('cf_desc_', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('cf_desc_', array(
        'label'    => __('Form Sub Heading', 'novellite'),
        'section'  => 'lead_form',
        'settings' => 'cf_desc_',
         'type'       => 'textarea',
    ));


     $wp_customize->add_section( 'footer_option', array(
         'title'          => __( 'Footer Text', 'novellite' ),
         'priority'       => 20,
    ) );

    $wp_customize->add_setting('footertext', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('footertext', array(
        'label'    => __('Footer Text', 'novellite'),
        'section'  => 'footer_option',
        'settings' => 'footertext',
         'type'       => 'textarea',
    ));


// custo color
    $wp_customize->get_section('colors')->title = esc_html__('Style Settings', 'novellite');
    $wp_customize->get_section('colors')->priority = 25;


    //  =============================
    //  = Custom Css      =
    //  =============================
 $wp_customize->add_section('custom_css', array(
        'title'    => __('Custom Css', 'novellite'),
        'priority' => 20,
    ));
   $wp_customize->add_setting('custom_css_text', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('custom_css_text', array(
        'settings' => 'custom_css_text',
        'label'     => 'Custom Css',
        'section' => 'custom_css',
        'type'    => 'textarea',
    ) );

}
add_action('customize_register','NovelLite_customize_register');