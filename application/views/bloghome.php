<?php include "layouts/header.php" ?>
<div class="container">
    <h1>My Blogs</h1>
    <?php if(isset($_SESSION['bloginserted'])) { $this->flash('bloginserted','alert alert-success'); } ?>
    <?php if(isset($_SESSION['blogdeleted'])) { $this->flash('blogdeleted','alert alert-success'); } ?>
    <?php if(isset($_SESSION['blognotdeleted'])) { $this->flash('blognotdeleted','alert alert-success'); } ?>
    <div class="row my-5">
      <div class="col-md-10">
        <input type="search" class="form-control" placeholder="Search Here"  name="search" id="search">
      </div>
      <div class="col-md-2">
        <a class="btn btn-primary float-end" href="http://localhost/blogapp/blog/add" role="button"> Add New </a>
      </div>
    </div>
    <div class="get-blogs">
        
    </div>

</div>
<?php include "layouts/footer.php" ?>
<script type="text/javascript">
  function fetch_blogs(page){
    $.ajax({
      url:"http://localhost/blogapp/blog/bloglist",
      method:"POST",
      data: {
        page:page
      },
      success: function(data){
        $(".get-blogs").html(data);
      } 
    }); 
  }
  fetch_blogs(1);
  $(document).on("click",".page-item",function(){
      var page = $(this).attr("id");
      fetch_blogs(page);
  });

  $(document).on("keyup","#search",function(){
      var key = $(this).val();
      if(!key.replace(/\s/g, '').length){
        fetch_blogs(1);
      }
      else{
        $.ajax({
          url:"http://localhost/blogapp/blog/blogsearch",
          method:"POST",
          data: {
            key:key
          },
          success: function(data){
            $(".get-blogs").html(data);
          } 
        });
      }
      
  });
</script>