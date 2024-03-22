<?php

add_action( 'admin_menu', 'construction_blocks_gettingstarted' );
function construction_blocks_gettingstarted() {
	add_theme_page( esc_html__('Theme Documentation', 'construction-blocks'), esc_html__('Theme Documentation', 'construction-blocks'), 'edit_theme_options', 'construction-blocks-guide-page', 'construction_blocks_guide');
}

function construction_blocks_admin_theme_style() {
   wp_enqueue_style('construction-blocks-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
}
add_action('admin_enqueue_scripts', 'construction_blocks_admin_theme_style');

if ( ! defined( 'CONSTRUCTION_BLOCKS_SUPPORT' ) ) {
define('CONSTRUCTION_BLOCKS_SUPPORT',__('https://wordpress.org/support/theme/construction-blocks/','construction-blocks'));
}
if ( ! defined( 'CONSTRUCTION_BLOCKS_REVIEW' ) ) {
define('CONSTRUCTION_BLOCKS_REVIEW',__('https://wordpress.org/support/theme/construction-blocks/reviews/','construction-blocks'));
}
if ( ! defined( 'CONSTRUCTION_BLOCKS_LIVE_DEMO' ) ) {
define('CONSTRUCTION_BLOCKS_LIVE_DEMO',__('https://www.ovationthemes.com/demos/construction-firm/','construction-blocks'));
}
if ( ! defined( 'CONSTRUCTION_BLOCKS_BUY_PRO' ) ) {
define('CONSTRUCTION_BLOCKS_BUY_PRO',__('https://www.ovationthemes.com/wordpress/construction-wordpress-theme/','construction-blocks'));
}
if ( ! defined( 'CONSTRUCTION_BLOCKS_PRO_DOC' ) ) {
define('CONSTRUCTION_BLOCKS_PRO_DOC',__('https://ovationthemes.com/docs/ot-construction-firm-pro-doc/','construction-blocks'));
}
if ( ! defined( 'CONSTRUCTION_BLOCKS_FREE_DOC' ) ) {
define('CONSTRUCTION_BLOCKS_FREE_DOC',__('https://ovationthemes.com/docs/ot-construction-firm-free-doc/','construction-blocks'));
}
if ( ! defined( 'CONSTRUCTION_BLOCKS_THEME_NAME' ) ) {
define('CONSTRUCTION_BLOCKS_THEME_NAME',__('Premium Construction Blocks Theme','construction-blocks'));
}

/**
 * Theme Info Page
 */
function construction_blocks_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$construction_blocks_theme = wp_get_theme( '' ); ?>

	<div class="getting-started__header">
		<div class="col-md-10">
			<h2><?php echo esc_html( $construction_blocks_theme ); ?></h2>
			<p><?php esc_html_e('Version: ', 'construction-blocks'); ?><?php echo esc_html($construction_blocks_theme['Version']);?></p>
		</div>
		<div class="col-md-2">
			<div class="btn_box">
				<a class="button-primary" href="<?php echo esc_url( CONSTRUCTION_BLOCKS_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'construction-blocks'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( CONSTRUCTION_BLOCKS_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'construction-blocks'); ?></a>
			</div>
		</div>
	</div>

	<div class="wrap getting-started">
		<div class="container">
			<div class="col-md-9">
				<div class="leftbox">
					<h3><?php esc_html_e('Documentation','construction-blocks'); ?></h3>
					<p><?php $construction_blocks_theme = wp_get_theme(); 
						echo wp_kses_post( apply_filters( 'description', esc_html( $construction_blocks_theme->get( 'Description' ) ) ) );
					?></p>

					<h4><?php esc_html_e('Edit Your Site','construction-blocks'); ?></h4>
					<p><?php esc_html_e('Now create your website with easy drag and drop powered by gutenburg.','construction-blocks'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url() . 'site-editor.php' ); ?>" target="_blank"><?php esc_html_e('Edit Your Site','construction-blocks'); ?></a>

					<h4><?php esc_html_e('Visit Your Site','construction-blocks'); ?></h4>
					<p><?php esc_html_e('To check your website click here','construction-blocks'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( home_url() ); ?>" target="_blank"><?php esc_html_e('Visit Your Site','construction-blocks'); ?></a>

					<h4><?php esc_html_e('Theme Documentation','construction-blocks'); ?></h4>
					<p><?php esc_html_e('Check the theme documentation to easily set up your website.','construction-blocks'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( CONSTRUCTION_BLOCKS_FREE_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation','construction-blocks'); ?></a>
				</div>
       	</div>
			<div class="col-md-3">
				<h3><?php echo esc_html(CONSTRUCTION_BLOCKS_THEME_NAME); ?></h3>
				<img class="construction_blocks_img_responsive" style="width: 100%;" src="<?php echo esc_url( $construction_blocks_theme->get_screenshot() ); ?>" />
				<div class="pro-links">
					<hr>
			    	<a class="button-primary livedemo" href="<?php echo esc_url( CONSTRUCTION_BLOCKS_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'construction-blocks'); ?></a>
					<a class="button-primary buynow" href="<?php echo esc_url( CONSTRUCTION_BLOCKS_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'construction-blocks'); ?></a>
					<a class="button-primary docs" href="<?php echo esc_url( CONSTRUCTION_BLOCKS_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'construction-blocks'); ?></a>
					<hr>
				</div>
				<ul style="padding-top:10px">
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'construction-blocks');?> </li>                 
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'construction-blocks');?> </li>
					<li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'construction-blocks');?> </li>
               <li class="upsell-construction_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'construction-blocks');?> </li>
            </ul>
        	</div>
		</div>
	</div>

<?php }?>