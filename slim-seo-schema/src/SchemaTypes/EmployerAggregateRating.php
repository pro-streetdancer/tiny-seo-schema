<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/employer-rating',
		'show' => true,
	],
	[
		'id'       => 'itemReviewed',
		'label'    => __( 'Item reviewed', 'slim-seo-schema' ),
		'required' => true,
		'tooltip'  => __( 'The organization that is being rated.', 'slim-seo-schema' ),
		'std'      => '{{ schemas.organization }}',
	],
	[
		'id'       => 'ratingCount',
		'label'    => __( 'Rating count', 'slim-seo-schema' ),
		'tooltip'  => __( 'The total number of ratings of the organization on your site.', 'slim-seo-schema' ),
		'required' => true,
	],
	[
		'id'       => 'ratingValue',
		'label'    => __( 'Rating value', 'slim-seo-schema' ),
		'tooltip'  => __( 'A numerical quality rating for the organization, either a number, fraction, or percentage (for exp. "4", "60%", or "6 / 10").', 'slim-seo-schema' ),
		'required' => true,
	],
	[
		'id'       => 'reviewCount',
		'label'    => __( 'Review count', 'slim-seo-schema' ),
		'tooltip'  => __( 'Specifies the number of people who provided a review with or without an accompanying rating.', 'slim-seo-schema' ),
		'required' => true,
	],
	[
		'id'      => 'bestRating',
		'label'   => __( 'Best rating', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'std'     => 5,
		'tooltip' => __( 'The highest value allowed in this rating system.', 'slim-seo-schema' ),
		'options' => [
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
			5 => 5,
		],
	],
	[
		'id'      => 'worstRating',
		'label'   => __( 'Worst rating', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'std'     => 1,
		'tooltip' => __( 'The lowest value allowed in this rating system.', 'slim-seo-schema' ),
		'options' => [
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
			5 => 5,
		],
	],
];
