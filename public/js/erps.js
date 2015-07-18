// standard ajax submit

var xhr = null;

function standardAjaxSubmit(post_data, method, url, callback_name) 
{
	// prevent any duplicate submission
	if( xhr != null ) {
        xhr.abort();
        xhr = null;
    }

    xhr = $.ajax(
	{
		type    : method,
		url     : url,
		data    : post_data,
		cache   : false,
		success : function (data) 
		{
			callback_name(data);
		}
	}); 
}

// make the first character upper case
function uCfirst(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

// no stop
function standardAjaxSubmit_2(post_data, method, url, callback_name) 
{
    $.ajax(
	{
		type    : method,
		url     : url,
		data    : post_data,
		cache   : false,
		success : function (data) 
		{
			callback_name(data);
		}
	}); 
}

