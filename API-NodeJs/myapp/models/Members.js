var db=require('../dbconnection'); //reference of dbconnection.js

var Members={
	
	getAllMembers:function(callback){
		
		return db.query("Select * from members",callback);
		
	},
	getMembersById:function(member_id,callback){
		
		return db.query("select * from members where member_id=?",[member_id],callback);
	},
	addMembers:function(members,callback){
		console.log("inside service");
		console.log(members.member_password);
		return db.query("Insert into members Values(null,?,?,?,?,?,?,?)",[members.member_firstname,members.member_lastname,members.member_mail,members.member_password,members.state_name,members.is_admin,members.location_id_fk],callback);
	},
	deleteMembers:function(member_id,callback){
		return db.query("delete from members where member_id=?",[member_id],callback);
	},
	updateMembers:function(member_id,members,callback){
		return db.query("update members set member_firstname=?,member_lastname=?,member_mail=?,member_password=?,state_name=?,is_admin=?,location_id_fk=? where member_id=?",[members.member_firstname,members.member_lastname,members.member_mail,members.member_password,members.state_name,members.is_admin,members.location_id_fk,member_id],callback);
	}


};
module.exports=Members;