<?php include "layouts/header.php" ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <?php if(isset($_SESSION['accountcreated'])) { $this->flash('accountcreated','alert alert-success'); } ?>
                <h1>Login </h1>
                <form action="http://localhost/blogapp/accountController/login" method="post">
                    <div class="form-group">
                        <label class="form-label" for="name">Enter your email</label><br>
                        <input class="form-control" type="text" name="email">
                        <div class="error">
                            <?php if(!empty($myData['emailErr'])): echo $myData['emailErr']; endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Enter your password</label> <br>
                         <input class="form-control" type="password" name="password"> 
                         <div class="error">
                            <?php if(!empty($myData['passwordErr'])): echo $myData['passwordErr']; endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include "layouts/footer.php" ?>
    
   