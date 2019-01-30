var db=require('../dbconnection'); //reference of dbconnection.js

var Idea={
	
	getAllIdea:function(callback){
		
		return db.query("Select * from idea",callback);
		
	},
	getIdeaById:function(idea_id,callback){
		
		return db.query("select * from idea where idea_id=?",[idea_id],callback);
	},
	addIdea:function(idea,callback){
		return db.query("Insert into idea Values(null,?,?,null)",[idea.idea_title,idea.idea_desc],callback);
	},
	deleteIdea:function(idea_id,callback){
		return db.query("delete from idea where idea_id=?",[idea_id],callback);
	},
	updateIdea:function(idea_id,idea,callback){
		return db.query("update idea set idea_title=?,idea_desc=? where idea_id=?",[idea.idea_title,idea.idea_desc,idea_id],callback);
	}
	
	
};
module.exports=Idea;