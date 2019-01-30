var db=require('../dbconnection'); //reference of dbconnection.js

var Location={
	
	getAllLocation:function(callback){
		
		return db.query("Select * from location",callback);
		
	},
	getLocationById:function(location_id,callback){
		
		return db.query("select * from location where location_id=?",[location_id],callback);
	},
	addLocation:function(location,callback){
		console.log("inside service");
		return db.query("Insert into location Values(null,?)",[location.location_center],callback);
	},
	deleteLocation:function(location_id,callback){
		return db.query("delete from location where location_id=?",[location_id],callback);
	},
	updateLocation:function(location_id,location,callback){
		return db.query("update location set state_name=?,is_admin=?,location_id_fk=? where location_id=?",[location.location_center,location_id],callback);
	}


};
module.exports=Location;