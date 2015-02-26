// standard ajax submit
function standardAjaxSubmit(post_data, method, url, callback_name) {

	$.ajax({
		type    : method,
		url     : url,
		data    : post_data,
		cache   : false,
		success : function (data) {
			callback_name(data);
		}
	}); 
}

