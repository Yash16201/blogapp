<?php include "layouts/header.php" ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="form-label" for="name">Enter your email</label><br>
                        <input class="form-control" type="text" name="email"><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Enter your password</label> <br>
                         <input class="form-control" type="password" name="password"> <br>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include "layouts/footer.php" ?>
    
   