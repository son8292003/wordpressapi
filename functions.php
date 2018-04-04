<?php
/**
 *
 */


//Add custom post type 'Project'
function create_posttype() {
 
    register_post_type( 'project',
        array(
            'labels' => array(
                'name' => __( 'Projects' ),
                'singular_name' => __( 'Project' )
            ),
            'public' => true,
            'has_archive' => true,
			'show_in_rest' => true,
			'rest_base' => 'projects',
            'rewrite' => array('slug' => 'projects'),
			'taxonomies' => array( 'category' ),
        )
    );
}
add_action( 'init', 'create_posttype' );



function get_project_list( $data ) {
	$posts = get_posts( array(
		'post_type' => 'project',
		"s" => $data['search'],
	) );
 
	if ( empty( $posts ) ) {
		return null;
	}
 
	foreach($posts as $post) {
		$authordata = get_userdata( intval($post->post_author));
		$post->author_name = $authordata->first_name." ".$authordata->last_name;
		$post->author_email = $authordata->user_email;
		$categories = get_the_category($post->ID);
		if ( !empty( $categories ) ) {
			$category_names = array();
			foreach($categories as $category){
				array_push($category_names, $category->cat_name);
			}
			$post->categories = $category_names;
		}
	}
 
	return $posts;
}



add_action( 'rest_api_init', function () {
	register_rest_route( 'test/v1', '/projects', array(
		'methods' => 'GET',
		'callback' => 'get_project_list',
	) );
} );