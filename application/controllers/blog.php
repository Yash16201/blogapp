<?php

class blog extends framework{
    public function index(){
        if($this->getSession('userId')){
            $this->view("bloghome");
        }else{
            header("location: http://localhost/blogapp/accountController/signin");
        }   
    }
    public function add(){
        if($this->getSession('userId')){
            $this->view("addblog");
        }else{
            header("location: http://localhost/blogapp/accountController/signin");
        }
    }
    public function postit(){
        $blogModel = $this->model('blogModel');
        $blogData = [
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'image' => $this->file('image','name'),
            'visible_from' => $this->input('visible_from'),
            'visible_to' => $this->input('visible_to'),
            'titleErr' => '',
            'descriptionErr' => '',
            'imageErr' => '',
            'visiblefromErr' => '',
            'visibletoErr' => '',
        ];
        // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
        // $imgExt= array("jpeg","jpg","png");

        // if(in_array($file_ext,$imgExt) === false){
        //     $blogData['imageErr']="extension not allowed, please choose a JPEG or PNG file.";
        //  }
        if(empty($blogData['title'])){
            $blogData['titleErr'] = 'This field is required';
        }
        if(empty($blogData['description'])){
            $blogData['descriptionErr'] = 'This field is required';
        }
        if(empty($blogData['visible_from'])){
            $blogData['visiblefromErr'] = 'This field is required';
        }
        if(empty($blogData['visible_to'])){
            $blogData['visible_to'] = 'This field is required';
        }
        if(empty($blogData['titleErr']) && empty($blogData['descriptionErr']) && empty($blogData['imageErr']) && empty($blogData['visiblefromErr']) && empty($blogData['visibletoErr'])){
            $author = $this->getSession('userId');
            $status = 1;
            $today = date('Y-m-d H:i:s');
            $bloginsdata = [$blogData['title'],$author,$today,$today,$status];
            $result = $blogModel->addblog($bloginsdata);
            if($result['status'] === 'ok'){
                $blogdetdata = [$result['data'],$blogData['description'],$blogData['image'],$blogData['visible_from'],$blogData['visible_to']];
                $result2 = $blogModel->addBlogDet($blogdetdata);
                if($result2['status'] === 'ok'){
                    $temp_img = $this->tmp_file('image','tmp_name');
                    if(move_uploaded_file($temp_img,"../public/assets/img/".$blogData['image']) == true){
                        $this->setFlash("bloginserted","Blog created successfully");
                    }else{
                        $this->setFlash("blogfailed","Image post failed");   
                    }
                }
                $this->view("bloghome");  
            }elseif($result['status'] === 'error'){
                $this->setFlash("blogfailed","Blog creation failed");   
                $this->view("addblog");   
            }   
        }else{
            $this->view("login",$userData);
        }

        
    }
}
?>