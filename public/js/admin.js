 /**
 * Получение данных с формы
 * 
 */
function getData(obj_form){
		  var hData = {};
		  $('input, textarea, select',  obj_form).each(function(){
			   if(this.name && this.name!=''){
					hData[this.name] = this.value;
					console.log('hData[' + this.name + '] = ' + hData[this.name]);
			   }
		  });
		  return hData;
};


function newCategory(){
	var postData = getData('#blockNewCategory');

	$.ajax({
		type: 'POST',
		async: false,
		url: "/admin/addnewcategory/",
		data: postData,
		dataType: 'json',
		success: function(data){
			if (data['success']) {
				alert(data['message']);
				$('#newCategoryName').val('');
			}else{
				alert(data['message']);
			}
		}
	});
};

/**
* Обновление данных категории
**/
function updateCat(item_id){
	var parent_id = $('#parentId_'+ item_id).val();
	var new_name = $('#itemName_'+ item_id).val();
	var postData = {item_id: item_id, parent_id: parent_id, new_name: new_name};

	$.ajax({
		type: 'POST',
		async: false,
		url: "/admin/updatecategory/",
		data: postData,
		dataType: 'json',
		success: function(data){
			alert(data['message']);
		}
	});
}
/**
* Добавление нового пролукта
**/
function addProduct(){
	var itemName = $('#newItemName').val();
	var itemPrice = $('#newItemPrice').val();
	var itemDesc = $('#newItemDesc').val();
	var itemCat = $('#newItemCatId').val();

	var postData = {itemName: itemName, itemPrice: itemPrice, itemDesc: itemDesc, itemCat: itemCat};

	$.ajax({
		type: 'POST',
		async: false,
		url: "/admin/addproduct/",
		data: postData,
		dataType: 'json',
		success: function(data){
			alert(data['message']);
			if (data['success']) {
				$('#newItemName').val('');
				$('#newItemPrice').val('');
				$('#newItemDesc').val('');
				$('#newItemCatId').val('');
			}
		}
	});
}
/**
* Обновление данных продукта
**/
function updateProduct(item_id){
	var itemName = $('#itemName_' + item_id).val();
	var itemPrice = $('#itemPrice_' + item_id).val();
	var itemCat = $('#itemCatId_' + item_id).val();
	var itemDesc = $('#itemDesc_' + item_id).val();
	var itemStatus = $('#itemStatus_' + item_id).attr('checked');
	if (! itemStatus) {
		itemStatus = 1
	}else{
		itemStatus = 0
	}
	var postData = {itemName: itemName, itemPrice: itemPrice, itemDesc: itemDesc,
					itemId: item_id, itemCat: itemCat, itemStatus: itemStatus};

	$.ajax({
		type: 'POST',
		async: false,
		url: "/admin/updateproduct/",
		data: postData,
		dataType: 'json',
		success: function(data){
			alert(data['message']);
		}
	});
}
/**
 * Показывать или прятать данные о заказе
 * 
 */
function showProducts(id){
	var objName = "#purchasesForOrderId_" + id;
	if( $(objName).attr('class') != 'show' ) {
		$(objName).attr('class', 'show');
	} else {
		$(objName).attr('class', 'hide');
	}
}
function updateOrderStatus(item_id){
	var status = $('#itemStatus_' + item_id).attr('checked');
	if (! status) {
		status = 0
	}else{
		status = 1
	}
	var postData = {itemId: item_id, status: status};

	$.ajax({
		type: 'POST',
		async: false,
		url: "/admin/setorderstatus/",
		data: postData,
		dataType: 'json',
		success: function(data){
			if (!data['success']) {
				alert(data['message']);
			}
		}
	});
}

function updateOrderDatePayment(item_id){
	var datePayment = $('#datePayment_' + item_id).val();
	var postData = {itemId: item_id, datePayment: datePayment};

	$.ajax({
		type: 'POST',
		async: false,
		url: "/admin/setorderdatepayment/",
		data: postData,
		dataType: 'json',
		success: function(data){
			if (!data['success']) {
				alert(data['message']);
			}
		}
	});
}