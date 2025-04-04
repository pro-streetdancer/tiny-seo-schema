<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/how-to',
		'show' => true,
	],
	Helper::get_property( 'name', [
		'required' => true,
		'tooltip'  => __( 'The title of the how-to', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'Person', [
		'id'       => 'author',
		'label'    => __( 'Author', 'slim-seo-schema' ),
		'tooltip'  => __( 'The author of the content.', 'slim-seo-schema' ),
		'required' => true,
	] ),
	Helper::get_property( 'description', [
		'tooltip' => __( 'A description of the content.', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'datePublished', [
		'required' => true,
		'tooltip'  => __( 'The date and time the article was most recently modified, in ISO 8601 format', 'slim-seo-schema' ),
		'std'      => '{{ post.date }}',
	] ),
	Helper::get_property( 'dateModified', [
		'tooltip' => __( 'The date and time the article was first published, in ISO 8601 format', 'slim-seo-schema' ),
		'std'     => '{{ post.modified_date }}',
	] ),
	[
		'id'               => 'hasPart',
		'label'            => __( 'Subscription and paywalled content', 'slim-seo-schema' ),
		'type'             => 'Group',
		'tooltip'          => __( 'Indicates the content that is part of this item.', 'slim-seo-schema' ),
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Part', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'WebPageElement',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'isAccessibleForFree',
				'label'    => __( 'Is accessible for free?', 'slim-seo-schema' ),
				'tooltip'  => __( 'Whether the dataset is accessible without payment.', 'slim-seo-schema' ),
				'type'     => 'DataList',
				'std'      => 'true',
				'options'  => [
					'true'  => __( 'Yes', 'slim-seo-schema' ),
					'false' => __( 'No', 'slim-seo-schema' ),
				],
				'required' => true,
			],
			[
				'id'       => 'cssSelector',
				'label'    => __( 'CSS selector', 'slim-seo-schema' ),
				'tooltip'  => __( 'Class name around each paywalled section of your page.', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],
	[
		'label'    => __( 'Headline', 'slim-seo-schema' ),
		'id'       => 'headline',
		'type'     => 'Text',
		'required' => true,
		'tooltip'  => __( 'The headline of the article. Headlines should not exceed 110 characters.', 'slim-seo-schema' ),
		'std'      => '{{ post.title }}',
	],
	Helper::get_property( 'image', [
		'tooltip' => __( 'Image of the completed how-to', 'slim-seo-schema' ),
	] ),
	[
		'id'      => 'isAccessibleForFree',
		'label'   => __( 'Is accessible for free?', 'slim-seo-schema' ),
		'tooltip' => __( 'Whether the dataset is accessible without payment.', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'std'     => 'true',
		'options' => [
			'true'  => __( 'Yes', 'slim-seo-schema' ),
			'false' => __( 'No', 'slim-seo-schema' ),
		],
	],
	[
		'id'               => 'step',
		'label'            => __( 'Steps', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Step', 'slim-seo-schema' ),
		'required'         => true,
		'tooltip'          => __( 'An list of elements which comprise the full instructions of the how-to. Each step element must correspond to an individual step in the instructions', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'HowToStep',
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
			Helper::get_property( 'image' ),
			Helper::get_property( 'name', [
				'show'    => true,
				'tooltip' => __( 'The word or short phrase summarizing the step (for example, "Attach wires to post" or "Dig")', 'slim-seo-schema' ),
			] ),
			Helper::get_property( 'url', [
				'tooltip' => __( 'A URL that directly links to the step (if one is available).', 'slim-seo-schema' ),
			] ),
			Helper::get_property( 'VideoObject', [
				'tooltip' => __( 'A video for this step or a clip of the video', 'slim-seo-schema' ),
			] ),
		],
	],
	[
		'id'      => 'estimatedCost',
		'label'   => __( 'Estimated cost', 'slim-seo-schema' ),
		'tooltip' => __( 'The estimated cost of the supplies consumed when performing instructions', 'slim-seo-schema' ),
	],
	Helper::get_property( 'mainEntityOfPage' ),
	[
		'id'       => 'publisher',
		'label'    => __( 'Publisher', 'slim-seo-schema' ),
		'tooltip'  => __( 'The publisher of the creative work.', 'slim-seo-schema' ),
		'std'      => '{{ schemas.organization }}',
		'required' => true,
	],
	[
		'id'               => 'supply',
		'label'            => __( 'Supply', 'slim-seo-schema' ),
		'tooltip'          => __( 'A supply consumed when performing instructions or a direction', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Item', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'HowToSupply',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'name',
				'label'    => __( 'Name', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],
	[
		'id'               => 'tool',
		'label'            => __( 'Tool', 'slim-seo-schema' ),
		'tooltip'          => __( 'An object used (but not consumed) when performing instructions or a direction', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Item', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'HowToTool',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'name',
				'label'    => __( 'Name', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],
	[
		'id'      => 'totalTime',
		'label'   => __( 'Total time (min)', 'slim-seo-schema' ),
		'tooltip' => __( 'The total time required to perform all instructions or directions (including time to prepare the supplies), in ISO 8601 duration format', 'slim-seo-schema' ),
	],
	Helper::get_property( 'VideoObject', [
		'tooltip' => __( 'A video of the how-to', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'url', [
		'required' => true,
		'std'      => '{{ post.url }}',
	] ),
];
