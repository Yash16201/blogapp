<?php include "layouts/header.php" ?>
<div class="container mt-5">
    <h3>Add New Blog</h3>
    <?php if(isset($_SESSION['accountcreated'])) { $this->flash('accountcreated','alert alert-success'); } ?>
    <form action="http://localhost/blogapp/blog/postit" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Blog Title</label>
          <input type="text" class="form-control" name="title" aria-describedby="helpId">
          <div class="error">
            <?php if(!empty($myData['titleErr'])): echo $myData['titleErr']; endif; ?>
          </div> 
        </div>
        <div class="form-group">
          <label for="description">Blog Description</label><br>
          <textarea name="description" class="form-cotrol" rows="5" cols="149"></textarea>
          <div class="error">
            <?php if(!empty($myData['descriptionErr'])): echo $myData['descriptionErr']; endif; ?>
          </div> 
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" name="image" class="form-control">
          <div class="error">
            <?php if(!empty($myData['imageErr'])): echo $myData['imageErr']; endif; ?>
          </div> 
        </div>
        <div class="form-group">
          <label for="visible_from">Visible From</label>
          <input type="date" name="visible_from" id="inputdate" class="form-control">
          <div class="error">
            <?php if(!empty($myData['visiblefromErr'])): echo $myData['visiblefromErr']; endif; ?>
          </div> 
        </div>
        <div class="form-group">
          <label for="visible_to">Visible To</label>
          <input type="date" name="visible_to" id="inputdateto" class="form-control">
          <div class="error">
            <?php if(!empty($myData['visibletoErr'])): echo $myData['visibletoErr']; endif; ?>
          </div> 
        </div>
        <input type="submit" name="submit" class="btn btn-primary my-3 form-control">
    </form>
</div>
<?php include "layouts/footer.php" ?>