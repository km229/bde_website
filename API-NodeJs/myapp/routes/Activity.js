var express = require('express');
var router = express.Router();
var Activity=require('../models/Activity');
var test = require('../models/usersCtrl');

router.get('/:activity_id?',function(req,res,next){
    if (test.token==req.body.token) {
        if(req.params.activity_id){
            
            
            Activity.getActivityById(req.params.activity_id,function(err,rows){
                
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
            
            Activity.getAllActivity(function(err,rows){
                
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
    if (test.token==req.body.token) {
        
        Activity.addActivity(req.body,function(err,count){
            
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
router.post('/:activity_id',function(req,res,next){
    if (test.token==req.body.token) {
        Activity.deleteAll(req.body,function(err,count){
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
router.delete('/:activity_id',function(req,res,next){
    if (test.token==req.body.token) {
        Activity.deleteActivity(req.params.activity_id,function(err,count){
            
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
router.put('/:activity_id',function(req,res,next){
    if (test.token==req.body.token) {
        Activity.updateActivity(req.params.activity_id,req.body,function(err,rows){
            
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