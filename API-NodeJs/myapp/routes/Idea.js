var express = require('express');
var router = express.Router();
var Idea=require('../models/Idea');
var test = require('../models/usersCtrl');

router.get('/:idea_id?',function(req,res,next){
    if (test.token==req.body.token) {
        if(req.params.idea_id){
            
            Idea.getIdeaById(req.params.idea_id,function(err,rows){
                
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
            
            Idea.getAllIdea(function(err,rows){
                
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
        Idea.addIdea(req.body,function(err,count){
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
router.post('/:idea_id',function(req,res,next){
    if (test.token==req.body.token) {
        Idea.deleteAll(req.body,function(err,count){
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
router.delete('/:idea_id',function(req,res,next){
    if (test.token==req.body.token) {
        Idea.deleteIdea(req.params.idea_id,function(err,count){
            
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
router.put('/:idea_id',function(req,res,next){
    if (test.token==req.body.token) {
        Idea.updateIdea(req.params.idea_id,req.body,function(err,rows){
            
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