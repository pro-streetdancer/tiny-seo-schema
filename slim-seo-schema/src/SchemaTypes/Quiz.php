<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/practice-problems',
		'show' => true,
	],
	Helper::get_property( 'name', [
		'required' => true,
		'tooltip'  => __( 'The title of the quiz.', 'slim-seo-schema' ),
	] ),
	[
		'id'       => 'about',
		'label'    => __( 'About', 'slim-seo-schema' ),
		'tooltip'  => __( 'Nested information about the underlying concept behind the Quiz.', 'slim-seo-schema' ),
		'type'     => 'Group',
		'required' => true,
		'fields'   => [
			[
				'id'       => '@type',
				'std'      => 'Thing',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'name',
				'required' => true,
			],
		],
	],
	[
		'id'      => 'assesses',
		'label'   => __( 'Assesses', 'slim-seo-schema' ),
		'tooltip' => __( 'The skill(s) required to solve the question.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'educationalLevel',
		'label'   => __( 'Educational level', 'slim-seo-schema' ),
		'tooltip' => __( 'The level of difficulty of the quiz.', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'std'     => 'beginner',
		'options' => [
			'beginner'     => __( 'Beginner', 'slim-seo-schema' ),
			'intermediate' => __( 'Intermediate', 'slim-seo-schema' ),
			'advanced'     => __( 'Advanced', 'slim-seo-schema' ),
		],
	],
	[
		'id'               => 'educationalAlignment',
		'label'            => __( 'Educational alignment', 'slim-seo-schema' ),
		'tooltip'          => __( 'The quiz\'s alignment to an established educational framework.', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Aligment', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'AlignmentObject',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'alignmentType',
				'label'    => __( 'Alignment type', 'slim-seo-schema' ),
				'tooltip'  => __( 'A category of alignment between the learning resource and the framework node for the quiz.', 'slim-seo-schema' ),
				'type'     => 'DataList',
				'required' => true,
				'std'      => 'educationalSubject',
				'options'  => [
					'educationalSubject' => __( 'Educational Subject', 'slim-seo-schema' ),
					'educationalLevel'   => __( 'Educational Level', 'slim-seo-schema' ),
				],
			],
			[
				'id'       => 'educationalFramework',
				'label'    => __( 'Educational framework', 'slim-seo-schema' ),
				'required' => true,
				'tooltip'  => __( 'The framework that the quiz is aligned to. For exp. "Common Core". For more information see Mark up educational standards. Multiple entries of this property is allowed.', 'slim-seo-schema' ),
			],
			[
				'id'       => 'targetName',
				'label'    => __( 'Target name', 'slim-seo-schema' ),
				'required' => true,
				'tooltip'  => __( 'The name of a node of an established educational framework.', 'slim-seo-schema' ),
			],
			[
				'id'       => 'targetUrl',
				'label'    => __( 'Target url', 'slim-seo-schema' ),
				'required' => true,
				'tooltip'  => __( 'The URL of the specific educational framework.', 'slim-seo-schema' ),
			],
		],
	],
	[
		'id'               => 'hasPart',
		'type'             => 'Group',
		'label'            => __( 'Has part', 'slim-seo-schema' ),
		'tooltip'          => __( 'Nested information about the specific practice problem for the quiz.', 'slim-seo-schema' ),
		'required'         => true,
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Question', 'slim-seo-schema' ),
		'fields'           => [
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
				'id'       => 'acceptedAnswer',
				'label'    => __( 'Accepted answer', 'slim-seo-schema' ),
				'tooltip'  => __( 'A top answer to the question. The represent answers that are accepted in some way on your site.', 'slim-seo-schema' ),
				'type'     => 'Group',
				'required' => true,
				'fields'   => [
					[
						'id'       => '@type',
						'std'      => 'Answer',
						'type'     => 'Hidden',
						'required' => true,
					],
					[
						'id'       => 'position',
						'std'      => '1',
						'type'     => 'Hidden',
						'required' => true,
					],
					[
						'id'      => 'answerExplanation',
						'label'   => __( 'Answer explanation', 'slim-seo-schema' ),
						'tooltip' => __( 'A full explanation about how to achieve the result depicted in this answer.', 'slim-seo-schema' ),
						'type'    => 'Group',
						'fields'  => [
							[
								'id'       => '@type',
								'std'      => 'Comment',
								'type'     => 'Hidden',
								'required' => true,
							],
							[
								'id'       => 'text',
								'tooltip'  => __( 'The content of explanation for the suggested answer. To change the content format (HTML or Markdown), use encodingFormat.', 'slim-seo-schema' ),
								'required' => true,
							],
						],
					],
					[
						'id'      => 'comment',
						'label'   => __( 'Comment', 'slim-seo-schema' ),
						'tooltip' => __( 'A hint or suggestion about the answer that may be used to understand why it is correct.', 'slim-seo-schema' ),
						'type'    => 'Group',
						'fields'  => [
							[
								'id'       => '@type',
								'std'      => 'Comment',
								'type'     => 'Hidden',
								'required' => true,
							],
							[
								'id'       => 'text',
								'tooltip'  => __( 'The content of the hint or suggestion for the question. To change the content format (HTML or Markdown), use encodingFormat.', 'slim-seo-schema' ),
								'required' => true,
							],
						],
					],
					[
						'id'       => 'encodingFormat',
						'label'    => __( 'Encoding format', 'slim-seo-schema' ),
						'tooltip'  => __( 'The MIME format used to encode the text property.', 'slim-seo-schema' ),
						'type'     => 'DataList',
						'required' => true,
						'std'      => 'text/html',
						'options'  => [
							'text/html'     => 'text/html',
							'text/markdown' => 'text/markdown',
						],
					],
					[
						'id'       => 'text',
						'label'    => __( 'Text', 'slim-seo-schema' ),
						'type'     => 'Textarea',
						'tooltip'  => __( 'The full instruction text of this step', 'slim-seo-schema' ),
						'required' => true,
					],
				],
			],
			[
				'id'      => 'assesses',
				'label'   => __( 'Assesses', 'slim-seo-schema' ),
				'tooltip' => __( 'The skill(s) required to solve the question.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'comment',
				'label'   => __( 'Comment', 'slim-seo-schema' ),
				'tooltip' => __( 'A hint or suggestion about the answer that may be used to understand why it is correct.', 'slim-seo-schema' ),
				'type'    => 'Group',
				'fields'  => [
					[
						'id'       => '@type',
						'std'      => 'Comment',
						'type'     => 'Hidden',
						'required' => true,
					],
					[
						'id'       => 'text',
						'tooltip'  => __( 'The content of the hint or suggestion for the question. To change the content format (HTML or Markdown), use encodingFormat.', 'slim-seo-schema' ),
						'required' => true,
					],
				],
			],
			[
				'id'       => 'eduQuestionType',
				'label'    => __( 'EduQuestion type', 'slim-seo-schema' ),
				'tooltip'  => __( 'The type of practice problem. Choose Multiple choice if there\'s only one correct answer. Choose Checkbox if there\'s more than one correct answer.', 'slim-seo-schema' ),
				'type'     => 'DataList',
				'required' => true,
				'options'  => [
					'Multiple choice' => __( 'Multiple choice', 'slim-seo-schema' ),
					'Checkbox'        => __( 'Checkbox', 'slim-seo-schema' ),
				],
			],
			[
				'id'       => 'encodingFormat',
				'label'    => __( 'Encoding format', 'slim-seo-schema' ),
				'tooltip'  => __( 'The MIME format used to encode the text property.', 'slim-seo-schema' ),
				'type'     => 'DataList',
				'required' => true,
				'std'      => 'text/markdown',
				'options'  => [
					'text/html'     => 'text/html',
					'text/markdown' => 'text/markdown',
				],
			],
			[
				'id'       => 'learningResourceType',
				'label'    => __( 'Learning resource type', 'slim-seo-schema' ),
				'std'      => 'Practice problem',
				'type'     => 'Hidden',
				'required' => true,
			],

			[
				'id'               => 'suggestedAnswer',
				'label'            => __( 'Suggested answer', 'slim-seo-schema' ),
				'tooltip'          => __( 'One possible answer, but not accepted as a top answer.', 'slim-seo-schema' ),
				'type'             => 'Group',
				'required'         => true,
				'cloneable'        => true,
				'cloneItemHeading' => __( 'Answer', 'slim-seo-schema' ),
				'fields'           => [
					[
						'id'       => '@type',
						'std'      => 'Answer',
						'type'     => 'Hidden',
						'required' => true,
					],
					[
						'id'      => 'comment',
						'label'   => __( 'Comment', 'slim-seo-schema' ),
						'tooltip' => __( 'A hint or suggestion about the answer that may be used to understand why it is correct.', 'slim-seo-schema' ),
						'type'    => 'Group',
						'fields'  => [
							[
								'id'       => '@type',
								'std'      => 'Comment',
								'type'     => 'Hidden',
								'required' => true,
							],
							[
								'id'       => 'text',
								'tooltip'  => __( 'The content of the hint or suggestion for the question. To change the content format (HTML or Markdown), use encodingFormat.', 'slim-seo-schema' ),
								'required' => true,
							],
						],
					],
					[
						'id'       => 'encodingFormat',
						'label'    => __( 'Encoding format', 'slim-seo-schema' ),
						'tooltip'  => __( 'The MIME format used to encode the text property.', 'slim-seo-schema' ),
						'type'     => 'DataList',
						'required' => true,
						'std'      => 'text/html',
						'options'  => [
							'text/html'     => 'text/html',
							'text/markdown' => 'text/markdown',
						],
					],
					[
						'id'       => 'position',
						'std'      => '1',
						'label'    => __( 'Position', 'slim-seo-schema' ),
						'tooltip'  => __( 'The position of this answer when it\'s displayed to the user.', 'slim-seo-schema' ),
						'required' => true,
					],
					[
						'id'       => 'text',
						'label'    => __( 'Text', 'slim-seo-schema' ),
						'type'     => 'Textarea',
						'tooltip'  => __( 'The full instruction text of this step', 'slim-seo-schema' ),
						'required' => true,
					],
				],
			],
			[
				'id'       => 'text',
				'label'    => __( 'Text', 'slim-seo-schema' ),
				'type'     => 'Textarea',
				'required' => true,
				'tooltip'  => __( 'The full text of the long form of the question.', 'slim-seo-schema' ),
			],
			[
				'id'       => 'typicalAgeRange',
				'label'    => __( 'Typical age range', 'slim-seo-schema' ),
				'tooltip'  => __( 'The typical range of ages the quiz is intended for. For example: 7-12 or 18-', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],
	[
		'id'       => 'typicalAgeRange',
		'label'    => __( 'Typical age range', 'slim-seo-schema' ),
		'tooltip'  => __( 'The typical range of ages the quiz is intended for. For example: 7-12 or 18-', 'slim-seo-schema' ),
		'required' => true,
	],
];
