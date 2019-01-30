var express = require('express');
var router = express.Router();
var passwordHash = require('password-hash');
var Product=require('../models/Product');
var test = require('../models/usersCtrl');

router.get('/:product_id?',function(req,res,next){
    if (test.token==req.body.token) {
        if(req.params.product_id){
            
            Product.getProductById(req.params.product_id,function(err,rows){
                
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
            
            Product.getAllProduct(function(err,rows){
                
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
        Product.addProduct(req.body,function(err,count){
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
router.post('/:product_id',function(req,res,next){
    if (test.token==req.body.token) {
        Product.deleteAll(req.body,function(err,count){
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
router.delete('/:product_id',function(req,res,next){
    if (test.token==req.body.token) {
        Product.deleteProduct(req.params.product_id,function(err,count){
            
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
router.put('/:product_id',function(req,res,next){
    if (test.token==req.body.token) {
        Product.updateProduct(req.params.product_id,req.body,function(err,rows){
            
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