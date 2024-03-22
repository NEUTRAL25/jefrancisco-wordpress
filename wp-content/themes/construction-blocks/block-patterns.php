<?php
/**
 * Construction Blocks: Block Patterns
 *
 * @since Construction Blocks 1.0
 */

/**
 * Registers block patterns and categories.
 *
 * @since Construction Blocks 1.0
 *
 * @return void
 */
function construction_blocks_register_block_patterns() {
	$block_pattern_categories = array(
		'construction-blocks'    => array( 'label' => __( 'Construction Blocks', 'construction-blocks' ) ),
	);

	$block_pattern_categories = apply_filters( 'construction_blocks_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}
}
add_action( 'init', 'construction_blocks_register_block_patterns', 9 );
