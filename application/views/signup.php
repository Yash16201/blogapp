<?php 
$title = "Register";
include "layouts/header.php" ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <h1>SignUp</h1>
                <p>Already have a account ! <span> <a href="http://localhost/blogapp/accountController/signin"> Login </a>  </span> </p>
                <form action="http://localhost/blogapp/accountController/signUp" method="post">
                    <div class="form-group">
                        <label class="form-label" for="name">Enter your name</label><br>
                        <input class="form-control" type="text" name="name">
                        <div class="error">
                            <?php if(!empty($myData['nameErr'])): echo $myData['nameErr']; endif; ?>
                        </div>    
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Enter your email</label><br>
                        <input class="form-control" type="text" name="email">
                        <div class="error">
                            <?php if(!empty($myData['emailErr'])): echo $myData['emailErr']; endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Gender</label><br>
                        <input class="form-check-input" type="radio" name="gender" value="Male">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Male
                        </label>
                        <input class="form-check-input" type="radio" name="gender" value="Female">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Female
                        </label>
                        <input class="form-check-input" type="radio" name="gender" value="Other">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Other
                        </label>
                        <div class="error">
                            <?php if(!empty($myData['genderErr'])): echo $myData['genderErr']; endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="contact">Enter your contact</label> <br>
                        <input class="form-control" type="text" name="contact"> 
                        <div class="error">
                            <?php if(!empty($myData['contactErr'])): echo $myData['contactErr']; endif; ?>
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
    