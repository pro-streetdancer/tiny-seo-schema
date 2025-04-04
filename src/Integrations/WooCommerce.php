<?php
namespace SlimSEOPro\Schema\Integrations;

use DateTime;
use WP_REST_Request;

class WooCommerce {
	private $variant_str    = 'product.variants.';
	private $variant_prefix = 'index';

	public function __construct() {
		add_action( 'init', [ $this, 'init' ] );
	}

	public function init() {
		if ( ! function_exists( 'WC' ) ) {
			return;
		}
		add_filter( 'slim_seo_breadcrumbs_args', [ $this, 'change_breadcrumbs_taxonomy' ] );

		add_action( 'wp_footer', [ $this, 'remove_woocommerce_schema' ], 0 );

		add_filter( 'slim_seo_schema_variables', [ $this, 'add_variables' ] );
		add_filter( 'slim_seo_schema_data', [ $this, 'add_data' ] );
		add_filter( 'slim_seo_schema_props', [ $this, 'add_props' ] );

		// Add product type location rules.
		add_filter( 'slim_seo_schema_locations', [ $this, 'add_locations' ] );
		add_filter( 'slim_seo_schema_location_terms', [ $this, 'add_location_terms' ], 10, 2 );
		add_filter( 'slim_seo_schema_location_validate_singular', [ $this, 'validate_location' ], 10, 2 );
	}

	public function change_breadcrumbs_taxonomy( array $args ): array {
		$args['taxonomy'] = 'product_cat';
		return $args;
	}

	public function remove_woocommerce_schema() {
		remove_action( 'wp_footer', [ WC()->structured_data, 'output_structured_data' ] );
	}

	public function add_variables( $variables ) {
		$variables[] = [
			'label'   => 'WooCommerce',
			'options' => [
				'product.price'                      => __( 'Price', 'slim-seo-schema' ),
				'product.price_with_tax'             => __( 'Price including tax', 'slim-seo-schema' ),
				'product.sale_from'                  => __( 'Sale price date "From"', 'slim-seo-schema' ),
				'product.sale_to'                    => __( 'Sale price date "To"', 'slim-seo-schema' ),
				'product.sku'                        => __( 'SKU', 'slim-seo-schema' ),
				'product.stock'                      => __( 'Stock status', 'slim-seo-schema' ),
				'product.currency'                   => __( 'Currency', 'slim-seo-schema' ),
				'product.rating'                     => __( 'Rating value', 'slim-seo-schema' ),
				'product.review_count'               => __( 'Review count', 'slim-seo-schema' ),

				'product.low_price'                  => __( 'Low price (variable product)', 'slim-seo-schema' ),
				'product.high_price'                 => __( 'High price (variable product)', 'slim-seo-schema' ),
				'product.offer_count'                => __( 'Offer count (variable product)', 'slim-seo-schema' ),

				$this->variant_str . 'sku'           => __( 'Product variant SKU', 'slim-seo-schema' ),
				$this->variant_str . 'name'          => __( 'Product variant name', 'slim-seo-schema' ),
				$this->variant_str . 'url'           => __( 'Product variant URL', 'slim-seo-schema' ),
				$this->variant_str . 'image'         => __( 'Product variant image', 'slim-seo-schema' ),
				$this->variant_str . 'size'          => __( 'Product variant size', 'slim-seo-schema' ),
				$this->variant_str . 'color'         => __( 'Product variant color', 'slim-seo-schema' ),
				$this->variant_str . 'description'   => __( 'Product variant description', 'slim-seo-schema' ),
				$this->variant_str . 'sale_price'    => __( 'Product variant sale price', 'slim-seo-schema' ),
				$this->variant_str . 'regular_price' => __( 'Product variant regular price', 'slim-seo-schema' ),
				$this->variant_str . 'stock'         => __( 'Product variant stock status', 'slim-seo-schema' ),
			],
		];

		return $variables;
	}

	private function get_product() {
		$post = is_singular() ? get_queried_object() : get_post();
		return wc_get_product( $post );
	}

	private function get_product_variants( $product ): array {
		if ( ! $product->is_type( 'variable' ) ) {
			return [];
		}

		$return     = [];
		$variations = $product->get_available_variations();
		foreach ( $variations as $key => $variation ) {
			$return[ $this->variant_prefix . $key ] = $this->get_variant_data( $variation, $product->get_title() );
		}

		return $return;
	}

	public function add_data( array $data ): array {
		$product = $this->get_product();

		if ( empty( $product ) ) {
			return $data;
		}

		$price          = $product->get_price();
		$price_with_tax = wc_get_price_including_tax( $product, [ 'price' => $price ] );

		$sale_from = '';
		if ( $product->get_date_on_sale_from() ) {
			$sale_from = gmdate( 'Y-m-d', $product->get_date_on_sale_from()->getTimestamp() );
		}

		// By default, set the sale price is today + 1 month.
		$today   = gmdate( 'Y-m-d' );
		$sale_to = gmdate( 'Y-m-d', wc_string_to_timestamp( '+1 month' ) );

		// Sale already started.
		if ( $product->is_on_sale() ) {
			if ( $product->get_date_on_sale_to() ) {
				$sale_to = gmdate( 'Y-m-d', $product->get_date_on_sale_to()->getTimestamp() );
			}
		} else {
			// Sale hasn't started yet, so the regular price will be available until sale!
			if ( $sale_from > $today ) {
				$sale_to = gmdate( 'Y-m-d', wc_string_to_timestamp( $sale_from ) - DAY_IN_SECONDS );
			} elseif ( $sale_from === $today ) {
				$sale_to = $today;
			}
		}

		$low_price   = '';
		$high_price  = '';
		$offer_count = 0;
		$variants    = [];
		if ( $product->is_type( 'variable' ) ) {
			$low_price   = $product->get_variation_price( 'min', false );
			$low_price   = wc_get_price_including_tax( $product, [ 'price' => $low_price ] );
			$high_price  = $product->get_variation_price( 'max', false );
			$high_price  = wc_get_price_including_tax( $product, [ 'price' => $high_price ] );
			$offer_count = count( $product->get_children() );
			$variants    = $this->get_product_variants( $product );
		}

		$sku          = $product->get_sku();
		$currency     = get_woocommerce_currency();
		$rating       = $product->get_average_rating();
		$review_count = $product->get_review_count();

		$status = strtolower( $product->get_stock_status() );
		$status = $this->get_statuses()[ $status ] ?? 'InStock';
		$stock  = "https://schema.org/$status";

		$data['product'] = compact(
			'price',
			'price_with_tax',
			'low_price',
			'high_price',
			'offer_count',
			'sale_from',
			'sale_to',
			'sku',
			'stock',
			'currency',
			'rating',
			'review_count',
			'variants',
		);

		return $data;
	}

	public function add_props( array $props ): array {
		if ( empty( $props['@type'] ) || $props['@type'] !== 'ProductGroup' || empty( $props['hasVariant'] ) ) {
			return $props;
		}

		$product = $this->get_product();
		if ( empty( $product ) || $product->get_type() !== 'variable' ) {
			return $props;
		}

		$has_variant         = $props['hasVariant'];
		$props['hasVariant'] = [];

		$variants = $this->get_product_variants( $product );
		$count    = count( $variants );

		for ( $i = 0; $i < $count; $i++ ) {
			$new_twig_variable = $this->variant_str . $this->variant_prefix . $i . '.';
			$variant           = $this->update_twig_variables( $has_variant, $new_twig_variable );

			// Handle schema props size and color
			$attributes    = $variants[ $this->variant_prefix . $i ]['attributes'];
			$special_props = [ 'size', 'color' ];
			array_walk( $special_props, function ( $prop ) use ( &$variant, $attributes ) {
				if ( isset( $variant[ $prop ] ) && ! empty( $attributes[ $prop ] ) ) {
					$variant[ $prop ] = $attributes[ $prop ];
				}
			} );

			$props['hasVariant'][ $i ] = $variant;
		}

		return $props;
	}

	private function update_twig_variables( array $data, string $new_twig_variable ): array {
		array_walk_recursive( $data, function ( &$twig_variable ) use ( $new_twig_variable ) {
			$twig_variable = str_replace( $this->variant_str, $new_twig_variable, $twig_variable );
		});
		return $data;
	}

	public function add_locations( $locations ) {
		$singular = &$locations['singularLocations'];
		if ( empty( $singular['product'] ) ) {
			return;
		}

		$singular['product']['options'][] = [
			'value' => 'product:type',
			'label' => __( 'Type', 'slim-seo-schema' ),
		];

		return $locations;
	}

	public function add_location_terms( array $data, WP_REST_Request $request ): array {
		return 'product:type' !== $request->get_param( 'name' ) ? $data : [
			[
				'value' => 'simple',
				'label' => __( 'Simple', 'slim-seo-schema' ),
			],
			[
				'value' => 'variable',
				'label' => __( 'Variable', 'slim-seo-schema' ),
			],
			[
				'value' => 'grouped',
				'label' => __( 'Grouped', 'slim-seo-schema' ),
			],
			[
				'value' => 'external',
				'label' => __( 'External/Affiliate', 'slim-seo-schema' ),
			],
		];
	}

	public function validate_location( bool $result, array $rule ): bool {
		if ( ! is_singular( 'product' ) || $rule['name'] !== 'product:type' ) {
			return $result;
		}

		$product = wc_get_product( get_queried_object() );
		return $product->get_type() === $rule['value'];
	}

	private function get_variant_data( array $variant, string $title ): array {
		$variant['name']          = $title . ' ' . implode( ' ', $variant['attributes'] );
		$variant['url']           = get_permalink( $variant['variation_id'] );
		$variant['image']         = $variant['image']['url'];
		$variant['sale_price']    = $variant['display_price'];
		$variant['regular_price'] = $variant['display_regular_price'];
		$variant['description']   = $variant['variation_description'];
		$variant['attributes']    = $this->get_variant_attributes( $variant['attributes'] );
		$status                   = str_contains( $variant['availability_html'], 'out-of-stock' ) ? $this->get_statuses()['outofstock'] : ( str_contains( $variant['availability_html'], 'backorder' ) ? $this->get_statuses()['onbackorder'] : 'InStock' );
		$variant['stock']         = "https://schema.org/$status";

		$exclude = array_fill_keys( [
			'backorders_allowed',
			'variation_is_active',
			'variation_is_visible',
			'display_price',
			'display_regular_price',
			'variation_description',
		], '' );
		return array_diff_key( $variant, $exclude );
	}

	private function get_variant_attributes( array $attributes ): array {
		$return = [];
		foreach ( $attributes as $key => $attribute ) {
			$return[ str_replace( 'attribute_', '', $key ) ] = $attribute;
		}
		return $return;
	}

	private function get_statuses(): array {
		return [
			// WooCommerce built-in statuses.
			'instock'              => 'InStock',
			'outofstock'           => 'OutOfStock',
			'onbackorder'          => 'BackOrder',

			// Developers can register product custom stock statuses (supported by Google) with variations.
			'discontinued'         => 'Discontinued',

			'instoreonly'          => 'InStoreOnly',
			'in_store_only'        => 'InStoreOnly',
			'in-store-only'        => 'InStoreOnly',

			'limitedavailability'  => 'LimitedAvailability',
			'limited_availability' => 'LimitedAvailability',
			'limited-availability' => 'LimitedAvailability',

			'onlineonly'           => 'OnlineOnly',
			'online_only'          => 'OnlineOnly',
			'online-only'          => 'OnlineOnly',

			'preorder'             => 'PreOrder',
			'pre_order'            => 'PreOrder',
			'pre-order'            => 'PreOrder',

			'presale'              => 'PreSale',
			'pre_sale'             => 'PreSale',
			'pre-sale'             => 'PreSale',

			'soldout'              => 'SoldOut',
			'sold_out'             => 'SoldOut',
			'sold-out'             => 'SoldOut',
		];
	}
}
