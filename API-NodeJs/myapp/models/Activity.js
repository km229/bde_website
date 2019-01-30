var db=require('../dbconnection'); //reference of dbconnection.js

var Activity={
	
	getAllActivity:function(callback){
		
		return db.query("Select * from activity",callback);
		
	},
	getActivityById:function(activity_id,callback){
		
		return db.query("select * from activity where activity_id=?",[activity_id],callback);
	},
	addActivity:function(activity,callback){
		console.log("inside service");
		return db.query("Insert into activity Values(null,?,?,?,?,?,?)",[activity.activity_title,activity.activity_desc,activity.activity_date,activity.activity_img,activity.activity_price,activity.activity_recurrence],callback);
	},
	deleteActivity:function(activity_id,callback){
		return db.query("delete from activity where activity_id=?",[activity_id],callback);
	},
	updateActivity:function(activity_id,activity,callback){
		return db.query("update activity set activity_title=?,activity_desc=?,activity_date=?,activity_img=?,activity_price=?,activity_recurrence=? where activity_id=?",[activity.activity_title,activity.activity_desc,activity.activity_date,activity.activity_img,activity.activity_price,activity.activity_recurrence,activity_id],callback);
	}


}; 	
module.exports=Activity;
