<html>
<head>
    <title>Project Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-drawer/1.0.6/css/bootstrap-drawer.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/user-mode.css">
    <link rel="stylesheet" href="assets/css/login/loginModal.css">
    <link href="assets/css/kanbanstyle.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="container-fluid">
        <div id="sortableKanbanBoards" class="row">

            <!--Milestone-->
            <div class="panel panel-primary kanban-col">
            <!--Milestone Title-->
                <div class="panel-heading">
                    TODO
                    <i class="fa fa-lg fa-pencil pull-right"></i>
                </div>
                <!--Task Section-->
                <div class="panel-body">
                    <div id="TODO" class="kanban-centered">
                    <!--Task-->
                        <article class="kanban-entry" id="item1">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <div class="toolbar">
                                        <a href="#accomplishment" class="pull-right tool delete" style="color: black;"><span class="glyphicon glyphicon-remove"></span></a>
                                    </div>
                                    <h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
                                    <p>
                                        Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.
                                        <br>
                                            <a href="https://google.com" target="_blank" style="text-decoration: underline; color:black;">Edit</a>
                                            <span class="pull-right badge Public">Complete</span>
                                        <br>
                                    </p>
                                    
                                </div>
                            </div>
                        </article>

                        <article class="kanban-entry" id="item2">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Job Meeting</a></h2>
                                    <p>You have a meeting at <strong>Laborator Office</strong> Today.
                                    <br><span class="pull-right badge">In-Progress</span><br>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="#">Add a task...</a>
                </div>
            </div>

        </div>
    </div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/kanban.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>