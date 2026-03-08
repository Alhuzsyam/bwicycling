<?php
/**
 * Team Section
 * 
 * slug: day-camp/trek-section
 * title: Team Section
 * categories: day-camp
 */


$day_camp_active_plugins = get_option('active_plugins');

$day_camp_plugin_one = 'wp-travel/wp-travel.php';
$day_camp_plugin_two = 'wp-travel-blocks/wp-travel-blocks.php';

$day_camp_plugin_one_active = in_array($day_camp_plugin_one, $day_camp_active_plugins);
$day_camp_plugin_two_active = in_array($day_camp_plugin_two, $day_camp_active_plugins);

if ( $day_camp_plugin_one_active && $day_camp_plugin_two_active ){

    return array(
        'title'      =>__( 'Team Section', 'day-camp' ),
        'categories' => array( 'day-camp' ),
        'content'    => '<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"100%"}} -->
        <div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|thirdaccent"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"thirdaccent","fontSize":"medium","fontFamily":"poppins"} -->
        <p class="has-text-align-center has-thirdaccent-color has-text-color has-link-color has-poppins-font-family has-medium-font-size" style="font-style:normal;font-weight:500">'. esc_html__('Our Programs','day-camp').'</p>
        <!-- /wp:paragraph -->

        <!-- wp:heading {"textAlign":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent"}}},"typography":{"fontSize":"30px"}},"textColor":"accent","fontFamily":"teko"} -->
        <h2 class="wp-block-heading has-text-align-center has-accent-color has-text-color has-link-color has-teko-font-family" style="font-size:30px">'. esc_html__('Our Adventure Programs','day-camp').'</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}}},"fontSize":"medium"} -->
        <p class="has-text-align-center has-medium-font-size" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0">'. esc_html__('Choose from engaging and age-appropriate summer camp experiences.','day-camp').'</p>
        <!-- /wp:paragraph -->

        <!-- wp:group {"className":"dynamic-trek-section wow zoomIn","layout":{"type":"constrained","contentSize":"100%"}} -->
        <div class="wp-block-group dynamic-trek-section wow zoomIn"><!-- wp:wp-travel-blocks/trips-list {"patternSlug":"post-cat","query":{"numberOfItems":6,"orderBy":"title","order":"asc"},"layoutType":"layout-four","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} /--></div>
        <!-- /wp:group --></div>
        <!-- /wp:group -->

        <!-- wp:spacer {"height":"30px"} -->
        <div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->',
    );

    } else {

    return array(
        'title'      =>__( 'Team Section', 'day-camp' ),
        'categories' => array( 'day-camp' ),
        'content'    => '<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|thirdaccent"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"thirdaccent","fontSize":"medium","fontFamily":"poppins"} -->
<p class="has-text-align-center has-thirdaccent-color has-text-color has-link-color has-poppins-font-family has-medium-font-size" style="font-style:normal;font-weight:500">'. esc_html__('Our Programs','day-camp').'</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent"}}},"typography":{"fontSize":"30px"}},"textColor":"accent","fontFamily":"teko"} -->
<h2 class="wp-block-heading has-text-align-center has-accent-color has-text-color has-link-color has-teko-font-family" style="font-size:30px">'. esc_html__('Our Adventure Programs','day-camp').'</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"fontSize":"medium"} -->
<p class="has-text-align-center has-medium-font-size" style="padding-top:0;padding-bottom:0">'. esc_html__('Choose from engaging and age-appropriate summer camp experiences.','day-camp').'</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"adventure-trek-grp owl-carousel wow zoomIn","layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-grp owl-carousel wow zoomIn"><!-- wp:group {"className":"adventure-trek-section","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:group {"className":"adventure-trek-section-img","layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section-img"><!-- wp:image {"id":91,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.esc_url(get_template_directory_uri()) .'/assets/images/trek01.png" alt="" class="wp-image-91"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"adventure-trek-section-content","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section-content" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40);padding-top:0;padding-right:var(--wp--preset--spacing--40);padding-bottom:0;padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontSize":"20px"}},"textColor":"background"} -->
<h2 class="wp-block-heading has-background-color has-text-color has-link-color" style="font-size:20px">'. esc_html__('Nature Trek','day-camp').'</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"adventure-trek-section-content-row","style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"},"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"#ffffffb3","width":"1px"},"top":{},"right":{},"left":{}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group adventure-trek-section-content-row" style="border-bottom-color:#ffffffb3;border-bottom-width:1px;margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20);padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-calendar"></i>'. esc_html__(' 7 January 2026','day-camp').'</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-location-dot"></i>'. esc_html__(' Eagle Ridge','day-camp').'</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-users"></i>'. esc_html__(' 20','day-camp').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"background","fontSize":"normal"} -->
<p class="has-background-color has-text-color has-link-color has-normal-font-size" style="font-style:normal;font-weight:600">'. esc_html__('$105.00','day-camp').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"adventure-trek-section","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:group {"className":"adventure-trek-section-img","layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section-img"><!-- wp:image {"id":19,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.esc_url(get_template_directory_uri()) .'/assets/images/trek02.png" alt="" class="wp-image-19"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"adventure-trek-section-content","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section-content" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40);padding-top:0;padding-right:var(--wp--preset--spacing--40);padding-bottom:0;padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontSize":"20px"}},"textColor":"background"} -->
<h2 class="wp-block-heading has-background-color has-text-color has-link-color" style="font-size:20px">'. esc_html__('Outdoor Skills Camp','day-camp').'</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"adventure-trek-section-content-row","style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"},"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"#ffffffb3","width":"1px"},"top":{},"right":{},"left":{}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group adventure-trek-section-content-row" style="border-bottom-color:#ffffffb3;border-bottom-width:1px;margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20);padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-calendar"></i>'. esc_html__(' 7 January 2026','day-camp').'</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-location-dot"></i>'. esc_html__(' Greenwood','day-camp').'</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-users"></i>'. esc_html__(' 20','day-camp').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"background","fontSize":"normal"} -->
<p class="has-background-color has-text-color has-link-color has-normal-font-size" style="font-style:normal;font-weight:600">'. esc_html__('$105.00','day-camp').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"adventure-trek-section","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:group {"className":"adventure-trek-section-img","layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section-img"><!-- wp:image {"id":20,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.esc_url(get_template_directory_uri()) .'/assets/images/trek03.png" alt="" class="wp-image-20"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"adventure-trek-section-content","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group adventure-trek-section-content" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40);padding-top:0;padding-right:var(--wp--preset--spacing--40);padding-bottom:0;padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontSize":"20px"}},"textColor":"background"} -->
<h2 class="wp-block-heading has-background-color has-text-color has-link-color" style="font-size:20px">'. esc_html__('Rock Climb Basics','day-camp').'</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"adventure-trek-section-content-row","style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"},"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"#ffffffb3","width":"1px"},"top":{},"right":{},"left":{}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group adventure-trek-section-content-row" style="border-bottom-color:#ffffffb3;border-bottom-width:1px;margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20);padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-calendar"></i>'. esc_html__(' 7 January 2026','day-camp').'</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-location-dot"></i>'. esc_html__(' Eagle Cliffs','day-camp').'</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"upper-heading"} -->
<p class="has-background-color has-text-color has-link-color has-upper-heading-font-size" style="font-style:normal;font-weight:500"><i class="fa-solid fa-users"></i>'. esc_html__(' 20','day-camp').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"background","fontSize":"normal"} -->
<p class="has-background-color has-text-color has-link-color has-normal-font-size" style="font-style:normal;font-weight:600">'. esc_html__('$105.00','day-camp').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"30px"} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->',
    );
}