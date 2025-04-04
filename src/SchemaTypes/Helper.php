<?php
namespace SlimSEOPro\Schema\SchemaTypes;

class Helper {
	public static function get_property( $name, $args = [] ) {
		$properties = [];

		$properties['type'] = [
			'id'       => '@type',
			'type'     => 'Hidden',
			'required' => true,
		];

		$properties['image'] = [
			'id'        => 'image',
			'label'     => __( 'Image', 'slim-seo-schema' ),
			'std'       => [ '{{ post.thumbnail }}' ],
			'type'      => 'Image',
			'cloneable' => true,
		];

		$properties['name'] = [
			'label' => __( 'Name', 'slim-seo-schema' ),
			'id'    => 'name',
			'std'   => '{{ post.title }}',
		];

		$properties['Answer'] = [
			'type'   => 'Group',
			'fields' => [
				[
					'id'       => '@type',
					'std'      => 'Answer',
					'type'     => 'Hidden',
					'required' => true,
				],
				[
					'id'       => 'text',
					'label'    => __( 'Text', 'slim-seo-schema' ),
					'type'     => 'Textarea',
					'tooltip'  => __( 'The full instruction text of this step', 'slim-seo-schema' ),
					'required' => true,
				],
				[
					'id'      => 'upvoteCount',
					'label'   => __( 'Upvote count', 'slim-seo-schema' ),
					'tooltip' => __( 'The total number of votes that this question has received. If the page supports upvotes and downvotes, then set the upvoteCount value to a single aggregate value that represents both upvotes and downvotes.', 'slim-seo-schema' ),
				],
				[
					'id'      => 'url',
					'label'   => __( 'URL', 'slim-seo-schema' ),
					'tooltip' => __( 'A URL that links directly to this answer.', 'slim-seo-schema' ),
				],
			],
		];

		$properties['dateCreated'] = [
			'id'    => 'dateCreated',
			'label' => __( 'Created date', 'slim-seo-schema' ),
			'type'  => 'Date',
		];

		$properties['datePublished'] = [
			'id'    => 'datePublished',
			'label' => __( 'Published date', 'slim-seo-schema' ),
			'type'  => 'Date',
		];

		$properties['dateModified'] = [
			'id'    => 'dateModified',
			'label' => __( 'Modified date', 'slim-seo-schema' ),
			'type'  => 'Date',
		];

		$properties['description'] = [
			'id'    => 'description',
			'label' => __( 'Description', 'slim-seo-schema' ),
			'type'  => 'Textarea',
			'std'   => '{{ post.content }}',
			'show'  => true,
		];

		$properties['url'] = [
			'id'    => 'url',
			'label' => __( 'URL', 'slim-seo-schema' ),
		];

		$properties['aggregateRating'] = [
			'id'           => 'aggregateRating',
			'label'        => __( 'Aggregate rating', 'slim-seo-schema' ),
			'type'         => 'Group',
			'propertyType' => 'AggregateRating',
			'tooltip'      => __( 'A nested aggregate rating of the product', 'slim-seo-schema' ),
			'fields'       => [
				[
					'id'       => '@type',
					'std'      => 'AggregateRating',
					'type'     => 'Hidden',
					'required' => true,
				],
				[
					'id'       => 'ratingValue',
					'label'    => __( 'Value', 'slim-seo-schema' ),
					'tooltip'  => __( 'A numerical quality rating for the item, either a number, fraction, or percentage (for example, "4", "60%", or "6 / 10")', 'slim-seo-schema' ),
					'required' => true,
				],
				[
					'id'      => 'ratingCount',
					'label'   => __( 'Rating count', 'slim-seo-schema' ),
					'tooltip' => __( 'Specifies the number of people who provided a review with or without an accompanying rating', 'slim-seo-schema' ),
				],
				[
					'id'       => 'reviewCount',
					'label'    => __( 'Review count', 'slim-seo-schema' ),
					'required' => true,
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
			],
		];

		// https://schema.org/VideoObject
		$properties['VideoObject'] = [
			'id'     => 'video',
			'label'  => __( 'Video', 'slim-seo-schema' ),
			'type'   => 'Group',
			'fields' => [
				[
					'id'       => '@type',
					'std'      => 'VideoObject',
					'type'     => 'Hidden',
					'required' => true,
				],
				[
					'label'    => __( 'Name', 'slim-seo-schema' ),
					'id'       => 'name',
					'std'      => '{{ post.title }}',
					'required' => true,
				],
				[
					'id'       => 'description',
					'label'    => __( 'Description', 'slim-seo-schema' ),
					'type'     => 'Textarea',
					'std'      => '{{ post.content }}',
					'required' => true,
				],
				[
					'id'       => 'thumbnailUrl',
					'label'    => __( 'Thumbnail URL', 'slim-seo-schema' ),
					'tooltip'  => __( 'A URL pointing to the video thumbnail image file', 'slim-seo-schema' ),
					'std'      => '{{ post.thumbnail }}',
					'required' => true,
				],
				[
					'id'       => 'uploadDate',
					'label'    => __( 'Upload Date', 'slim-seo-schema' ),
					'tooltip'  => __( 'The date the video was first published, in ISO 8601 format.', 'slim-seo-schema' ),
					'type'     => 'Date',
					'std'      => '{{ post.date }}',
					'required' => true,
				],
				[
					'id'      => 'contentURL',
					'label'   => __( 'Content URL', 'slim-seo-schema' ),
					'tooltip' => __( 'A URL pointing to the actual video media file', 'slim-seo-schema' ),
					'show'    => true,
				],
				[
					'id'      => 'embedURL',
					'label'   => __( 'Embed URL', 'slim-seo-schema' ),
					'tooltip' => __( 'A URL pointing to a player for the specific video. Don\'t link to the page where the video lives; this must be the URL of the video player itself. Usually this is the information in the src element of an <embed> tag.', 'slim-seo-schema' ),
				],
				[
					'id'      => 'duration',
					'label'   => __( 'Duration (min)', 'slim-seo-schema' ),
					'tooltip' => __( 'The duration of the video in ISO 8601 format. For example, PT00H30M5S represents a duration of "thirty minutes and five seconds".', 'slim-seo-schema' ),
				],
				[
					'id'      => 'expires',
					'label'   => __( 'Expires', 'slim-seo-schema' ),
					'tooltip' => __( 'If applicable, the date after which the video will no longer be available, in ISO 8601 format. Don\'t supply this information if your video does not expire.', 'slim-seo-schema' ),
				],
				[
					'id'               => 'hasPart',
					'label'            => __( 'Has part', 'slim-seo-schema' ),
					'tooltip'          => __( 'If your video has important segments, specify them here', 'slim-seo-schema' ),
					'type'             => 'Group',
					'cloneable'        => true,
					'cloneItemHeading' => __( 'Part', 'slim-seo-schema' ),
					'fields'           => [
						[
							'id'       => '@type',
							'std'      => 'Clip',
							'type'     => 'Hidden',
							'required' => true,
						],
						[
							'label' => __( 'Name', 'slim-seo-schema' ),
							'id'    => 'name',
							'show'  => true,
						],
						[
							'id'    => 'startOffset',
							'label' => __( 'Start offset', 'slim-seo-schema' ),
							'show'  => true,
						],
						[
							'label' => __( 'URL', 'slim-seo-schema' ),
							'id'    => 'url',
							'show'  => true,
						],
					],
				],
				[
					'id'     => 'interactionStatistic',
					'type'   => 'Group',
					'fields' => [
						[
							'id'       => '@type',
							'type'     => 'Hidden',
							'std'      => 'InteractionCounter',
							'required' => true,
						],
						[
							'id'       => 'interactionType',
							'type'     => 'Group',
							'required' => true,
							'fields'   => [
								[
									'id'       => '@type',
									'type'     => 'Hidden',
									'std'      => 'WatchAction',
									'required' => true,
								],
							],
						],
						[
							'id'       => 'userInteractionCount',
							'label'    => __( 'Interaction statistic', 'slim-seo-schema' ),
							'tooltip'  => __( 'The number of times the video has been watched', 'slim-seo-schema' ),
							'required' => true,
						],
					],
				],
			],
		];

		$properties['address'] = [
			'id'     => 'address',
			'label'  => __( 'Address', 'slim-seo-schema' ),
			'type'   => 'Group',
			'fields' => [
				[
					'id'   => '@type',
					'std'  => 'PostalAddress',
					'type' => 'Hidden',
					'show' => true,
				],
				[
					'id'      => 'streetAddress',
					'label'   => __( 'Street address', 'slim-seo-schema' ),
					'tooltip' => __( 'The detailed street address.', 'slim-seo-schema' ),
					'show'    => true,
				],
				[
					'id'      => 'addressLocality',
					'label'   => __( 'Locality', 'slim-seo-schema' ),
					'tooltip' => __( 'The locality in which the street address is, and which is in the region.', 'slim-seo-schema' ),
					'show'    => true,
				],
				[
					'id'      => 'addressRegion',
					'label'   => __( 'Region', 'slim-seo-schema' ),
					'tooltip' => __( 'The region in which the locality is, and which is in the country.', 'slim-seo-schema' ),
					'show'    => true,
				],
				[
					'id'      => 'addressCountry',
					'label'   => __( 'Country', 'slim-seo-schema' ),
					'tooltip' => __( 'The country. You can also provide the two-letter ISO 3166-1 alpha-2 country code.', 'slim-seo-schema' ),
					'std'     => 'US',
					'show'    => true,
				],
				[
					'id'    => 'postalCode',
					'label' => __( 'Postal code', 'slim-seo-schema' ),
					'show'  => true,
				],
			],
		];

		// https://schema.org/Person
		$properties['Person'] = [
			'type'   => 'Group',
			'fields' => [
				[
					'id'       => '@type',
					'std'      => 'Person',
					'type'     => 'Hidden',
					'required' => true,
				],
				[
					'id'       => 'name',
					'required' => true,
					'std'      => '{{ author.display_name }}',
				],
			],
		];

		// https://schema.org/OpeningHoursSpecification
		$properties['OpeningHoursSpecification'] = [
			'type'      => 'Group',
			'cloneable' => true,
			'fields'    => [
				[
					'id'       => '@type',
					'std'      => 'OpeningHoursSpecification',
					'type'     => 'Hidden',
					'required' => true,
				],
				[
					'id'      => 'dayOfWeek',
					'label'   => __( 'Day of week', 'slim-seo-schema' ),
					'tooltip' => __( 'The day of the week for which these opening hours are valid', 'slim-seo-schema' ),
					'show'    => true,
					'type'    => 'DataList',
					'options' => [
						'https://schema.org/Monday'    => __( 'Monday', 'slim-seo-schema' ),
						'https://schema.org/Tuesday'   => __( 'Tuesday', 'slim-seo-schema' ),
						'https://schema.org/Wednesday' => __( 'Wednesday', 'slim-seo-schema' ),
						'https://schema.org/Thursday'  => __( 'Thursday', 'slim-seo-schema' ),
						'https://schema.org/Friday'    => __( 'Friday', 'slim-seo-schema' ),
						'https://schema.org/Saturday'  => __( 'Saturday', 'slim-seo-schema' ),
						'https://schema.org/Sunday'    => __( 'Sunday', 'slim-seo-schema' ),
					],
				],
				[
					'id'      => 'opens',
					'label'   => __( 'Opens', 'slim-seo-schema' ),
					'tooltip' => __( 'The opening hour of the place or service on the given day(s) of the week, in hh:mm:ss format', 'slim-seo-schema' ),
					'show'    => true,
				],
				[
					'id'      => 'closes',
					'label'   => __( 'Closes', 'slim-seo-schema' ),
					'tooltip' => __( 'The closing hour of the place or service on the given day(s) of the week, in hh:mm:ss format', 'slim-seo-schema' ),
					'show'    => true,
				],
				[
					'id'      => 'validFrom',
					'label'   => __( 'Valid from', 'slim-seo-schema' ),
					'tooltip' => __( 'The date when the item becomes valid, in YYYY-MM-DD format', 'slim-seo-schema' ),
				],
				[
					'id'      => 'validThrough',
					'label'   => __( 'Valid through', 'slim-seo-schema' ),
					'tooltip' => __( 'The date after when the item is not valid, in YYYY-MM-DD format', 'slim-seo-schema' ),
				],
			],
		];

		// https://schema.org/Review
		$properties['Review'] = [
			'id'               => 'review',
			'type'             => 'Group',
			'label'            => __( 'Reviews', 'slim-seo-schema' ),
			'cloneable'        => true,
			'cloneItemHeading' => __( 'Review', 'slim-seo-schema' ),
			'fields'           => [
				[
					'id'       => '@type',
					'std'      => 'Review',
					'type'     => 'Hidden',
					'required' => true,
				],
				[
					'id'          => 'author',
					'label'       => __( 'Author', 'slim-seo-schema' ),
					'description' => __( 'Please create a Person or Organization schema and link to this property via a dynamic variable.', 'slim-seo-schema' ),
					'std'         => '{{ schemas.person }}',
					'required'    => true,
				],
				[
					'id'     => 'reviewRating',
					'type'   => 'Group',
					'label'  => __( 'Rating', 'slim-seo-schema' ),
					'show'   => true,
					'fields' => [
						[
							'id'       => '@type',
							'std'      => 'Rating',
							'type'     => 'Hidden',
							'required' => true,
						],
						[
							'id'       => 'ratingValue',
							'label'    => __( 'Rating value', 'slim-seo-schema' ),
							'required' => true,
							'type'     => 'DataList',
							'std'      => '5',
							'options'  => [
								1 => 1,
								2 => 2,
								3 => 3,
								4 => 4,
								5 => 5,
							],
						],
						[
							'id'      => 'bestRating',
							'label'   => __( 'Best rating', 'slim-seo-schema' ),
							'type'    => 'DataList',
							'std'     => '5',
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
							'std'     => '1',
							'options' => [
								1 => 1,
								2 => 2,
								3 => 3,
								4 => 4,
								5 => 5,
							],
						],
					],
				],
				[
					'id'    => 'datePublished',
					'label' => __( 'Date published', 'slim-seo-schema' ),
					'type'  => 'Date',
				],
				[
					'id'      => 'positiveNotes',
					'type'    => 'Group',
					'label'   => __( 'Positive notes (Pros)', 'slim-seo-schema' ),
					'tooltip' => __( 'A list of positive statements about the product, listed in a specific order', 'slim-seo-schema' ),
					'show'    => true,
					'fields'  => [
						[
							'id'       => '@type',
							'std'      => 'ItemList',
							'type'     => 'Hidden',
							'required' => true,
						],
						[
							'id'        => 'itemListElement',
							'type'      => 'Group',
							'cloneable' => true,
							'show'      => true,
							'fields'    => [
								[
									'id'       => '@type',
									'std'      => 'ListItem',
									'type'     => 'Hidden',
									'required' => true,
								],
								[
									'label'    => __( 'Name', 'slim-seo-schema' ),
									'id'       => 'name',
									'tooltip'  => __( 'The key statement of the review.', 'slim-seo-schema' ),
									'required' => true,
								],
								[
									'id'      => 'position',
									'label'   => __( 'Position', 'slim-seo-schema' ),
									'show'    => true,
									'tooltip' => __( 'The position (order) of the statement in the list.', 'slim-seo-schema' ),
								],
							],
						],
					],
				],
				[
					'id'      => 'negativeNotes',
					'type'    => 'Group',
					'label'   => __( 'Negative notes (Cons)', 'slim-seo-schema' ),
					'tooltip' => __( 'A list of negative statements about the product, listed in a specific order', 'slim-seo-schema' ),
					'show'    => true,
					'fields'  => [
						[
							'id'       => '@type',
							'std'      => 'ItemList',
							'type'     => 'Hidden',
							'required' => true,
						],
						[
							'id'        => 'itemListElement',
							'type'      => 'Group',
							'cloneable' => true,
							'show'      => true,
							'fields'    => [
								[
									'id'       => '@type',
									'std'      => 'ListItem',
									'type'     => 'Hidden',
									'required' => true,
								],
								[
									'label'    => __( 'Name', 'slim-seo-schema' ),
									'id'       => 'name',
									'tooltip'  => __( 'The key statement of the review.', 'slim-seo-schema' ),
									'required' => true,
								],
								[
									'id'      => 'position',
									'label'   => __( 'Position', 'slim-seo-schema' ),
									'show'    => true,
									'tooltip' => __( 'The position (order) of the statement in the list.', 'slim-seo-schema' ),
								],
							],
						],
					],
				],
			],
		];

		$properties['duration'] = [
			'fields' => [
				[
					'id'       => '@type',
					'std'      => 'QuantitativeValue',
					'type'     => 'Hidden',
					'required' => true,
				],
				[
					'id'    => 'value',
					'label' => __( 'Value', 'slim-seo-schema' ),
					'show'  => true,
				],
				[
					'id'    => 'minValue',
					'label' => __( 'Min value', 'slim-seo-schema' ),
				],
				[
					'id'    => 'maxValue',
					'label' => __( 'Max value', 'slim-seo-schema' ),
				],
				[
					'id'      => 'unitText',
					'label'   => __( 'Unit text', 'slim-seo-schema' ),
					'type'    => 'DataList',
					'std'     => 'MONTH',
					'tooltip' => __( 'A string or text indicating the unit of measurement.', 'slim-seo-schema' ),
					'options' => [
						'HOUR'  => __( 'Hour', 'slim-seo-schema' ),
						'DAY'   => __( 'Day', 'slim-seo-schema' ),
						'WEEK'  => __( 'Week', 'slim-seo-schema' ),
						'MONTH' => __( 'Month', 'slim-seo-schema' ),
						'YEAR'  => __( 'Year', 'slim-seo-schema' ),
					],
				],
			],
		];

		$properties['QuantitativeValue'] = [
			'fields' => [
				[
					'id'       => '@type',
					'std'      => 'QuantitativeValue',
					'type'     => 'Hidden',
					'required' => true,
				],
				[
					'id'    => 'value',
					'label' => __( 'Value', 'slim-seo-schema' ),
					'show'  => true,
				],
				[
					'id'    => 'minValue',
					'label' => __( 'Min value', 'slim-seo-schema' ),
				],
				[
					'id'    => 'maxValue',
					'label' => __( 'Max value', 'slim-seo-schema' ),
				],
				[
					'id'      => 'unitText',
					'label'   => __( 'Unit text', 'slim-seo-schema' ),
					'tooltip' => __( 'A string or text indicating the unit of measurement.', 'slim-seo-schema' ),
					'show'    => true,
				],
			],
		];

		$properties['mainEntity'] = [
			'id'          => 'mainEntity',
			'label'       => __( 'Main entity', 'slim-seo-schema' ),
			'tooltip'     => __( 'Indicates the primary entity described in some page or other CreativeWork.', 'slim-seo-schema' ),
			'description' => __( 'Please create a schema and link to this property via a dynamic variable', 'slim-seo-schema' ),
		];

		$properties['mainEntityOfPage'] = [
			'id'      => 'mainEntityOfPage',
			'label'   => __( 'Main entity of page', 'slim-seo-schema' ),
			'tooltip' => __( 'Indicates a page for which the content is the main entity being described.', 'slim-seo-schema' ),
			'std'     => '{{ schemas.webpage }}',
			'show'    => true,
		];

		$properties['countryOfOrigin'] = [
			'label'   => __( 'Country of origin', 'slim-seo-schema' ),
			'id'      => 'countryOfOrigin',
			'type'    => 'Group',
			'fields'  => [
				[
					'id'   => '@type',
					'std'  => 'Country',
					'type' => 'Hidden',
				],
				[
					'id'      => 'address',
					'label'   => __( 'Address', 'slim-seo-schema' ),
					'tooltip' => __( 'Physical address of the item.', 'slim-seo-schema' ),
				],
				[
					'id'      => 'branchCode',
					'label'   => __( 'Branch code', 'slim-seo-schema' ),
					'tooltip' => __( 'A short textual code (also called "store code") that uniquely identifies a place of business. The code is typically assigned by the parentOrganization and used in structured URLs.', 'slim-seo-schema' ),
				],
				[
					'id'      => 'description',
					'label'   => __( 'Description', 'slim-seo-schema' ),
					'tooltip' => __( 'A description of the country.', 'slim-seo-schema' ),
				],
				[
					'id'    => 'faxNumber',
					'label' => __( 'Fax number', 'slim-seo-schema' ),
				],
				[
					'id'      => 'globalLocationNumber',
					'label'   => __( 'Global location number', 'slim-seo-schema' ),
					'tooltip' => __( 'The GLN is a 13-digit number used to identify parties and physical locations.', 'slim-seo-schema' ),
				],
				[
					'id'      => 'hasMap',
					'label'   => __( 'Has Map', 'slim-seo-schema' ),
					'tooltip' => __( 'A URL to a map of the place.', 'slim-seo-schema' ),
				],
				[
					'id'      => 'latitude',
					'label'   => __( 'Latitude', 'slim-seo-schema' ),
					'tooltip' => __( 'The latitude of a location. For example 37.42242 (WGS 84).', 'slim-seo-schema' ),
				],
				[
					'id'      => 'longitude',
					'label'   => __( 'Longitude', 'slim-seo-schema' ),
					'tooltip' => __( 'The longitude of a location. For example -122.08585 (WGS 84).', 'slim-seo-schema' ),
				],
				[
					'id'      => 'logo',
					'label'   => __( 'Logo', 'slim-seo-schema' ),
					'tooltip' => __( 'Link to an associated logo.', 'slim-seo-schema' ),
				],
				[
					'id'      => 'name',
					'label'   => __( 'Name', 'slim-seo-schema' ),
					'tooltip' => __( 'The name of the country.', 'slim-seo-schema' ),
					'show'    => true,
				],
				[
					'id'    => 'telephone',
					'label' => __( 'Telephone number', 'slim-seo-schema' ),
				],
			],
		];

		$property = $properties[ $name ] ?? [];

		return array_replace_recursive( $property, $args );
	}
}
