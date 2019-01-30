var express = require('express');
var router = express.Router();
var Category=require('../models/Category');
var test = require('../models/usersCtrl');

router.get('/:category_id?',function(req,res,next){
    if (test.token==req.body.token) {
        if(req.params.category_id){
            
            Category.getCategoryById(req.params.category_id,function(err,rows){
                
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
            
            Category.getAllCategory(function(err,rows){
                
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
        Category.addCategory(req.body,function(err,count){
            
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
router.post('/:category_id',function(req,res,next){
    if (test.token==req.body.token) {
        Category.deleteAll(req.body,function(err,count){
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
router.delete('/:category_id',function(req,res,next){
    if (test.token==req.body.token) {
        Category.deleteCategory(req.params.category_id,function(err,count){
            
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
router.put('/:category_id',function(req,res,next){
    if (test.token==req.body.token) {
        Category.updateCategory(req.params.category_id,req.body,function(err,rows){
            
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