<?php
/**
 * Banner Section
 * 
 * slug: day-camp/banner
 * title: Banner
 * categories: day-camp
 */

return array(
    'title'      =>__( 'Banner', 'day-camp' ),
    'categories' => array( 'day-camp' ),
    'content'    => '<!-- wp:group {"className":"summer-camp-banner-section","style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"},"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":"750px"}},"backgroundColor":"accent","layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-group summer-camp-banner-section has-accent-background-color has-background" style="min-height:750px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:columns {"className":"banner-grp-col"} -->
    <div class="wp-block-columns banner-grp-col"><!-- wp:column {"verticalAlignment":"center","width":"90%"} -->
    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:90%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"100px","bottom":"100px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-group" style="padding-top:100px;padding-bottom:100px"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->
    <div class="wp-block-columns"><!-- wp:column {"width":"30%"} -->
    <div class="wp-block-column" style="flex-basis:30%"></div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"70%"} -->
    <div class="wp-block-column" style="flex-basis:70%"><!-- wp:heading {"textAlign":"right","className":"banner-heading-main wow fadeInUp","style":{"elements":{"link":{"color":{"text":"var:preset|color|secaccent"}}},"typography":{"fontSize":"50px","fontStyle":"normal","fontWeight":"600"}},"textColor":"secaccent","fontFamily":"teko"} -->
    <h2 class="wp-block-heading has-text-align-right banner-heading-main wow fadeInUp has-secaccent-color has-text-color has-link-color has-teko-font-family" style="font-size:50px;font-style:normal;font-weight:600">'. esc_html__('Discover the Joy of Summer Adventures','day-camp').'</h2>
    <!-- /wp:heading --></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|20"}}}} -->
    <div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"70%"} -->
    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:70%"><!-- wp:group {"className":"trek-section-grid owl-carousel","style":{"spacing":{"padding":{"left":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-group trek-section-grid owl-carousel" style="padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-group"><!-- wp:image {"id":156,"sizeSlug":"full","linkDestination":"none"} -->
    <figure class="wp-block-image size-full"><img src="'.esc_url(get_template_directory_uri()) .'/assets/images/banner01.png" alt="" class="wp-image-156"/></figure>
    <!-- /wp:image --></div>
    <!-- /wp:group -->

    <!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-group"><!-- wp:image {"id":157,"sizeSlug":"full","linkDestination":"none"} -->
    <figure class="wp-block-image size-full"><img src="'.esc_url(get_template_directory_uri()) .'/assets/images/banner02.png" alt="" class="wp-image-157"/></figure>
    <!-- /wp:image --></div>
    <!-- /wp:group -->

    <!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-group"><!-- wp:image {"id":158,"sizeSlug":"full","linkDestination":"none"} -->
    <figure class="wp-block-image size-full"><img src="'.esc_url(get_template_directory_uri()) .'/assets/images/banner03.png" alt="" class="wp-image-158"/></figure>
    <!-- /wp:image --></div>
    <!-- /wp:group -->

    <!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-group"><!-- wp:image {"id":157,"sizeSlug":"full","linkDestination":"none"} -->
    <figure class="wp-block-image size-full"><img src="'.esc_url(get_template_directory_uri()) .'/assets/images/banner02.png" alt="" class="wp-image-157"/></figure>
    <!-- /wp:image --></div>
    <!-- /wp:group --></div>
    <!-- /wp:group --></div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"30%"} -->
    <div class="wp-block-column" style="flex-basis:30%"><!-- wp:paragraph {"align":"right","className":"banner-text-para wow fadeInDown","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"400","lineHeight":"2"}},"textColor":"background","fontSize":"upper-heading","fontFamily":"poppins"} -->
    <p class="has-text-align-right banner-text-para wow fadeInDown has-background-color has-text-color has-link-color has-poppins-font-family has-upper-heading-font-size" style="font-style:normal;font-weight:400;line-height:2">'. esc_html__('Dive into an unforgettable summer filled with new friendships, exciting outdoor challenges, creative learning experiences, and nature-driven adventures designed to help every child grow, explore, and shine. From hands-on activities and team-building games to artistic expression and discovery in the great outdoors, each day is thoughtfully crafted to spark curiosity, build confidence, and encourage independence.','day-camp').'</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"style":{"spacing":{"blockGap":{"top":"0","left":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"right"}} -->
    <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"thirdaccent","className":"banner-btn01 wow fadeInRight","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px","bottomLeft":"12px","bottomRight":"12px"}},"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
    <div class="wp-block-button banner-btn01 wow fadeInRight"><a href="#" class="wp-block-button__link has-thirdaccent-background-color has-background wp-element-button" style="border-top-left-radius:12px;border-top-right-radius:12px;border-bottom-left-radius:12px;border-bottom-right-radius:12px;font-style:normal;font-weight:500">'. esc_html__('Register Now','day-camp').'</a></div>
    <!-- /wp:button -->

    <!-- wp:button {"textColor":"thirdaccent","className":"is-style-fill banner-btn02 wow fadeInLeft","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px","bottomLeft":"12px","bottomRight":"12px"},"width":"2px"},"typography":{"fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|thirdaccent"}}}},"borderColor":"thirdaccent"} -->
    <div class="wp-block-button is-style-fill banner-btn02 wow fadeInLeft"><a href="#" class="wp-block-button__link has-thirdaccent-color has-text-color has-link-color has-border-color has-thirdaccent-border-color wp-element-button" style="border-width:2px;border-top-left-radius:12px;border-top-right-radius:12px;border-bottom-left-radius:12px;border-bottom-right-radius:12px;font-style:normal;font-weight:500">'. esc_html__('Explore Programs','day-camp').'</a></div>
    <!-- /wp:button --></div>
    <!-- /wp:buttons --></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns --></div>
    <!-- /wp:group -->

    <!-- wp:paragraph -->
    <p></p>
    <!-- /wp:paragraph --></div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"10%"} -->
    <div class="wp-block-column" style="flex-basis:10%"></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns --></div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"summer-camp-banner-section-bottom","style":{"dimensions":{"minHeight":"5px"}},"backgroundColor":"fourthaccent","layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-group summer-camp-banner-section-bottom has-fourthaccent-background-color has-background" style="min-height:5px"></div>
    <!-- /wp:group -->',
);