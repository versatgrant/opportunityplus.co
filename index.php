<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
</head>

<body>
    <div>
        <nav class="navbar navbar-default navigation-clean-button">
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php" style="color:#4e8ce5;">Opportunity+ </a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="active" role="presentation"><a href="index.php">Home</a></li>
                        <li role="presentation"><a href="#">About</a></li>
                    </ul>
                    <p class="navbar-text navbar-right actions"><a class="navbar-link login" href="login.php">Sign In</a> <a class="btn btn-default action-button" role="button" href="register.php" style="background-color:#d63a39;">Sign Up</a></p>
                </div>
            </div>
        </nav>
    </div>
    <div style="background-image:url(&quot;assets/img/bg-intro.jpg&quot;);padding:50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6"><img src="assets/img/maxresdefault.jpg" width="90%"></div>
                <div class="col-md-6">
                    <div>
                        <p style="color:rgb(249,248,248);font-size:30px;">Lorem ipsum dolor sit amet. </p>
                        <p style="font-size:16px;color:rgb(251,251,251);">Lorem ipsum dolor sit amet, alia conceptam dissentiet eam eu, sea an legere tamquam. Ubique denique suscipit has ad, vis et erroribus expetendis, essent iisque referrentur eu quo. Ex mea. </p>
                        <input type="email" name="subscribe"
                        placeholder="Your Email" style="padding:5px 10px;margin:0px 0px 15px;">
                        <button class="btn btn-default btn-block" type="submit" style="width:100px;background-color:#d63a39;border-color:#d63a39;color:rgb(241,241,241);">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="projects-horizontal">
        <div class="container">
            <div class="intro">
                <h2 class="text-center" style="margin:20px 0px 10px;">Lorem Ipsum Dolor</h2>
                <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p>
            </div>
            <div class="row projects">
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/desk.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name">Summa </h3>
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/building.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name">Magna </h3>
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/loft.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name">Cumme </h3>
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/minibus.jpeg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name">Laude </h3>
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="testimonials">
        <h2 class="text-center">People Love Us!</h2>
        <blockquote>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer><em>Famous tech website</em></footer>
        </blockquote>
    </section>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Fantastic Features</h2>
                    <p>Morbi non mauris massa. Duis elit mauris, malesuada nec suscipit ac, bibendum sed augue. Maecenas condimentum magna gravida, laoreet nunc sed, euismod sem. </p>
                </div>
                <div class="col-md-6">
                    <div class="row icon-features">
                        <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-cloud"></i>
                            <p>Cloud-ready </p>
                        </div>
                        <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-piggy-bank"></i>
                            <p>Saves You Money</p>
                        </div>
                        <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-fire"></i>
                            <p>Fire Proof</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Opportunity+ © 2017</h5></div>
                <div class="col-sm-6 social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>