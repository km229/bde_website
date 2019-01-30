var express = require('express');
var router = express.Router();
var passwordHash = require('password-hash');
var Members=require('../models/Members');
var test = require('../models/usersCtrl');

router.get('/:member_id?',function(req,res,next){
    if (test.token==req.body.token) {
        if(req.params.member_id){
            
            Members.getMembersById(req.params.member_id,function(err,rows){
                
                if(err)
                {
                    res.json(err);
                }
                else{
                    res.json(rows);
                }
            });
        }
        else{
            
            Members.getAllMembers(function(err,rows){
                
                if(err)
                {
                    res.json(err);
                }
                else
                {
                    res.json(rows);
                }
                
            });
        }
    } else {  
        return res.json({ success: false, message: 'Not connected' });
    };
});
router.post('/',function(req,res,next){
    var hashedPassword = passwordHash.generate(req.body.member_password);
    req.body.member_password = hashedPassword;
    if (test.token==req.body.token) {
        Members.addMembers(req.body,function(err,count){
            if(err)
            {
                res.json(err);
            }
            else{
                res.json(req.body);//or return count for 1 & 0
            }
            
        });
    } else {  
        return res.json({ success: false, message: 'Not connected' });
    };
});
router.post('/:member_id',function(req,res,next){
    if (test.token==req.body.token) {
        Members.deleteAll(req.body,function(err,count){
            if(err)
            {
                res.json(err);
            }
            else
            {
                res.json(count);
            }
        });
    } else {  
        return res.json({ success: false, message: 'Not connected' });
    };
});
router.delete('/:member_id',function(req,res,next){
    if (test.token==req.body.token) {
        Members.deleteMembers(req.params.member_id,function(err,count){
            
            if(err)
            {
                res.json(err);
            }
            else
            {
                res.json(count);
            }
            
        });
    } else {  
        return res.json({ success: false, message: 'Not connected' });
    };
});
router.put('/:member_id',function(req,res,next){
    if (test.token==req.body.token) {
        Members.updateMembers(req.params.member_id,req.body,function(err,rows){
            
            if(err)
            {
                res.json(err);
            }
            else
            {   
                res.json(rows);
            }
        });
    } else {  
        return res.json({ success: false, message: 'Not connected' });
    };
});
module.exports=router;