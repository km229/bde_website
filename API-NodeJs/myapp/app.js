var express = require('express');
var path = require('path');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var cors=require('cors');
var routes = require('./routes/index');
var users = require('./routes/users');
var Members=require('./routes/Members');
var Activity=require('./routes/Activity');
var Category=require('./routes/Category');
var Product=require('./routes/Product');
var Idea=require('./routes/Idea');
var Location=require('./routes/Location');
var usersCtrl = require('./routes/usersCtrl');
var app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jade');

//uncomment after placing your favicon in /public
app.use(cors());
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));
app.use('/usersCtrl',usersCtrl);
app.use('/', routes);
app.use('/users', users);
app.use('/Members',Members);
app.use('/Activity',Activity);
app.use('/Category',Category);
app.use('/Product',Product);
app.use('/Idea',Idea);
app.use('/Location',Location);




// catch 404 and forward to error handler
app.use(function(req, res, next) {
    var err = new Error('Not Found');
    err.status = 404;
    next(err);
});

// error handlers

// development error handler
// will print stacktrace
if (app.get('env') === 'development') {
    app.use(function(err, req, res, next) {
        res.status(err.status || 500);
        res.render('error', {
            message: err.message,
            error: err
        });
    });
}

// production error handler
// no stacktraces leaked to user
app.use(function(err, req, res, next) {
    res.status(err.status || 500);
    res.render('error', {
        message: err.message,
        error: {}
    });
});
module.exports = app;