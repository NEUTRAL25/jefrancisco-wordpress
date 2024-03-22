<?php
/**
 * Title: Latest News
 * Slug: construction-blocks/latest-news
 * Categories: construction-blocks, latest-news
 */
?>

<!-- wp:group {"className":"latest-news","layout":{"type":"constrained","contentSize":"70%"}} -->
<div class="wp-block-group latest-news"><!-- wp:spacer {"height":"18px"} -->
<div style="height:18px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontFamily":"inter"} -->
<h3 class="wp-block-heading has-text-align-center has-inter-font-family" style="font-style:normal;font-weight:700"><?php esc_html_e('Latest News','construction-blocks'); ?></h3>
<!-- /wp:heading -->

<!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"backgroundColor":"primary"} -->
<hr class="wp-block-separator has-text-color has-primary-color has-alpha-channel-opacity has-primary-background-color has-background" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"18px"} -->
<div style="height:18px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query {"queryId":36,"query":{"perPage":17,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true}} -->
<div class="wp-block-query"><!-- wp:post-template {"className":"latest-blogs","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"className":"wow swing blog-box-upper","layout":{"type":"constrained"}} -->
<div class="wp-block-group wow swing blog-box-upper" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"className":"blog-box","layout":{"type":"default"}} -->
<div class="wp-block-group blog-box"><!-- wp:post-featured-image {"align":"center"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"className":"date-box","layout":{"type":"default"}} -->
<div class="wp-block-group date-box" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:post-date {"textAlign":"center","format":"j","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"typography":{"fontStyle":"normal","fontWeight":"700"}},"backgroundColor":"white","fontSize":"extra-large"} /-->

<!-- wp:post-date {"textAlign":"center","format":"M ","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"backgroundColor":"primary","textColor":"white"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:post-author-name {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}},"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"secondary","fontSize":"small"} /-->

<!-- wp:post-title {"level":5} /-->

<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:read-more {"style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"border":{"bottom":{"color":"var:preset|color|primary","width":"2px"},"top":{},"right":{},"left":{}},"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"primary","fontSize":"small"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p class="has-text-align-center"><?php esc_html_e('There is no post found','construction-blocks'); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->