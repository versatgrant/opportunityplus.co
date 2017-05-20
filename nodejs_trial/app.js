//require standard modules
var express = require('express');
var app = express();
var bodyParser = require('body-parser');

app.use(bodyParser.json() );
app.use(bodyParser.urlencoded({extended: true}));

//require custom controller modules
var loginController = require('./controllers/loginController');
var profileController = require('./controllers/profileController');

//set template engine
app.set('view engine', 'ejs');

//serve static files: html, js, images, etc.
app.use(express.static('./assets'));

//fire custom controller modules
loginController(app);
profileController(app);

//listen to port
app.listen(3000);
console.log('Now listening to port 3000');


