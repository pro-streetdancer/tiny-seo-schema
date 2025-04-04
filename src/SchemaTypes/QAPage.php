<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/qapage',
		'show' => true,
	],
	[
		'id'       => 'mainEntity',
		'type'     => 'Group',
		'required' => true,
		'fields'   => [
			[
				'id'       => '@type',
				'std'      => 'Question',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'required' => true,
				'tooltip'  => __( 'The full text of the short form of the question.', 'slim-seo-schema' ),
			] ),
			[
				'id'      => 'answerCount',
				'label'   => __( 'Answer count', 'slim-seo-schema' ),
				'tooltip' => __( 'The total number of answers to the question.', 'slim-seo-schema' ),
			],
			Helper::get_property( 'Answer', [
				'id'      => 'acceptedAnswer',
				'label'   => __( 'Accepted answer', 'slim-seo-schema' ),
				'tooltip' => __( 'A top answer to the question. The represent answers that are accepted in some way on your site.', 'slim-seo-schema' ),
				'type'    => 'Group',
				'show'    => true,
			] ),
			Helper::get_property( 'Answer', [
				'id'               => 'suggestedAnswer',
				'label'            => __( 'Suggested answer', 'slim-seo-schema' ),
				'tooltip'          => __( 'One possible answer, but not accepted as a top answer.', 'slim-seo-schema' ),
				'type'             => 'Group',
				'cloneable'        => true,
				'cloneItemHeading' => __( 'Answer', 'slim-seo-schema' ),
			] ),
			[
				'id'      => 'text',
				'label'   => __( 'Text', 'slim-seo-schema' ),
				'type'    => 'Textarea',
				'tooltip' => __( 'The full text of the long form of the question.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'upvoteCount',
				'label'   => __( 'Upvote count', 'slim-seo-schema' ),
				'tooltip' => __( 'The total number of votes that this question has received. If the page supports upvotes and downvotes, then set the upvoteCount value to a single aggregate value that represents both upvotes and downvotes.', 'slim-seo-schema' ),
			],
		],
	],
];
