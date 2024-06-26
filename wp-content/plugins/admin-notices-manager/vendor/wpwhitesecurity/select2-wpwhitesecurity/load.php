<?php // phpcs:disable WordPress.WP.I18n.UnorderedPlaceholdersText

/**
 * Library core class file.
 *
 * @package    WordPress
 * @subpackage s24wp
 */

if ( ! class_exists( '\S24WP' ) ) {

	/**
	 * Core class of the library. The name stands for "Select 2 for WordPress".
	 *
	 * @since 1.0.0
	 */
	class S24WP {

		/**
		 * Action parameter for the AJAX call.
		 *
		 * @var string
		 */
		private static $ajax_action = 'wpws_s24wp';

		/**
		 * Prefix for the autogenerated HTML field IDs.
		 *
		 * @var string
		 */
		private static $id_prefix = 'wpw-select2-';

		/**
		 * Number of UI controls generated. Used to ensure unique HTML element IDs.
		 *
		 * @var int
		 */
		private static $id_counter = 0;

		/**
		 * True once the scripts were queued. We only want to include them once.
		 *
		 * @var bool
		 */
		private static $scripts_queued = false;

		/**
		 * Full URL to the root folder of the library. This depends on a plugin or theme where the library is used.
		 *
		 * @var string
		 */
		private static $base_url;

		/**
		 * Initializes the library with given base URL.
		 *
		 * @param string $lib_base_url URL pointing to the root of the library.
		 */
		public static function init( $lib_base_url ) {
			self::$base_url = $lib_base_url;

			if ( ! has_action( 'wp_ajax_' . self::$ajax_action, array( __CLASS__, 'handle_ajax_call' ) ) ) {
				add_action( 'wp_ajax_' . self::$ajax_action, array( __CLASS__, 'handle_ajax_call' ) );
			}
		}

		/**
		 * Handles AJAX requests from the autocomplete controls.
		 */
		public static function handle_ajax_call() {

			// TODO verify nonce

			// Check the 'entity' parameter.
			if ( ! array_key_exists( 'entity', $_REQUEST ) ) {
				wp_send_json_error( 'Data type not defined.' );
			}

			if ( ! array_key_exists( 'term', $_REQUEST ) ) {
				wp_send_json_error( 'Search term is missing.' );
			}

			$result      = array();
			$entity      = sanitize_text_field( wp_unslash( trim( $_REQUEST['entity'] ) ) );
			$search_term = sanitize_text_field( wp_unslash( trim( $_REQUEST['term'] ) ) );
			switch ( $entity ) {
				case 'user':
					$result = self::get_users( $search_term );
					break;
				case 'post':
					$result = self::get_posts( $search_term );
					break;
				default:
					wp_send_json_error( 'Unsupported data type.' );
			}

			echo wp_json_encode(
				array(
					'results' => $result,
				)
			);
			die();
		}

		/**
		 * Get the user id through ajax, used in 'select2'.
		 *
		 * @param string $search_term Search term.
		 *
		 * @return array
		 */
		public static function get_users( $search_term = null ) {
			$result       = array();
			$query_params = array();
			if ( ! is_null( $search_term ) ) {
				$query_params['search']         = '*' . $search_term . '*';
				$query_params['search_columns'] = array( 'user_login', 'user_email' );
			}

			$users = get_users( $query_params );

			if ( empty( $users ) ) {
				return $result;
			}

			return array_map( array( __CLASS__, 'convert_object_to_select2_data' ), $users );
		}

		/**
		 * Converts given object to data that can be consumed by select2 library.
		 *
		 * @param object $object User, post or other supported object.
		 *
		 * @return array|void
		 */
		private static function convert_object_to_select2_data( $object ) {
			if ( $object instanceof WP_User ) {
				return array(
					'id'   => $object->ID,
					'text' => $object->user_login . ' (' . $object->user_email . ')',
				);
			}

			if ( $object instanceof WP_Post ) {

				$post_title = $object->post_title;
				if ( strlen( $post_title ) > 50 ) {
					$post_title = substr( $post_title, 0, 50 ) . '...';
				}

				$post_id = $object->ID;

				return array(
					'id'   => $post_id,
					'text' => $post_title . ' (' . $post_id . ')',
				);

			}

		}

		/**
		 * Handles AJAX calls to retrieve post data to be used in 'select2'.
		 *
		 * @param string $search_term Search term.
		 *
		 * @return array
		 */
		public static function get_posts( $search_term ) {
			$result = array();

			$args = array(
				'search_post_title' => $search_term, // Search post title only.
				'suppress_filters'  => false,
				'post_status'       => 'publish',
			);
			add_filter( 'posts_where', array( __CLASS__, 'search_post_title' ), 10, 2 );
			$posts = get_posts( $args );
			remove_filter( 'posts_where', array( __CLASS__, 'search_post_title' ), 10 );

			if ( empty( $posts ) ) {
				return $result;
			}

			return array_map( array( __CLASS__, 'convert_object_to_select2_data' ), $posts );
		}

		/**
		 * Renders all the HTML, CSS and JS code necessary to display select2 form control configure using given parameters.
		 *
		 * @param array $args Select form control parameters.
		 */
		public static function insert( $args ) {

			// name - string
			// data-type - user, role, post
			// placeholder - string
			// width - int (pixels)
			// id - string
			// multiple - bool
			// min_chars - int (minimum number of characters to type before searching)
			// selected - selected value or an array of values
			// extra_js_callback - function to call after the select2 init function is called, it should print additional JS if necessary, using "s2" as reference to the current select2 instance

			if ( ! isset( self::$base_url ) ) {
				// Library not initialized correctly.
				return;
			}

			if ( ! array_key_exists( 'name', $args ) ) {
				// Field name is missing.
				return;
			}

			if ( ! array_key_exists( 'data-type', $args ) && ! array_key_exists( 'data', $args ) ) {
				// No data source defined.
				return;
			}

			// Enqueue scripts.
			if ( ! self::$scripts_queued ) {
				self::enqueue_scripts();
			}

			$attributes = array(
				'name' => $args['name'],
			);

			if ( ! array_key_exists( 'id', $args ) ) {
				$args['id'] = self::$id_prefix . self::$id_counter ++;
			}

			$attributes['id'] = $args['id'];

			if ( array_key_exists( 'width', $args ) ) {
				$attributes['style'] = 'width: ' . $args['width'] . 'px;';
			}

			array_walk(
				$attributes,
				function ( &$value, $key ) {
					$value = $key . '="' . esc_attr( $value ) . '"';
				}
			);

			// @codingStandardsIgnoreStart
			echo '<select ' . implode( ' ', $attributes ) . '></select>';
			echo '<script type="application/javascript">';
			echo 'jQuery( document ).ready( function() {';
			echo 'const s2 = jQuery( "#' . $args['id'] . '" ).select2( {';
			if ( array_key_exists( 'placeholder', $args ) ) {
				echo 'placeholder: "' . $args['placeholder'] . '",';
			}
			echo 'containerCssClass: "s24wp-wrapper",';

			if ( array_key_exists( 'multiple', $args ) && true === $args['multiple'] ) {
				echo 'multiple: true,';
			}

			if ( array_key_exists( 'width', $args ) ) {
				echo 'width: "' . $args['width'] . 'px",';
			}
			// @codingStandardsIgnoreEnd

			if ( array_key_exists( 'data-type', $args ) && 'role' === $args['data-type'] ) {
				// Populate the roles' data. Local data source will be used.

				$role_names = wp_roles()->role_names;
				asort( $role_names );
				$roles_data = array();
				foreach ( $role_names as $slug => $label ) {
					$roles_data[] = array(
						'id'   => $slug,
						'text' => $label,
					);
				}

				$args['data'] = $roles_data;
				unset( $args['data-type'] );
			}

			/**
			 * Users are by default loaded from a remote AJAX data source.
			 *
			 * However, there is an option to use pre-loaded local data source if there is less than certain number of
			 * objects of given type in system.
			 *
			 * TODO consider support for posts
			 */
			$data_types_with_remote_source_option = array( 'user' );
			if ( array_key_exists( 'remote_source_threshold', $args ) && in_array( $args['data-type'], $data_types_with_remote_source_option, true ) ) {
				$threshold = intval( $args['remote_source_threshold'] );
				if ( $threshold > 0 ) {
					if ( 'user' === $args['data-type'] ) {
						$users_count = count_users( 'time' )['total_users'];
						if ( $users_count <= $threshold ) {
							$args['data'] = self::get_users();
							unset( $args['data-type'] );
						}
					}
				}
			}

			if ( array_key_exists( 'data', $args ) ) {
				echo 'data: ' . json_encode( $args['data'] );
			}

			$has_remote_source = array_key_exists( 'data-type', $args );
			if ( $has_remote_source ) {

				$url = admin_url( 'admin-ajax.php' ) . '?action=' . self::$ajax_action . '&entity=' . $args['data-type'];

				$min_chars = array_key_exists( 'min_chars', $args ) ? intval( $args['min_chars'] ) : 3;
				echo 'minimumInputLength: "' . $min_chars . '",';
				echo 'ajax: {';
				echo 'url : "' . $url . '",';
				echo 'dataType: "json"';
				echo '}';
			}

			echo '} );';

			if ( array_key_exists( 'extra_js_callback', $args ) && is_callable( $args['extra_js_callback'] ) ) {
				call_user_func( $args['extra_js_callback'], $attributes['id'] );
			}

			if ( array_key_exists( 'selected', $args ) && is_array( $args['selected'] ) ) {
				if ( $has_remote_source ) {
					foreach ( $args['selected'] as $selected_value ) {
						$data_type = $args['data-type'];
						if ( 'user' === $data_type ) {
							$object = get_user_by( 'ID', intval( $selected_value ) );
						} elseif ( 'post' === $data_type ) {
							$object = get_post( intval( $selected_value ) );
						}

						if ( isset( $object ) ) {
							$data_item = self::convert_object_to_select2_data( $object );
							if ( ! is_null( $data_item ) ) {
								echo 's2.append(new Option("' . $data_item['text'] . '", ' . $data_item['id'] . ', true, true)).trigger("change");';
							}
						}
					}
				}

				echo 's2.val(' . json_encode( $args['selected'] ) . ');';
				echo 's2.trigger("change");';
			}

			echo '} );';
			echo '</script>';
		}

		/**
		 * Enqueues necessary JS scripts and stylesheets.
		 */
		private static function enqueue_scripts() {
			if ( self::$scripts_queued ) {
				return;
			}

			wp_enqueue_style(
				'wpw-select2',
				self::$base_url . '/assets/css/select2.min.css',
				array(),
				'4.0.13'
			);

			wp_enqueue_style(
				'wpw-select2-overrides',
				self::$base_url . '/assets/css/wp-overrides.css',
				array( 'wpw-select2' ),
				'4.0.13'
			);

			wp_enqueue_script(
				'wpw-select2',
				self::$base_url . '/assets/js/select2.full.min.js',
				array( 'jquery' ),
				'4.0.13',
				true
			);

			self::$scripts_queued = true;
		}

		/**
		 * Alters WordPress query to search only by post title.
		 *
		 * @param string   $where    SQL WHERE statement.
		 * @param WP_Query $wp_query WordPress query object.
		 *
		 * @return string
		 */
		public static function search_post_title( $where, $wp_query ) {
			$search_term = $wp_query->get( 'search_post_title' );
			if ( $search_term ) {
				global $wpdb;
				$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . $wpdb->esc_like( $search_term ) . '%\'';
			}

			return $where;
		}
	}
}
