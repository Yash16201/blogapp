<?php 
foreach($myData as $blog){
    $title  = $blog->blog_title;
}
include "layouts/header.php" 
?>
<div class="container my-5">


    <?php if(!empty($myData)) { ?>
        <?php foreach($myData as $blog): ?>
            <b style="font-weight: bold;">Title :- </b> <?= $blog->blog_title ?> <br>
            <b style="font-weight: bold;">Description :- </b> <?= $blog->post_text ?> <br>
            <b style="font-weight: bold;">Image :- </b> <br>
                <?php echo "<img src='http://localhost/blogapp/assets/img/$blog->blog_attachment_1' width='150' height='150'/>" ?>

        <?php endforeach; ?>
    <?php } else{ ?>
        <h1>There is no such a blog</h1>
    <?php  } ?>
    
</div>
<?php include "layouts/footer.php" ?>