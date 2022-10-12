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

    public function updateblog($blog){
        if($this->Query("UPDATE blog SET blog_title=?, blog_updated_at=? WHERE blog_id=? ", $blog)){
            return ['status' => 'ok'];
        }else{
            return ['status' => 'error'];
        }
    }

    public function updBlogDet($blogdetails){
        if($this->Query("UPDATE blog_details SET post_text=?, blog_attachment_1=?, visible_from=?, visible_to=? WHERE blog_id=? ", $blogdetails)){
            return ['status' => 'ok'];
        }
        else{
            return ['status' => 'error'];
        }
    }

    public function updBlogDetNotImage($blogdetails){
        if($this->Query("UPDATE blog_details SET post_text=?, visible_from=?, visible_to=? WHERE blog_id=? ", $blogdetails)){
            return ['status' => 'ok'];
        }
        else{
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

    public function fetchBlog($input,$limit){
        if($this->Query("SELECT blog.*,blog_details.* FROM blog INNER JOIN blog_details ON blog.blog_id = blog_details.blog_id  WHERE blog.blog_author=? AND blog.status=? LIMIT ".$limit ,$input)){
            $data =  $this->fetchAll();
            $count = $this->rowCount();
            return ['count'=> $count ,'data'=>$data];
        }
    }
    public function fetchTotal($input){
        if($this->Query("SELECT blog.*,blog_details.* FROM blog INNER JOIN blog_details ON blog.blog_id = blog_details.blog_id  WHERE blog.blog_author=? AND blog.status=?",$input)){
            $count = $this->rowCount();
            return $count;
        }
    }

    public function fetchBlogById($author,$id){
        if($this->Query("SELECT blog.*,blog_details.* FROM blog INNER JOIN blog_details ON blog.blog_id = blog_details.blog_id  WHERE blog.blog_author=? AND blog.blog_id=? AND blog.status=?",[$author,$id,1])){
            $data =  $this->fetchAll();
            return $data;
        }
    }

    public function deleteBlog($status,$id){
        if($this->Query("UPDATE blog_details SET status=? WHERE blog_id=?",[$status,$id])){
            if($this->Query("UPDATE blog SET status=? WHERE blog_id=?",[$status,$id])){
                return ['status' => 'ok'];
            }else{
                return ['status' => 'blognotdeleted'];
            }
        }else{
            return ['status' => 'blogdetailsnotdeleted'];
        }
    }

    

}

?>