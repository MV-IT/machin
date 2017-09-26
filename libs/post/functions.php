<?php

function get_post_permalink($post_id){
	$nkdb = new Database();

	$post = $nkdb->getRow("SELECT * FROM posts WHERE ID = '$post_id'");

	return get_web_url().'/post/'.$post['post_type'].'/'.$post['url'];

}

function get_post_by_ID($post_id){
	$nkdb = new Database();

	return (object)$nkdb->getRow("SELECT * FROM posts WHERE ID = '$post_id'");
}

function get_post_type_title($post_type_slug){
	$list_post_type = get_web_option('post_type');
	foreach ($list_post_type as $post_type){
		if($post_type[1] == $post_type_slug)
			return $post_type[0];
	}
}

?>