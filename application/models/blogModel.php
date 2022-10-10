<?php

class blogModel extends database{
    public function addblog($blog){
        if($this->Query("INSERT INTO blog(blog_title, blog_author, blog_created_at, blog_updated_at, status) VALUES (?,?,?,?,?)", $blog)){
            $id = $this->lastInsertedId();
            return ['status' => 'ok', 'data' => $id];
        }else{
            return ['status' => 'error'];
        }
    }

    public function addBlogDet($blogdetails){
        if($this->Query("INSERT INTO blog_details(blog_id, post_text, blog_attachment_1, visible_from, visible_to) VALUES (?,?,?,?,?)", $blogdetails)){
            return ['status' => 'ok'];
        }
        else{
            return ['status' => 'error'];
        }
    }
}

?>