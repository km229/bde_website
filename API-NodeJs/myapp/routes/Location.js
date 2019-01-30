var express = require('express');
var router = express.Router();
var passwordHash = require('password-hash');
var Location=require('../models/Location');
var test = require('../models/usersCtrl');

router.get('/:location_id?',function(req,res,next){
    if (test.token==req.body.token) {
        if(req.params.location_id){
            
            Location.getLocationById(req.params.location_id,function(err,rows){
                
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
            
            Location.getAllLocation(function(err,rows){
                
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
        Location.addLocation(req.body,function(err,count){
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
router.post('/:location_id',function(req,res,next){
    if (test.token==req.body.token) {
        Location.deleteAll(req.body,function(err,count){
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
router.delete('/:location_id',function(req,res,next){
    if (test.token==req.body.token) {
        Location.deleteLocation(req.params.location_id,function(err,count){
            
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
router.put('/:location_id',function(req,res,next){
    if (test.token==req.body.token) {
        Location.updateLocation(req.params.location_id,req.body,function(err,rows){
            
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