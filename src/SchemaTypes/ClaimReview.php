<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/factcheck',
		'show' => true,
	],
	Helper::get_property( 'Person', [
		'id'      => 'author',
		'label'   => __( 'Author', 'slim-seo-schema' ),
		'tooltip' => __( 'The publisher of the fact check article, not the publisher of the claim.', 'slim-seo-schema' ),
		'show'    => true,
	] ),
	[
		'id'       => 'claimReviewed',
		'label'    => __( 'Claim reviewed', 'slim-seo-schema' ),
		'tooltip'  => __( 'A short summary of the claim being evaluated. Try to keep this less than 75 characters to minimize wrapping when displayed on a mobile device.', 'slim-seo-schema' ),
		'required' => true,
	],
	Helper::get_property( 'datePublished', [
		'tooltip' => __( 'The date when the fact check was published.', 'slim-seo-schema' ),
		'std'     => '{{ post.date }}',
	] ),
	[
		'id'       => 'itemReviewed',
		'label'    => __( 'Item reviewed', 'slim-seo-schema' ),
		'type'     => 'Group',
		'required' => true,
		'tooltip'  => __( 'An object describing the claim being made.', 'slim-seo-schema' ),
		'fields'   => [
			[
				'id'       => '@type',
				'std'      => 'Claim',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'      => 'author',
				'label'   => __( 'Author', 'slim-seo-schema' ),
				'tooltip' => __( 'The author of the claim, not the author of the fact check. Don\'t include the author property if the claim doesn\'t have an author.', 'slim-seo-schema' ),
				'std'     => '{{ schemas.organization }}',
				'show'    => true,
			],
			[
				'id'       => 'appearance',
				'label'    => __( 'Appearance', 'slim-seo-schema' ),
				'required' => true,
				'tooltip'  => __( 'A link to a CreativeWork in which this claim appears.', 'slim-seo-schema' ),
				'std'      => '{{ post.url }}',
			],
			Helper::get_property( 'datePublished', [
				'tooltip' => __( 'The date when the claim was made or entered public discourse.', 'slim-seo-schema' ),
				'std'     => '{{ post.date }}',
			] ),
			[
				'id'      => 'firstAppearance',
				'label'   => __( 'First appearance', 'slim-seo-schema' ),
				'type'    => 'Text',
				'tooltip' => __( 'A link to, or inline description of, a CreativeWork in which this specific claim first appears.', 'slim-seo-schema' ),
			],
		],
	],
	[
		'id'       => 'reviewRating',
		'label'    => __( 'Review rating', 'slim-seo-schema' ),
		'type'     => 'Group',
		'required' => true,
		'tooltip'  => __( 'The assessment of the claim.', 'slim-seo-schema' ),
		'fields'   => [
			[
				'id'       => '@type',
				'std'      => 'Rating',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'alternateName',
				'label'    => __( 'Alternate name', 'slim-seo-schema' ),
				'tooltip'  => __( 'The truthfulness rating assigned to Review rating, as a human-readible short word or phrase.', 'slim-seo-schema' ),
				'required' => true,
				'type'     => 'DataList',
				'options'  => [
					1 => __( 'False', 'slim-seo-schema' ),
					2 => __( 'Mostly false', 'slim-seo-schema' ),
					3 => __( 'Half true', 'slim-seo-schema' ),
					4 => __( 'Mostly true', 'slim-seo-schema' ),
					5 => __( 'True', 'slim-seo-schema' ),
				],
			],
			[
				'id'       => 'ratingValue',
				'label'    => __( 'Rating value', 'slim-seo-schema' ),
				'required' => true,
				'std'      => 5,
			],
			[
				'id'      => 'bestRating',
				'label'   => __( 'Best rating', 'slim-seo-schema' ),
				'type'    => 'DataList',
				'std'     => 5,
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
				'options' => [
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
				],
			],
			[
				'id'      => 'name',
				'label'   => __( 'Name', 'slim-seo-schema' ),
				'tooltip' => __( 'Used when Alternate name is not provided.', 'slim-seo-schema' ),
			],
		],
	],
	Helper::get_property( 'url', [
		'label'    => __( 'URL', 'slim-seo-schema' ),
		'required' => true,
		'tooltip'  => __( 'Link to the page hosting the full article of the fact check. The domain of this URL value must be the same domain as, or a subdomain of, the page hosting this ClaimReview element. Redirects or shortened URLs are not accepted.', 'slim-seo-schema' ),
	] ),
];
