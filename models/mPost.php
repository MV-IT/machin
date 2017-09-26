<?php

/**
 * author Niku
 */
class mPost extends Database
{
    public function listPost($post_type_slug, $limit = 0, $num_per_page = 24, $s = '')
    {
        $post_type_slug = $this->escape_string($post_type_slug);
        $sql = "SELECT * FROM posts WHERE post_type = '$post_type_slug'";

        $limit = (int)$limit;
        $num_per_page = (int)$num_per_page;
        
        if(!empty($s)){
            $s = $this->escape_string($s);
            $sql .= " AND post_title LIKE '%$s%'";
        }
        $sql .= " ORDER BY ID DESC LIMIT $limit, $num_per_page";
        return $this->getList($sql);
    }

    public function numAllPost($post_type_slug, $s = ''){
        $sql = "SELECT * FROM posts WHERE post_type = '$post_type_slug'";
        
        if(!empty($s)){
            $s = $this->escape_string($s);
            $sql .= " AND post_title LIKE '%$s%' ORDER BY ID DESC";
        }
    	return $this->getNumRows($sql);
    }

    public function getPost($id){
    	return (object)$this->getRow("SELECT * FROM posts WHERE ID = '$id'");
    }

    public function deletePost($post_id){
        $image = basename(get_post_by_ID($post_id)->post_thumbnail);
        delete_file($image, 'post');
        if($this->deleteRow('post_terms', "post_id = '$post_id'"))
            return $this->deleteRow('posts', "ID = '$post_id'");
    }

    public function addNewCategory($cate_title, $cate_slug, $post_type){
        return $this->insert('terms', array('title' => $cate_title, 'slug' => $cate_slug, 'post_type' => $post_type));
    }

    public function editCategory($cate, $id){
        return $this->update('terms', $cate, "ID = '$id'");
    }

    public function deleteCategory($cate_id){
        return $this->deleteRow('terms', "ID = '$cate_id'");
    }

    public function getListCategories($post_type_slug){
        return $this->getList("SELECT ID, title, slug FROM terms WHERE post_type = '$post_type_slug'");
    }

    public function getListPostCategories($post_id){
        return $this->getList("SELECT term_id FROM post_terms WHERE post_id = '$post_id'");
    }

    public function getPostByCategory($cate_id, $limit = 0, $num_per_page = 4)
    {
        $sql = "SELECT posts.* FROM posts JOIN post_terms ON (post_terms.term_id = '$cate_id' AND posts.ID = post_terms.post_id) ORDER BY posts.ID DESC LIMIT $limit, $num_per_page";

        return $this->getList($sql);
    }

    public function getListLastestPost($post_type)
    {
        return $this->getList("SELECT * FROM posts WHERE post_type = '$post_type' ORDER BY ID DESC LIMIT 0, 4");
    }

    public function getListRandomPosts($post_type)
    {
        $sql = "SELECT * FROM posts WHERE post_type = '$post_type' ORDER BY RAND() LIMIT 0, 5";
        return $this->getList($sql);
    }

    public function getPostByUrl($url){
        return $this->getRow("SELECT * FROM posts WHERE url = '$url'");
    }
}

?>