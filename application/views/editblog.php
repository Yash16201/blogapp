<?php include "layouts/header.php" ?>
<div class="container my-5">

    <h3>Edit Blog</h3>
    
    <form action="http://localhost/blogapp/blog/update/" method="post" enctype="multipart/form-data">
    <?php if(!empty($myData)) { ?>
        <?php foreach($myData as $blog): ?>
                <div class="form-group">
                    <label for="title">Blog Title</label>
                    <input type="text" class="form-control" name="title" aria-describedby="helpId" value="<?= $blog->blog_title ?>">
                    <div class="error">
                        <?php if(!empty($myData['titleErr'])): echo $myData['titleErr']; endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Blog Description</label><br>
                    <textarea name="description" class="form-cotrol" rows="5" cols="149"><?= $blog->post_text ?></textarea>
                    <div class="error">
                        <?php if(!empty($myData['descriptionErr'])): echo $myData['descriptionErr']; endif; ?>
                    </div> 
                </div>
                <div class="form-group">
                    <label for="image">Image :- <?= $blog->blog_attachment_1 ?> (by default)</label>
                    <input type="file" name="image" class="form-control" value="<?= $blog->blog_attachment_1 ?>"/>  
                    <div class="error">
                        <?php if(!empty($myData['imageErr'])): echo $myData['imageErr']; endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="visible_from">Visible From</label>
                    <input type="date" name="visible_from" id="inputdate" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($blog->visible_from)); ?>">
                    <div class="error">
                        <?php if(!empty($myData['visiblefromErr'])): echo $myData['visiblefromErr']; endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="visible_to">Visible To</label>
                    <input type="date" name="visible_to" id="inputdate" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($blog->visible_to)); ?>">
                    <div class="error">
                        <?php if(!empty($myData['visibletoErr'])): echo $myData['visibletoErr']; endif; ?>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $blog->blog_id ?>" >
                <input type="hidden" name="img" value="<?= $blog->blog_attachment_1 ?>" >
                <input type="submit" name="submit" class="btn btn-primary my-3 form-control">
        <?php endforeach; ?>
    </form>
    <?php } else{ ?>
        <h1>There is no such a blog</h1>
    <?php  } ?>
    
    
</div>
<?php include "layouts/footer.php" ?>