// Imports
var express = require('express');
var router = express.Router();
var usersCtrl = require('../models/usersCtrl');
var jwt = require('../utils/jwt.utils');

router.post('/login',function(req,res,next){
    if(req.body.username == usersCtrl.username && req.body.password == usersCtrl.password){
        token=jwt.generateTokenForUser();    
        usersCtrl.token = token;    
        res.json(usersCtrl.token);
    }
});
module.exports=router;

