<?php include "layouts/header.php" ?>
<div class="container mt-5">
    <h3>Add New Blog</h3>
    <?php if(isset($_SESSION['blogfailed'])) { $this->flash('accountcreated','alert alert-success'); } ?>
    <form action="http://localhost/blogapp/blog/postit" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Blog Title</label>
          <input type="text" class="form-control" name="title" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
          <label for="description">Blog Description</label><br>
          <textarea name="description" class="form-cotrol" rows="5" cols="149"></textarea>
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
          <label for="visible_from">Visible From</label>
          <input type="date" name="visible_from" id="inputdate" class="form-control">
        </div>
        <div class="form-group">
          <label for="visible_to">Visible To</label>
          <input type="date" name="visible_to" id="inputdate" class="form-control">
        </div>
        <input type="submit" name="submit" class="btn btn-primary my-3 form-control">Submit
    </form>
</div>
<?php include "layouts/footer.php" ?>