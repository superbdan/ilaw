
$(document).ready(function(){
	cat();
	brand();
	product();
	viewCart();
	userAddress();
	paymentTotal();
	// page();
	// function page(){
	// 	$.ajax({
	// 		url	:	"action.php",
	// 		method	:	"POST",
	// 		data	:	{page:1},
	// 		success	:	function(data){
	// 			$("#pageno").html(data);
	// 		}
	// 	})
	// }
	// $("body").delegate("#page","click",function(){
	// 	var pn = $(this).attr("page");
	// 	$.ajax({
	// 		url	:	"action.php",
	// 		method	:	"POST",
	// 		data	:	{getProduct:1,setPage:1,pageNumber:pn},
	// 		success	:	function(data){
	// 			$("#get_product").html(data);
	// 		}
	// 	})
	// })

	
	//cat() is a funtion fetching category record from database whenever page is load
	function cat(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{category:1},
			success	:	function(data){
				$("#get_category").html(data);
				
			}
		})
	}
	//brand() is a funtion fetching brand record from database whenever page is load
	function brand(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{brand:1},
			success	:	function(data){
				$("#get_brand").html(data);
			}
		})
	}
	//product() is a funtion fetching product record from database whenever page is load
		function product(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getProduct:1},
			success	:	function(data){
				$("#get_product").html(data);
				page();
			}
		})
	}
	function page(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{page:1},
			success	:	function(data){
				$("#pageno").html(data);
			}
		})
	}

	/*	when page is load successfully then there is a list of categories when user click on category we will get category id and 
		according to id we will show products
	*/
	$("body").delegate(".category","click",function(event){
		$("#get_product").html("<h3>Loading...</h3>");
		event.preventDefault();
		var cid = $(this).attr('cid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{get_seleted_Category:1,cat_id:cid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})

	/*	when page is load successfully then there is a list of brands when user click on brand we will get brand id and 
		according to brand id we will show products
	*/
	$("body").delegate(".selectBrand","click",function(event){
		event.preventDefault();
		$("#get_product").html("<h3>Loading...</h3>");
		var bid = $(this).attr('bid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{selectBrand:1,brand_id:bid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})
	/*
		At the top of page there is a search box with search button when user put name of product then we will take the user 
		given string and with the help of sql query we will match user given string to our database keywords column then matched product 
		we will show 
	*/
	$("#search_btn").click(function(){
		$("#get_product").html("<h3>Loading...</h3>");
		var keyword = $("#search").val();
		if(keyword != ""){
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{search:1,keyword:keyword},
			success	:	function(data){ 
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
		}
	})
	//end



	//Add Product into Cart
	$("body").delegate("#product","click",function(event){
		var pid = $(this).attr("pid");
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {addToCart:1,proId:pid,cartAdded:1},
			success : function(data){
				count_item();
				getCartItem();
				$('#product_msg').html(data);
				$('.overlay').hide();
			}
		})
	})
	//Add Product into Cart End Here
	//Count user cart items funtion
	count_item();
	function count_item(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {count_item:1},
			success : function(data){
				$(".badge").html(data);
			}
		})
	}
	//Count user cart items funtion end

	//Fetch Cart item from Database to dropdown menu
	getCartItem();
	function getCartItem(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,getCartItem:1},
			success : function(data){
				$("#cart_product").html(data);
			}
		})
	}

	//Fetch Cart item from Database to dropdown menu

	/*
		Whenever user change qty we will immediate update their total amount by using keyup funtion
		but whenever user put something(such as ?''"",.()''etc) other than number then we will make qty=1
		if user put qty 0 or less than 0 then we will again make it 1 qty=1
		('.total').each() this is loop funtion repeat for class .total and in every repetation we will perform sum operation of class .total value 
		and then show the result into class .net_total
	*/
	$("body").delegate(".qty","keyup",function(event){
		event.preventDefault();
		var row = $(this).parent().parent();
		var price = row.find('.price').val();
		var qty = row.find('.qty').val();
		if (isNaN(qty)) {
			qty = 1;
		};
		if (qty < 1) {
			qty = 1;
		};
		var total = price * qty;
		row.find('.total').val(total);
		var net_total=0;
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').html("Total : ₱ " +net_total);

	})
	//Change Quantity end here 

	/*
		whenever user click on .remove class we will take product id of that row 
		and send it to action.php to perform product removal operation
	*/
	$("body").delegate(".remove","click",function(event){
		var remove = $(this).parent().parent().parent();
		var remove_id = remove.find(".remove").attr("remove_id");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{removeItemFromCart:1,rid:remove_id},
			success	:	function(data){
				$("#cart_msg").html(data);
				checkOutDetails();
				getCartItem();
				window.location.reload();
			}
		})
	})
	/*
		whenever user click on .update class we will take product id of that row 
		and send it to action.php to perform product qty updation operation
	*/
	$("body").delegate(".update","click",function(event){
		var update = $(this).parent().parent().parent();
		var update_id = update.find(".update").attr("update_id");
		var qty = update.find(".qty").val();
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{updateCartItem:1,update_id:update_id,qty:qty},
			success	:	function(data){
				$("#cart_msg").html(data);
				checkOutDetails();
			}
		})


	})
	checkOutDetails();
	net_total();
	/*
		checkOutDetails() function work for two purposes
		First it will enable php isset($_POST["Common"]) in action.php page and inside that
		there is two isset funtion which is isset($_POST["getCartItem"]) and another one is isset($_POST["checkOutDetials"])
		getCartItem is used to show the cart item into dropdown menu 
		checkOutDetails is used to show cart item into Cart.php page
	*/
	function checkOutDetails(){
	 $('.overlay').show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,checkOutDetails:1},
			success : function(data){
				$('.overlay').hide();
				$("#cart_checkout").html(data);
					net_total();
			}
		})
	}

	function userAddress(){
		$('.overlay').show();
		   $.ajax({
			   url : "action.php",
			   method : "POST",
			   data : {Regular:1, userAddress:1},
			   success : function(data){	
				    $("#user_address").html(data);
				
			   }
		   })
	   }
	   
	function viewCart(){
		$('.overlay').show();
		   $.ajax({
			   url : "action.php",
			   method : "POST",
			   data : {Regular:1, viewCart:1},
			   success : function(data){	
				$('.overlay').hide();
				   $("#cart_view").html(data);
			   }
		   })
	   }

	   paymentTotal();
	   function paymentTotal(){
		$('.overlay').show();
		   $.ajax({
			   url : "action.php",
			   method : "POST",
			   data : {Regular:1, paymentTotal:1},
			   success : function(data){	
				$('.overlay').hide();
				   $("#payment_total").html(data);
			   }
		   })
	   }

	/*
		net_total function is used to calcuate total amount of cart item
	*/
	function net_total(){
		var net_total = 0;
		$('.qty').each(function(){
			var row = $(this).parent().parent();
			var price  = row.find('.price').val();
			var total = price * $(this).val()-0;
			row.find('.total').val(total);
		})
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').html("Total : "+ CURRENCY +  net_total.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
	}

	total_payment();
	//Total payment
	function total_payment(){
		var total_payment = 0;
		$('.total_price').each(function(){
			var row = $(this).parent().parent();
			var total_price  = row.find('.total_price').val();
			var shipping_fee = 40;
			row.find('.total_price').val(total_price);
		})
		$('.total_price').each(function(){
			total_payment = ($(this).val()-0);
		})
		$('.total_payment').html("Total : "+ CURRENCY + total_payment.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
	}

	//remove product from cart

})



















