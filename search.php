<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <div class="container" style="margin:0px;">
        <div class="row">    
            <div class="col-xs-12">
                <div class="input-group">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept">Agency</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#agency">Agency</a></li>
                          <li><a href="#talent">Talent</a></li>
                          <li><a href="#project">Project</a></li>
                        </ul>
                    </div>
                    <input type="hidden" name="search_param" value="agency" id="search_param">         
                    <input id="search-value" type="text" class="form-control" name="x" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="submit-search" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div id="search-results">
        <ul id="result-list">
        <ul>
    </div>
    <script src="assets/js/search.js"></script>
</body>

</html>