var db=require('../dbconnection'); //reference of dbconnection.js

var Category={
	
	getAllCategory:function(callback){
		
		return db.query("Select * from category",callback);
		
	},
	getCategoryById:function(category_id,callback){
		
		return db.query("select * from category where category_id=?",[category_id],callback);
	},
	addCategory:function(category,callback){
		console.log("inside service");
		return db.query("Insert into category Values(null,?)",[category.category_name],callback);
	},
	deleteCategory:function(category_id,callback){
		return db.query("delete from category where category_id=?",[category_id],callback);
	},
	updateCategory:function(category_id,category,callback){
		return db.query("update category set category_name=? where category_id=?",[category_name,member_id],callback);
	}


};
module.exports=Category;