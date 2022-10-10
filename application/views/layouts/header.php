<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <title>Blog App</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/blogapp/blog/">Blog App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="http://localhost/blogapp/blog/">Home</a>
                </li>
                <!-- <?php if(!$this->getSession('userId')){ ?>
                <li class="nav-item">
                <a class="nav-link" href="http://localhost/blogapp/accountController/index">SignUp</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="http://localhost/blogapp/accountController/signin">SignIn</a>
                </li>
                <?php } ?> -->
            </ul>
            
            <form class="d-flex" method="post" action="http://localhost/blogapp/accountController/logout">
              <?php if($this->getSession('userId')){ ?>
                <button class="btn btn-outline-success" type="submit">Logout</button>
              <?php } else { ?>
                <button class="btn btn-outline-success" type="submit">Login</button>
              <?php } ?>
            </form>
            </div>
        </div>
    </nav>
