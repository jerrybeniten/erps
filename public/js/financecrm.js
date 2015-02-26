$(document).ready(function() {

    forms();
   ajax_search();
});

// ajaxify any live search ( contact search )

function ajax_search() {

	$("input#search_contact").on("keyup", function(e) {

	    // Set Search String
	    var search_string = $(this).val();

	    // Do Search
	    if(search_string !== '') {
	        $.ajax({
	            type: "POST",
	            url: "contactSearch",
	            data: { query: search_string },
	            cache: false,
	            success: function( data ) {

	               // Reset
				   $("div#search_result").html('').hide();
	               $.each( data, function( key, value ) {
						
						$("div#search_result").show().append( '<div class="getContact" id='+value.contact_id+'> &nbsp; '+value.title+' '+value.first_name+' '+value.last_name+', '+value.email+', '+value.phone+'</div>');
				   });
	            }
	        });
	    }
	    return false;
	});

	$("div").on('click', '.getContact', function() {
		$("input#search_contact").val( $("#"+this.id).text().trim() );
		$("div#search_result").hide();
		$("input#contact_id").val( this.id );
		return false;
	});

	return false;
}

function forms() {

    $("#addnote").click(function() {
        $("#addnoteform").toggle();
    });
    $("#addcall").click(function() {
        $("#addcallform").toggle();
    });
    $("#addpayinfo").click(function() {
        $("#updatePaymentInfoForm").toggle();
    });
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
    });

    $(".payment_button").click(function() {

        var contract_id = this.id;
        $("#addPayments" + contract_id).toggle();

        return false;
    });

    $(".debit_button").click(function() {

        var contract_id = this.id;
        var new_contract_id = contract_id.split('_');
        $("#addDebit" + new_contract_id[1]).toggle();
        return false;
    });

    $("#scheduled_date").datepicker();
	$( "#date_of_first_payment" ).datepicker();
    $("#actual_date").datepicker();
    $("#expiration_date").datepicker();
    $("#registration_date").datepicker();
    $("#purchase_date").datepicker();
    $("#return_date").datepicker();
    $("#rego_due_date").datepicker();
    $("#start_date").datepicker();
    $("#end_date").datepicker();
    $("#plan_start_date").datepicker();
}
