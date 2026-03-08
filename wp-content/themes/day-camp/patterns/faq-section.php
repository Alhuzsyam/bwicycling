<?php
/**
 * FAQ Section
 * 
 * slug: day-camp/faq-section
 * title: FAQ Section
 * categories: day-camp
 */

    return array(
        'title'      =>__( 'FAQ Section', 'day-camp' ),
        'categories' => array( 'day-camp' ),
        'content'    => '<!-- wp:group {"className":"faq-section","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"right":"0","left":"0","top":"0","bottom":"0"}}},"backgroundColor":"secaccent","layout":{"type":"constrained","contentSize":"100%"}} -->
        <div class="wp-block-group faq-section has-secaccent-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"overlayColor":"background","isUserOverlayColor":true,"isDark":false,"sizeSlug":"large","layout":{"type":"constrained","contentSize":"80%"}} -->
        <div class="wp-block-cover is-light"><span aria-hidden="true" class="wp-block-cover__background has-background-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"},"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}}} -->
        <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:column {"className":"faq-left wow zoomInLeft","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
        <div class="wp-block-column faq-left wow zoomInLeft"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|thirdaccent"}}},"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"17px"}},"textColor":"thirdaccent","fontFamily":"poppins"} -->
        <p class="has-thirdaccent-color has-text-color has-link-color has-poppins-font-family" style="font-size:17px;font-style:normal;font-weight:500">'. esc_html__('Frequently Asked Questions','day-camp').'</p>
        <!-- /wp:paragraph -->

        <!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"26px"},"elements":{"link":{"color":{"text":"var:preset|color|accent"}}}},"textColor":"accent","fontFamily":"poppins"} -->
        <h2 class="wp-block-heading has-accent-color has-text-color has-link-color has-poppins-font-family" style="font-size:26px;font-style:normal;font-weight:600">'. esc_html__('Have Any Questions For Us?','day-camp').'</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"className":"short-para-text","style":{"typography":{"fontStyle":"normal","fontWeight":"400","lineHeight":"1.8"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"spacing":{"padding":{"bottom":"var:preset|spacing|30"}}},"textColor":"primary","fontSize":"extra-small","fontFamily":"poppins"} -->
        <p class="short-para-text has-primary-color has-text-color has-link-color has-poppins-font-family has-extra-small-font-size" style="padding-bottom:var(--wp--preset--spacing--30);font-style:normal;font-weight:400;line-height:1.8">'. esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s','day-camp').'</p>
        <!-- /wp:paragraph -->

        <!-- wp:image {"id":8,"sizeSlug":"full","linkDestination":"none","style":{"border":{"width":"0px","style":"none"}}} -->
        <figure class="wp-block-image size-full has-custom-border"><img src="'.esc_url(get_template_directory_uri()) .'/assets/images/FAQ.png" alt="" class="wp-image-8" style="border-style:none;border-width:0px"/></figure>
        <!-- /wp:image --></div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"faq-right wow zoomInRight","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
        <div class="wp-block-column faq-right wow zoomInRight"><!-- wp:details {"showContent":true,"className":"faq-list","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
        <details class="wp-block-details faq-list" style="font-style:normal;font-weight:500" open><summary>'. esc_html__('What age groups can join the camp?','day-camp').'</summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary"} -->
        <p class="has-primary-color has-text-color has-link-color">'. esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown prpoppins took a galley of type and scrambled it to make a type specimen book.','day-camp').'</p>
        <!-- /wp:paragraph --></details>
        <!-- /wp:details -->

        <!-- wp:details {"className":"faq-list","style":{"typography":{"fontStyle":"normal","fontWeight":"400"}}} -->
        <details class="wp-block-details faq-list" style="font-style:normal;font-weight:400"><summary>'. esc_html__('Are activities fully supervised?','day-camp').'</summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"typography":{"fontStyle":"normal","fontWeight":"400"}},"textColor":"primary"} -->
        <p class="has-primary-color has-text-color has-link-color" style="font-style:normal;font-weight:400">'. esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown prpoppins took a galley of type and scrambled it to make a type specimen book.','day-camp').'</p>
        <!-- /wp:paragraph --></details>
        <!-- /wp:details -->

        <!-- wp:details {"className":"faq-list","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
        <details class="wp-block-details faq-list" style="font-style:normal;font-weight:500"><summary>'. esc_html__('Is the camp safe for children?','day-camp').'</summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary"} -->
        <p class="has-primary-color has-text-color has-link-color">'. esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown prpoppins took a galley of type and scrambled it to make a type specimen book.','day-camp').'</p>
        <!-- /wp:paragraph --></details>
        <!-- /wp:details -->

        <!-- wp:details {"className":"faq-list","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
        <details class="wp-block-details faq-list" style="font-style:normal;font-weight:500"><summary>'. esc_html__('What should campers bring?','day-camp').'</summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary"} -->
        <p class="has-primary-color has-text-color has-link-color">'. esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown prpoppins took a galley of type and scrambled it to make a type specimen book.','day-camp').'</p>
        <!-- /wp:paragraph --></details>
        <!-- /wp:details -->

        <!-- wp:details {"className":"faq-list","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
        <details class="wp-block-details faq-list" style="font-style:normal;font-weight:500"><summary>'. esc_html__('How do I register my child?','day-camp').'</summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"typography":{"fontStyle":"normal","fontWeight":"400"}},"textColor":"primary"} -->
        <p class="has-primary-color has-text-color has-link-color" style="font-style:normal;font-weight:400">'. esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown prpoppins took a galley of type and scrambled it to make a type specimen book.','day-camp').'</p>
        <!-- /wp:paragraph --></details>
        <!-- /wp:details --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:group -->',
    );