var db=require('../dbconnection'); //reference of dbconnection.js

var Product={
	
	getAllProduct:function(callback){
		
		return db.query("Select * from product",callback);
		
	},
	getProductById:function(product_id,callback){
		
		return db.query("select * from product where product_id=?",[product_id],callback);
	},
	addProduct:function(product,callback){
		console.log("inside service");
		console.log(product);
		return db.query("Insert into product Values(null,?,?,?,?,?,?)",[product.product_name,product.product_desc,product.product_price,product.product_img,product.product_sales_number,product.category_id_fk],callback);
	},
	deleteProduct:function(product_id,callback){
		return db.query("delete from product where product_id=?",[product_id],callback);
	},
	updateProduct:function(product_id,product,callback){
		return db.query("update product set product_name=?,product_desc=?,product_price=?,product_img=?,product_sales_number=?,category_id_fk=? where product_id=?",[product.product_name,product.product_desc,product.product_price,product.product_img,product.product_sales_number,product.category_id_fk,product_id],callback);
	}


};
module.exports=Product;