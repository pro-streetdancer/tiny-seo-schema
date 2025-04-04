<?php
namespace SlimSEOPro\Schema\Api;

use SlimSEOPro\Schema\Support\Data as SupportData;

class Data extends Base {

	public function register_routes() {
		register_rest_route( 'slim-seo-schema', 'data', [
			'methods'             => \WP_REST_Server::READABLE,
			'callback'            => [ $this, 'get_data' ],
			'permission_callback' => [ $this, 'has_permission' ],
			'args'                => [
				'type' => [
					'sanitize_callback' => 'sanitize_text_field',
				],
			],
		] );
	}

	public function get_data( \WP_REST_Request $request ) {
		$type   = $request->get_param( 'type' ) ?: 'variables';
		$method = "get_{$type}";
		return $this->$method();
	}

	public function get_variables() {
		$taxonomies = SupportData::get_taxonomies();
		$options    = [];
		foreach ( $taxonomies as $taxonomy ) {
			$key = $this->normalize( $taxonomy['slug'] );
			$options[ "post.tax.{$key}" ] = $taxonomy['name'];
		}

		$variables = [
			[
				'label'   => __( 'Post', 'slim-seo-schema' ),
				'options' => [
					'post.title'         => __( 'Post title', 'slim-seo-schema' ),
					'post.ID'            => __( 'Post ID', 'slim-seo-schema' ),
					'post.excerpt'       => __( 'Post excerpt', 'slim-seo-schema' ),
					'post.content'       => __( 'Post content', 'slim-seo-schema' ),
					'post.url'           => __( 'Post URL', 'slim-seo-schema' ),
					'post.slug'          => __( 'Post slug', 'slim-seo-schema' ),
					'post.date'          => __( 'Post date', 'slim-seo-schema' ),
					'post.modified_date' => __( 'Post modified date', 'slim-seo-schema' ),
					'post.thumbnail'     => __( 'Post thumbnail', 'slim-seo-schema' ),
					'post.comment_count' => __( 'Post comment count', 'slim-seo-schema' ),
					'post.custom_field'  => __( 'Post custom field', 'slim-seo-schema' ),
					'post.word_count'    => __( 'Post word count', 'slim-seo-schema' ),
					'post.tags'          => __( 'Post tags', 'slim-seo-schema' ),
					'post.categories'    => __( 'Post categories', 'slim-seo-schema' ),
				],
			],

			[
				'label'   => __( 'Post taxonomy terms', 'slim-seo-schema' ),
				'options' => $options,
			],


			[
				'label' => __( 'Term', 'slim-seo-schema' ),
				'options' => [
					'term.ID'          => __( 'Term ID', 'slim-seo-schema' ),
					'term.name'        => __( 'Term name', 'slim-seo-schema' ),
					'term.slug'        => __( 'Term slug', 'slim-seo-schema' ),
					'term.taxonomy'    => __( 'Term taxonomy', 'slim-seo-schema' ),
					'term.description' => __( 'Term description', 'slim-seo-schema' ),
					'term.url'         => __( 'Term URL', 'slim-seo-schema' ),
				]
			],

			[
				'label'   => __( 'Author', 'slim-seo-schema' ),
				'options' => [
					'author.ID'           => __( 'Author ID', 'slim-seo-schema' ),
					'author.first_name'   => __( 'Author first name', 'slim-seo-schema' ),
					'author.last_name'    => __( 'Author last name', 'slim-seo-schema' ),
					'author.display_name' => __( 'Author display name', 'slim-seo-schema' ),
					'author.username'     => __( 'Author username', 'slim-seo-schema' ),
					'author.nickname'     => __( 'Author nickname', 'slim-seo-schema' ),
					'author.email'        => __( 'Author email', 'slim-seo-schema' ),
					'author.website_url'  => __( 'Author website URL', 'slim-seo-schema' ),
					'author.nicename'     => __( 'Author nicename', 'slim-seo-schema' ),
					'author.description'  => __( 'Author description', 'slim-seo-schema' ),
					'author.posts_url'    => __( 'Author posts URL', 'slim-seo-schema' ),
					'author.avatar'       => __( 'Author avatar', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Current user', 'slim-seo-schema' ),
				'options' => [
					'user.ID'           => __( 'User ID', 'slim-seo-schema' ),
					'user.first_name'   => __( 'User first name', 'slim-seo-schema' ),
					'user.last_name'    => __( 'User last name', 'slim-seo-schema' ),
					'user.display_name' => __( 'User display name', 'slim-seo-schema' ),
					'user.username'     => __( 'User username', 'slim-seo-schema' ),
					'user.nickname'     => __( 'User nickname', 'slim-seo-schema' ),
					'user.email'        => __( 'User email', 'slim-seo-schema' ),
					'user.website_url'  => __( 'User website URL', 'slim-seo-schema' ),
					'user.nicename'     => __( 'User nicename', 'slim-seo-schema' ),
					'user.description'  => __( 'User description', 'slim-seo-schema' ),
					'user.posts_url'    => __( 'User posts URL', 'slim-seo-schema' ),
					'user.avatar'       => __( 'User avatar', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Site', 'slim-seo-schema' ),
				'options' => [
					'site.title'       => __( 'Site title', 'slim-seo-schema' ),
					'site.description' => __( 'Site description', 'slim-seo-schema' ),
					'site.url'         => __( 'Site URL', 'slim-seo-schema' ),
					'site.language'    => __( 'Site language', 'slim-seo-schema' ),
					'site.icon'        => __( 'Site icon', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Current page', 'slim-seo-schema' ),
				'options' => [
					'current.title' => __( 'Current page title', 'slim-seo-schema' ),
					'current.url'   => __( 'Current page URL', 'slim-seo-schema' ),
				],
			],
		];

		return apply_filters( 'slim_seo_schema_variables', $variables );
	}

	public function get_schemas() {
		return [
			[
				'label'   => __( 'E-commerce', 'slim-seo-schema' ),
				'options' => [
					'Book'                => __( 'Book', 'slim-seo-schema' ),
					'FAQPage'             => __( 'FAQ', 'slim-seo-schema' ),
					'Product'             => __( 'Product', 'slim-seo-schema' ),
					'ProductGroup'        => __( 'Product group (product variants)', 'slim-seo-schema' ),
					'Review'              => __( 'Review snippet', 'slim-seo-schema' ),
					'SoftwareApplication' => __( 'Software app', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Organizations', 'slim-seo-schema' ),
				'options' => [
					'HowTo'         => __( 'How-to', 'slim-seo-schema' ),
					'LocalBusiness' => __( 'Local business', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Jobs', 'slim-seo-schema' ),
				'options' => [
					'EmployerAggregateRating' => __( 'Employer aggregate rating', 'slim-seo-schema' ),
					'Occupation'              => __( 'Estimated salary', 'slim-seo-schema' ),
					'JobPosting'              => __( 'Job posting', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Entertainment', 'slim-seo-schema' ),
				'options' => [
					'Event'       => __( 'Event', 'slim-seo-schema' ),
					'ImageObject' => __( 'Image license', 'slim-seo-schema' ),
					'Movie'       => __( 'Movie', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'News', 'slim-seo-schema' ),
				'options' => [
					'Article'     => __( 'Article', 'slim-seo-schema' ),
					'ClaimReview' => __( 'Fact check', 'slim-seo-schema' ),
					'VideoObject' => __( 'Video', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Food and Drink', 'slim-seo-schema' ),
				'options' => [
					'Recipe' => __( 'Recipe', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Education and Science', 'slim-seo-schema' ),
				'options' => [
					'Course'     => __( 'Course', 'slim-seo-schema' ),
					'Dataset'    => __( 'Dataset', 'slim-seo-schema' ),
					'MathSolver' => __( 'Math solver', 'slim-seo-schema' ),
					'Quiz'       => __( 'Practice problems (Quiz)', 'slim-seo-schema' ),
					'QAPage'     => __( 'Q&A', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Basic', 'slim-seo-schema' ),
				'options' => [
					'WebSite'        => __( 'WebSite', 'slim-seo-schema' ),
					'WebPage'        => __( 'WebPage', 'slim-seo-schema' ),
					'SearchAction'   => __( 'SearchAction', 'slim-seo-schema' ),
					'BreadcrumbList' => __( 'BreadcrumbList', 'slim-seo-schema' ),
					'Thing'          => __( 'Thing', 'slim-seo-schema' ),
					'Person'         => __( 'Person', 'slim-seo-schema' ),
					'Organization'   => __( 'Organization', 'slim-seo-schema' ),
					'Service'        => __( 'Service', 'slim-seo-schema' ),
					'Offer'          => __( 'Offer', 'slim-seo-schema' ),
					'CustomJsonLd'   => __( 'Custom JSON-LD', 'slim-seo-schema' ),
				],
			],
		];
	}

	private function normalize( $key ) {
		return str_replace( '-', '_', $key );
	}
}
