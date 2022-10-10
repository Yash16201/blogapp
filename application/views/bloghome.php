<?php include "layouts/header.php" ?>
<div class="container">
    <h1>My Blogs</h1>
    <?php if(isset($_SESSION['bloginserted'])) { $this->flash('bloginserted','alert alert-success'); } ?>
    <a class="btn btn-primary float-end" href="http://localhost/blogapp/blog/add" role="button"> Add New </a>
    <table class="table mt-5">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>XYZ</td>
            <td>ABC XYZ LJK</td>
            <td>Edit/Delete</td>
            </tr>
        </tbody>
    </table>
</div>
<?php include "layouts/footer.php" ?>