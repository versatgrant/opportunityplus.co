//build Database connection
var mysql = require('mysql');
var connection = mysql.createConnection({
	host: 'localhost',
	user: 'opportunity+',
	password: '',
	database: 'test',
});

module.exports = function(app){

	


	app.get('/profile', function(req, res){
		connection.connect(function(err){
			if(!err){
				var data = connection.query('SELECT * FROM users');
				res.render('profile', {users: data});
			}else{
				throw err;
			}
		});
		
	});

	/*app.post('/login', function(req, res){
		connection.connect(function(err){
			if(err){
				console.log('err');
				throw err;
			}else{
				var data = req.body;
				res.render('login');
				//resp.send(JSON.stringify(req.body));
				connection.end();
			}
		});
		
	});*/

};