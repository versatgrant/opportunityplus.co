<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
</head>
<body>
    <?php
            require("nav.php");
    ?>

    <div style="background-image:url(&quot;assets/img/bg-intro.jpg&quot;);padding:50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6"><img src="assets/img/maxresdefault.jpg" width="90%"></div>
                <div class="col-md-6">
                    <div>
                        <p style="color:rgb(249,248,248);font-size:30px;">Welcome to Opportunity+</p>
                        <p style="font-size:16px;color:rgb(251,251,251);">Opportunity+ is an additional tool that is provided via an online portal by Opportunity Inc. It allows Agencies(companies) to post projects and Talents (people) to work on those projects.</p>
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
                <h2 class="text-center" style="margin:20px 0px 10px;">Opportunity+ is for Everyone.</h2>
                <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p>
            </div>
            <div class="row projects">
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/desk.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name">Website</h3>
                            <p class="description">Work from your home or office with our user friendly, greatly designed website.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/building.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name">Mobile</h3>
                            <p class="description">Get our easy to use mobile app, which is just as great but a compact version of the website.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/loft.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name">Agencies</h3>
                            <p class="description">Agencies are allowed to post projects online and can also review the talent’s online profile and accept or reject their applications to work on projects.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/minibus.jpeg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name">Talents</h3>
                            <p class="description">Talents are allowed to browse and apply to projects through our website and mobile app.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="testimonials">
        <h2 class="text-center">People Love Us!</h2>
        <blockquote>
            <p>99% uptime on our website with little to no latency</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>