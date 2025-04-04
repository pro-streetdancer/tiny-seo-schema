<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/article',
		'show' => true,
	],
	[
		'label'    => __( 'Type', 'slim-seo-schema' ),
		'id'       => '@type',
		'type'     => 'Select',
		'required' => true,
		'options'  => [
			[
				'label'   => __( 'General', 'slim-seo-schema' ),
				'options' => [
					'Article'                  => __( 'Article', 'slim-seo-schema' ),
					'AdvertiserContentArticle' => __( 'Advertiser Content Article', 'slim-seo-schema' ),
					'Report'                   => __( 'Report', 'slim-seo-schema' ),
					'SatiricalArticle'         => __( 'Satirical Article', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'News', 'slim-seo-schema' ),
				'options' => [
					'NewsArticle'           => __( 'News Article', 'slim-seo-schema' ),
					'AnalysisNewsArticle'   => __( 'Analysis News Article', 'slim-seo-schema' ),
					'AskPublicNewsArticle'  => __( 'Ask Public News Article', 'slim-seo-schema' ),
					'BackgroundNewsArticle' => __( 'Background News Article', 'slim-seo-schema' ),
					'OpinionNewsArticle'    => __( 'Opinion News Article', 'slim-seo-schema' ),
					'ReportageNewsArticle'  => __( 'Reportage News Article', 'slim-seo-schema' ),
					'ReviewNewsArticle'     => __( 'Review News Article', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Scholarly', 'slim-seo-schema' ),
				'options' => [
					'ScholarlyArticle'        => __( 'Scholarly Article', 'slim-seo-schema' ),
					'MedicalScholarlyArticle' => __( 'Medical Scholarly Article', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Social Media', 'slim-seo-schema' ),
				'options' => [
					'SocialMediaPosting'     => __( 'Social Media Posting', 'slim-seo-schema' ),
					'BlogPosting'            => __( 'Blog Posting', 'slim-seo-schema' ),
					'LiveBlogPosting'        => __( 'Live Blog Posting', 'slim-seo-schema' ),
					'DiscussionForumPosting' => __( 'Discussion Forum Posting', 'slim-seo-schema' ),
				],
			],
			[
				'label'   => __( 'Tech', 'slim-seo-schema' ),
				'options' => [
					'TechArticle'  => __( 'Tech Article', 'slim-seo-schema' ),
					'APIReference' => __( 'API Reference', 'slim-seo-schema' ),
				],
			],
		],
		'std'      => 'Article',
	],
	Helper::get_property( 'name', [
		'std'     => '{{ post.title }}',
		'tooltip' => __( 'The name of the article.', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'url', [
		'required' => true,
		'std'      => '{{ post.url }}',
	] ),
	[
		'label'    => __( 'Headline', 'slim-seo-schema' ),
		'id'       => 'headline',
		'type'     => 'Text',
		'required' => true,
		'tooltip'  => __( 'The headline of the article. Headlines should not exceed 110 characters.', 'slim-seo-schema' ),
		'std'      => '{{ post.title }}',
	],
	Helper::get_property( 'description', [
		'tooltip' => __( 'A description of the content.', 'slim-seo-schema' ),
	] ),
	[
		'id'       => 'author',
		'label'    => __( 'Author', 'slim-seo-schema' ),
		'tooltip'  => __( 'The author of the content.', 'slim-seo-schema' ),
		'std'      => '{{ schemas.person }}',
		'required' => true,
	],
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
		'label'    => __( 'Comment count', 'slim-seo-schema' ),
		'id'       => 'commentCount',
		'type'     => 'Text',
		'required' => true,
		'tooltip'  => __( 'The number of comments', 'slim-seo-schema' ),
		'std'      => '{{ post.comment_count }}',
	],
	[
		'label'    => __( 'Word count', 'slim-seo-schema' ),
		'id'       => 'wordCount',
		'type'     => 'Text',
		'required' => true,
		'tooltip'  => __( 'The number of words in the text of the Article', 'slim-seo-schema' ),
		'std'      => '{{ post.word_count }}',
	],
	[
		'label'   => __( 'Keywords', 'slim-seo-schema' ),
		'id'      => 'keywords',
		'type'    => 'Text',
		'show'    => true,
		'tooltip' => __( 'Tags used to describe this content. Multiple entries in a keywords list are typically delimited by commas', 'slim-seo-schema' ),
		'std'     => '{{ post.tags }}',
	],
	[
		'label'    => __( 'Sections', 'slim-seo-schema' ),
		'id'       => 'articleSection',
		'type'     => 'Text',
		'required' => true,
		'tooltip'  => __( 'Articles may belong to one or more sections in a magazine or newspaper, such as Sports, Lifestyle, etc', 'slim-seo-schema' ),
		'std'      => '{{ post.categories }}',
	],
	Helper::get_property( 'image', [ 'show' => true ] ),
	[
		'id'               => 'hasPart',
		'label'            => __( 'Subscription and pay-walled content', 'slim-seo-schema' ),
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
				'tooltip'  => __( 'Class name around each pay-walled section of your page.', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],
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
		'id'    => 'isPartOf',
		'label' => __( 'Is part of', 'slim-seo-schema' ),
		'std'   => '{{ schemas.webpage }}',
		'show'  => true,
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
		'id'      => 'speakable',
		'label'   => __( 'Speakable', 'slim-seo-schema' ),
		'type'    => 'Group',
		'tooltip' => __( 'The speakable property works for users in the U.S. that have Google Home devices set to English, and publishers that publish content in English.', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'SpeakableSpecification',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'      => 'cssSelector',
				'label'   => __( 'CSS selector', 'slim-seo-schema' ),
				'tooltip' => __( 'Addresses content in the annotated pages (such as class attribute). Use either CSS selector or xPath; don\'t use both.', 'slim-seo-schema' ),
				'show'    => true,
			],
			[
				'id'      => 'xPath',
				'label'   => __( 'xPath', 'slim-seo-schema' ),
				'tooltip' => __( 'Addresses content using xPaths (assuming an XML view of the content). Use either CSS selector or xPath; don\'t use both.', 'slim-seo-schema' ),
				'show'    => true,
			],
		],
	],
	Helper::get_property( 'mainEntity' ),
];
