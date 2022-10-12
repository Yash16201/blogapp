<?php

class blog extends framework{
    public function index(){
        if($this->getSession('userId')){
            // $blogModel = $this->model('blogModel');
            // $author = $this->getSession('userId');
            // $data = $blogModel->fetchBlog($author);
            $this->view("bloghome");
        }else{
            header("location: http://localhost/blogapp/accountController/signin");
        }   
    }
    public function blogsearch(){
        $blogModel = $this->model('blogModel');
        $author = $this->getSession('userId');
        $status=1;
        $output = '';
        if($this->getSession('userId')){
            $key = $this->input('key');
            $finalkey= "%".$key."%";
            $input = [$author,$status,$finalkey];
            $fetch = $blogModel->searchBlog($input);
            $output .= '
            <table class="table mt-5">
                <thead>
                    <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
            ';
            if(!empty($fetch)){
                foreach($fetch as $blogop){
                    $output .= '
                    <tr>
                        <td>
                            <p>'.ucfirst($blogop->blog_title).'</p>
                        </td>
                        <td>
                            <p>'.ucfirst($blogop->post_text).'</p>
                        </td>
                        <td>
                            <a class="btn btn-success" href="http://localhost/blogapp/blog/myblogs/'.ucfirst($blogop->blog_id).'" role="button">View <span> 
                            <a class="btn btn-primary mx-2" href="http://localhost/blogapp/blog/edit/'.ucfirst($blogop->blog_id).'" role="button">Edit</a> </span> <span>
                            <a class="btn btn-danger" href="http://localhost/blogapp/blog/delete/'.ucfirst($blogop->blog_id).'" role="button">Delete</a>
                        </td>
                     </tr>
                     
                    ';
                }
            }else{
                $output .= '
                    <tr>
                        <td colspan="3" class="text-center"> No such data </td> 
                    </tr>
                ';
            }
            $output .= '
                </tbody>
                </table>
            ';
            print $output;

        }else{
            header("location: http://localhost/blogapp/accountController/signin");
        }
    }
    public function bloglist(){
        $blogModel = $this->model('blogModel');
        $author = $this->getSession('userId');
        
        if($this->getSession('userId')){
            $limit = 4;
            $page = 0;
            $output = '';
            $pageinp = $this->input('page');
            if(isset($pageinp)){
                $page = $pageinp;
            }else{
                $page = 1;
            }
            $start_from = ($page-1)*$limit;
            $status=1;
            $totallimit = $start_from.", ".$limit;
            $input = [$author,$status];
            $fetch = $blogModel->fetchBlog($input,$totallimit);
            $output .= '
            <table class="table mt-5">
                <thead>
                    <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
            ';
            
            foreach($fetch['data'] as $blogop){
                $output .= '
                <tr>
                    <td>
                        <p>'.ucfirst($blogop->blog_title).'</p>
                    </td>
                    <td>
                        <p>'.ucfirst($blogop->post_text).'</p>
                    </td>
                    <td>
                        <a class="btn btn-success" href="http://localhost/blogapp/blog/myblogs/'.ucfirst($blogop->blog_id).'" role="button">View <span> 
                        <a class="btn btn-primary mx-2" href="http://localhost/blogapp/blog/edit/'.ucfirst($blogop->blog_id).'" role="button">Edit</a> </span> <span>
                        <a class="btn btn-danger" href="http://localhost/blogapp/blog/delete/'.ucfirst($blogop->blog_id).'" role="button">Delete</a>
                    </td>
                 </tr>
                ';
            }
            $output .= '
                </tbody>
                </table>
            ';
            $totinp = [$author,$status];
            $fetchtotal = $blogModel->fetchTotal($totinp);
            $total_page = ceil($fetchtotal/$limit);
            $output .= '
            <nav aria-label="Page navigation example">
                <ul class="pagination">';
            
            if($page > 1){
                $previous = $page - 1;
                $output .= '<li class="page-item" id="1"><span class="page-link">First Page </span></li>';
                $output .= '<li class="page-item" id="'.$previous.'"><span class="page-link"> << </span></li>';
            }

            for($i=1; $i<=$total_page; $i++){
                $active_class = "";
                if($i == $page){
                    $active_class = "active";
                }
                $output .= '<li class="page-item '.$active_class.'" id="'.$i.'"><span class="page-link"> '.$i.' </span></li>'; 
            }

            if($page < $total_page){
                $page++;
                $output .= '<li class="page-item" id="'.$page.'"><span class="page-link"> >> </span></li>';
                $output .= '<li class="page-item" id="'.$total_page.'"><span class="page-link"> Last Page  </span></li>';
            }

            $output .= '</ul> 
            </nav>';

            print $output;            
        }else{
            // header("location: http://localhost/blogapp/accountController/signin");
        } 
    }
    public function myblogs($id){
        if($this->getSession('userId')){
            $blogModel = $this->model('blogModel');
            $author = $this->getSession('userId');
            $data = $blogModel->fetchBlogById($author,$id);
            $this->view("viewblog",$data);
        }else{
            header("location: http://localhost/blogapp/accountController/signin");
        }
    }
    public function edit($id){
        if($this->getSession('userId')){
            $blogModel = $this->model('blogModel');
            $author = $this->getSession('userId');
            $data = $blogModel->fetchBlogById($author,$id);
            $this->view("editblog",$data);
        }else{
            header("location: http://localhost/blogapp/accountController/signin");
        }
    }
    public function delete($id){
        if($this->getSession('userId')){
            $status = 0;
            $blogModel = $this->model('blogModel');
            $result = $blogModel->deleteBlog($status,$id);
            if($result['status'] === 'ok'){
                $this->setFlash("blogdeleted","Blog deleted successfully");
                header("location: http://localhost/blogapp/blog/");
            }elseif($result['status'] === 'blognotdeleted'){
                $this->setFlash("blognotdeleted","There is some problem in blog so not deleted");
                header("location: http://localhost/blogapp/blog/");
            }elseif($result['status'] === 'blogdetailsnotdeleted') {
                $this->setFlash("blognotdeleted","There is some problem in blog so not deleted");
                header("location: http://localhost/blogapp/blog/");
            }
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
            $blogData['visibletoErr'] = 'This field is required';
        }
        if($blogData['visible_to'] < $blogData['visible_from']){
            $blogData['visibletoErr'] = 'Visible from should not be lesser than visible to';
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
                header("location: http://localhost/blogapp/blog/");
            }elseif($result['status'] === 'error'){
                $this->setFlash("blogfailed","Blog creation failed");   
                header("location: http://localhost/blogapp/blog/add");   
            }   
        }else{
            $this->view('addblog',$blogData);   
        }
    }
    public function update(){
        $blogModel = $this->model('blogModel');
        $blogData = [
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'image' => $this->file('image','name'),
            'visible_from' => $this->input('visible_from'),
            'visible_to' => $this->input('visible_to'),
            'id' => $this->input('id'),
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
        if($blogData['visible_to'] < $blogData['visible_from']){
            $blogData['visibletoErr'] = 'Visible from should not be lesser than visible to';
        }
        
        if(empty($blogData['titleErr']) && empty($blogData['descriptionErr']) && empty($blogData['imageErr']) && empty($blogData['visiblefromErr']) && empty($blogData['visibletoErr'])){
            $today = date('Y-m-d H:i:s');
            $blogupddata = [$blogData['title'],$today,$blogData['id']];
            if(empty($blogData['image'])){
                $result = $blogModel->updateblog($blogupddata);
                if($result['status'] === 'ok'){
                    $blogdetdata = [$blogData['description'],$blogData['visible_from'],$blogData['visible_to'],$blogData['id']];
                    $result2 = $blogModel->updBlogDetNotImage($blogdetdata);
                    if($result2['status'] === 'ok'){
                        $this->setFlash("bloginserted","Blog updated successfully");
                    }
                    header("location: http://localhost/blogapp/blog/");
                }elseif($result['status'] === 'error'){
                    $this->setFlash("blogfailed","Blog updation failed");   
                    header("location: http://localhost/blogapp/blog/add");   
                }
            }
            else{
                $result = $blogModel->updateblog($blogupddata);
                if($result['status'] === 'ok'){
                    $blogdetdata = [$blogData['description'],$blogData['image'],$blogData['visible_from'],$blogData['visible_to'],$blogData['id']];
                    $result2 = $blogModel->updBlogDet($blogdetdata);
                    if($result2['status'] === 'ok'){
                        $temp_img = $this->tmp_file('image','tmp_name');
                        if(move_uploaded_file($temp_img,"../public/assets/img/".$blogData['image']) == true){
                            $this->setFlash("bloginserted","Blog updated successfully");
                        }else{
                            $this->setFlash("blogfailed","Image post failed");   
                        }
                    }
                    header("location: http://localhost/blogapp/blog/");
                }elseif($result['status'] === 'error'){
                    $this->setFlash("blogfailed","Blog updation failed");   
                    header("location: http://localhost/blogapp/blog/add");   
                }
            }
               
        }else{
            $this->view('editblog',$blogData);  
        }
    }
}
?>