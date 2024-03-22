<?php
/**
 * Title: Banner
 * Slug: construction-blocks/banner
 * Categories: construction-blocks, banner
 */
?>

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0px"},"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"className":"bannerimage","layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group bannerimage" style="margin-top:0px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() . '/images/banner.jpg'); ?>","id":21,"dimRatio":70,"customOverlayColor":"#43444a","focalPoint":{"x":0.5,"y":0.29},"minHeight":900,"minHeightUnit":"px","align":"wide","className":"banner-image-cover","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-cover alignwide banner-image-cover" style="min-height:900px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70 has-background-dim" style="background-color:#43444a"></span><img class="wp-block-cover__image-background wp-image-21" alt="" src="<?php echo esc_url( get_template_directory_uri() . '/images/banner.jpg'); ?>" style="object-position:50% 29%" data-object-fit="cover" data-object-position="50% 29%"/><div class="wp-block-cover__inner-container"><!-- wp:columns {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"50%","className":"banner-content wow flipInX"} -->
<div class="wp-block-column is-vertically-aligned-center banner-content wow flipInX" style="flex-basis:50%"><!-- wp:heading {"level":6,"style":{"typography":{"letterSpacing":"2px","textTransform":"uppercase","fontStyle":"normal","fontWeight":"300"},"color":{"background":"#00000052"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0","left":"0","right":"0"}}},"className":"short-heading","fontSize":"extra-small"} -->
<h6 class="wp-block-heading short-heading has-background has-extra-small-font-size" style="background-color:#00000052;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-style:normal;font-weight:300;letter-spacing:2px;text-transform:uppercase"><?php esc_html_e('START WORK WITH US','construction-blocks'); ?></h6>
<!-- /wp:heading -->

<!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
<h2 class="wp-block-heading has-white-color has-text-color has-link-color"><?php esc_html_e('The Best Company For Construction Estate','construction-blocks'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
<p class="has-white-color has-text-color has-link-color"><?php esc_html_e('Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.','construction-blocks'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"banner-btn"} -->
<div class="wp-block-buttons banner-btn"><!-- wp:button {"style":{"typography":{"letterSpacing":"2px"},"border":{"radius":"0px"}}} -->
<div class="wp-block-button" style="letter-spacing:2px"><a class="wp-block-button__link wp-element-button" style="border-radius:0px"><?php esc_html_e('READ MORE','construction-blocks'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-vertically-aligned-center"} -->
<div class="wp-block-column is-vertically-aligned-center"></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->