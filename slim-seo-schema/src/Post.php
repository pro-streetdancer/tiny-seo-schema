<?php
namespace SlimSEOPro\Schema;

use eLightUp\PluginUpdater\Manager;
use SlimSEOPro\Schema\Support\Data as SupportData;

class Post {
	private $manager;

	public function __construct( Manager $manager ) {
		$this->manager = $manager;

		add_action( 'admin_print_styles-post-new.php', [ $this, 'enqueue' ] );
		add_action( 'admin_print_styles-post.php', [ $this, 'enqueue' ] );

		add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
		add_action( 'save_post', [ $this, 'save' ] );
	}

	public function enqueue() {
		global $post;
		$post_types = $this->get_post_types();
		if ( ! in_array( $post->post_type, $post_types, true ) ) {
			return;
		}

		wp_enqueue_style( 'slim-seo-schema', SLIM_SEO_SCHEMA_URL . 'css/schema.css', [ 'wp-components' ], filemtime( SLIM_SEO_SCHEMA_DIR . '/css/schema.css' ) );

		if ( $this->manager->option->get_license_status() !== 'active' ) {
			return;
		}

		wp_enqueue_style( 'slim-seo-settings', 'https://cdn.jsdelivr.net/gh/elightup/slim-seo@master/css/settings.css', [], '1' );
		wp_enqueue_style( 'slim-seo-react-tabs', 'https://cdn.jsdelivr.net/gh/elightup/slim-seo@master/css/react-tabs.css', [], '1' );
		wp_enqueue_media();
		wp_enqueue_script( 'slim-seo-schema', SLIM_SEO_SCHEMA_URL . 'js/post.js', [ 'wp-element', 'wp-components', 'wp-i18n', 'wp-hooks' ], filemtime( SLIM_SEO_SCHEMA_DIR . '/js/post.js' ), true );

		$localized_data = [
			'rest'            => untrailingslashit( rest_url() ),
			'nonce'           => wp_create_nonce( 'wp_rest' ),
			'mediaPopupTitle' => __( 'Select An Image', 'slim-seo-schema' ),
			'schema'          => get_post_meta( $post->ID, 'slim_seo_schema', true ) ?: [],
		];
		wp_localize_script( 'slim-seo-schema', 'SSSchema', $localized_data );
	}

	public function add_meta_box() {
		$context  = apply_filters( 'slim_seo_meta_box_context', 'normal' );
		$priority = apply_filters( 'slim_seo_meta_box_priority', 'low' );

		$post_types = $this->get_post_types();
		foreach ( $post_types as $post_type ) {
			add_meta_box( 'schema', __( 'Schema', 'slim-seo-schema' ), [ $this, 'render' ], $post_type, $context, $priority );
		}
	}

	private function get_post_types() {
		$post_types = get_post_types( [ 'public' => true ] );
		unset( $post_types['attachment'] );
		$post_types = apply_filters( 'slim_seo_meta_box_post_types', $post_types );

		return $post_types;
	}

	public function save( $post_id ) {
		// Verify nonce.
		$nonce = isset( $_POST['sss_nonce'] ) ? (string) $_POST['sss_nonce'] : '';
		if ( ! wp_verify_nonce( $nonce, 'save-schema' ) ) {
			return;
		}

		// Save data to the post, not revisions.
		$parent  = wp_is_post_revision( $post_id );
		$post_id = $parent ? $parent : $post_id;

		// Get only one schema.
		$schema = isset( $_POST['schemas'] ) ? wp_unslash( $_POST['schemas'] ) : [];
		$schema = isset( $schema['post'] ) ? $schema['post'] : [];

		if ( empty( $schema ) ) {
			delete_post_meta( $post_id, 'slim_seo_schema' );
		} else {
			update_post_meta( $post_id, 'slim_seo_schema', $schema );
		}
	}

	public function render() {
		$status = $this->manager->option->get_license_status();

		if ( $status === 'active' ) {
			wp_nonce_field( 'save-schema', 'sss_nonce' );
			echo '<div id="sss-post"></div>';
			return;
		}

		$messages = SupportData::plugin_warning_messages();
		?>
		<div class="ss-license-warning">
			<h2>
				<span class="dashicons dashicons-warning"></span>
				<?php esc_html_e( 'License Warning', 'slim-seo-schema' ) ?>
			</h2>
			<?= wp_kses_post( sprintf( $messages[ $status ], admin_url( 'options-general.php?page=slim-seo#license' ), 'https://elu.to/sua' ) ); ?>
		</div>
		<?php
	}
}
