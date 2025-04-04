<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'schemaDocs',
		'type' => 'SchemaDocs',
		'url'  => 'https://schema.org/Movie',
		'show' => true,
	],
	Helper::get_property( 'name', [
		'required' => true,
		'tooltip'  => __( 'The name of the movie.', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'image', [
		'cloneable' => false,
		'required'  => true,
		'tooltip'   => __( 'An image that represents the movie.', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'dateCreated', [
		'show'    => true,
		'tooltip' => __( 'The date the movie was released in ISO 8601 format.', 'slim-seo-schema' ),
		'std'     => '{{ post.date }}',
	] ),
	[
		'id'          => 'director',
		'label'       => __( 'Director', 'slim-seo-schema' ),
		'tooltip'     => __( 'The director of the movie.', 'slim-seo-schema' ),
		'description' => __( 'Please create a Person schema and link to this property via a dynamic variable.', 'slim-seo-schema' ),
		'std'         => '{{ schemas.person }}',
		'show'        => true,
	],
	[
		'id'          => 'actor',
		'label'       => __( 'Actors', 'slim-seo-schema' ),
		'tooltip'     => __( 'Actors in the movie. Actors can be associated with individual items or with a series, episode, clip.', 'slim-seo-schema' ),
		'description' => __( 'Please create a Person schema and link to this property via a dynamic variable.', 'slim-seo-schema' ),
		'cloneable'   => true,
		'show'        => true,
	],
	[
		'id'      => 'duration',
		'label'   => __( 'Duration', 'slim-seo-schema' ),
		'tooltip' => __( 'The duration of the movie in ISO 8601 date format.', 'slim-seo-schema' ),
		'show'    => true,
	],
	[
		'id'          => 'musicBy',
		'label'       => __( 'Music by', 'slim-seo-schema' ),
		'tooltip'     => __( 'The composer of the soundtrack.', 'slim-seo-schema' ),
		'description' => __( 'Please create a Person or Organization schema and link to this property via a dynamic variable.', 'slim-seo-schema' ),
		'show'        => true,
	],
	[
		'id'          => 'productionCompany',
		'label'       => __( 'Production company', 'slim-seo-schema' ),
		'tooltip'     => __( 'The production company or studio responsible for the movie.', 'slim-seo-schema' ),
		'description' => __( 'Please create an Organization schema and link to this property via a dynamic variable.', 'slim-seo-schema' ),
		'show'        => true,
	],
	[
		'id'      => 'subtitleLanguage',
		'label'   => __( 'Subtitle language', 'slim-seo-schema' ),
		'tooltip' => __( 'Languages in which subtitles/captions are available, in IETF BCP 47 standard format.', 'slim-seo-schema' ),
		'show'    => true,
	],
	[
		'id'      => 'titleEIDR',
		'label'   => __( 'Title EIDR', 'slim-seo-schema' ),
		'tooltip' => __( 'An EIDR (Entertainment Identifier Registry) identifier representing at the most general/abstract level, a work of film or television.', 'slim-seo-schema' ),
	],
	Helper::get_property( 'VideoObject', [
		'id'      => 'trailer',
		'label'   => __( 'Trailer', 'slim-seo-schema' ),
		'tooltip' => __( 'The trailer of a movie', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'aggregateRating' ),
	[
		'id'          => 'review',
		'label'       => __( 'Review', 'slim-seo-schema' ),
		'tooltip'     => __( 'A review of the movie.', 'slim-seo-schema' ),
		'description' => __( 'Please create a Review snippet schema and link to this property via a dynamic variable.', 'slim-seo-schema' ),
	],
	Helper::get_property( 'url', [
		'tooltip' => __( 'The link to the movie.', 'slim-seo-schema' ),
		'std'     => '{{ post.url }}',
	] ),
	Helper::get_property( 'countryOfOrigin', [
		'tooltip' => __( 'The country of origin of the movie. This would be the country of the principle offices of the production company or individual responsible for the movie.', 'slim-seo' ),
	] ),
	Helper::get_property( 'mainEntityOfPage', [
		'show' => false,
	] ),
];
