<?php include "layouts/header.php" ?>
<div class="container">
    <h1>My Blogs</h1>
    <?php if(isset($_SESSION['bloginserted'])) { $this->flash('bloginserted','alert alert-success'); } ?>
    <?php if(isset($_SESSION['blogdeleted'])) { $this->flash('blogdeleted','alert alert-success'); } ?>
    <?php if(isset($_SESSION['blognotdeleted'])) { $this->flash('blognotdeleted','alert alert-success'); } ?>
    <a class="btn btn-primary float-end" href="http://localhost/blogapp/blog/add" role="button"> Add New </a>
    

    <div class="get-blogs">
        
    </div>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Blog</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete it</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="http://localhost/blogapp/blog/delete/<?php echo $blog->blog_id ; ?>" role="button">Delete</a>
      </div>
    </div>
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
</script>