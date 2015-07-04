<div class="container">

	<?php $token = csrf_token(); ?>
	
	<!-- Modal Trigger : Create New Job Analysis-->
	<div class="modal-zero">
		<a href="#" data-toggle="modal" data-target="#myModal"><span class="label label-default">No Job Analysis Yet! Click this message to create one!</span></a>
	</div>
	
	<!-- Job Analysis Table -->
	<div class="ja-table">
	</div>
	
	<!-- Modal: Create New Job Analysis -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Create New Job Analysis</h4>
		  </div>
		  <?php echo Form::open(array('id' => 'createJobAnalysyForm', 'role' => 'form')); ?>
			  <?php echo Form::hidden('action', 'create', array('id' => 'action')); ?>
			  <?php echo Form::hidden('hash', '', array('id' => 'hash')); ?>
			  <div class="modal-body">
					<div class="form-group">
					  <?php echo Form::label('title', 'Job Title'); ?>
					  <?php echo Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Job Title')); ?>
					  <p class="error-message-title error"></p>
					</div>
					<div class="form-group">
					  <?php echo Form::label('description', 'Description'); ?>
					  <?php echo Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Description')); ?>
					  <p class="error-message-description error"></p>
					</div>		
					<div class="form-group">
					  <?php echo Form::label('status', 'Status'); ?>
					  <?php echo Form::select('status', 
							array(
								'1' => 'New', 
								'2' => 'Discussion', 
								'3' => 'Job Description', 
								'4' => 'Person Specification',
								'5' => 'Job Advertisement'
							),
							'',
							array('class' => 'form-control', 'placeholder' => 'Description')
						); ?>
					  <p class="error-message-status error"></p>
					</div>

			
					<br />
					<br />				 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" value="Save" />
			  </div>
				<?php echo Form::close(); ?>
			</div>
		</div>
	</div>
</div>

<script>
		
	(function($){
		standardAjaxSubmit({'action' : 'read', '_token' : "<?php echo $token; ?>"}, 'post', '/hr/cruds_job_analysis', responseCrudsJobAnalysisRead);
	})(jQuery);
	
	function cleanHash(hash)
	{
		var result = hash.replace(/[^\w\s]/gi, '');
		return result;
	}
	
	// Callbacks
	function responseCrudsJobAnalysisRead(response)
	{
		// check the array length if greater 0
		var arr_length = response.length;
		if( arr_length > 0 ) 
		{	
			// reset html element
			$('.modal-zero').hide();
			$('.ja-table').html('');
			$('.ja-table').html(""+
				"<div class='container' style='width:70%'>"+
				"<div style='cursor:pointer' data-toggle='modal' data-target='#myModal' class='ja-add'><span><i class='glyphicon glyphicon-plus' style='color:green'></i></span><span> Add Job Analysis</span></div><br/>"+
					"<table class='table table-bordered table-striped'>"+
						"<thead>"+
						  "<tr>"+
							"<th class='col-sm-1'>Title</th>"+
							"<th class='col-sm-1'>Description</th>"+
							"<th class='col-sm-1'>Status</th>"+						
							"<th class='col-sm-1'>Actions</th>"+	
						  "</tr>"+
						"</thead>"+
						"<tbody>"+
						"</tbody>"+
					"</table>"+
				"</div>");		
			$.each(response, function(key, value)
			{
				$('table').append('<tr><td class="title_'+cleanHash(value.hash)+'">'+value.ja_title+'</td><td  class="description_'+cleanHash(value.hash)+'">'+value.description+'</td><td  class="status_'+cleanHash(value.hash)+'">'+uCfirst(value.s_title)+'</td>'+
				'<td>'+
				'<div data-toggle="modal" data-target="#myModal" id="'+value.hash+'" class="ja-edit glyphicon glyphicon-edit" style="color:green;cursor:pointer" title="Edit"> </div> &nbsp;'+
				'<div class="glyphicon glyphicon-trash" style="color:red;cursor:pointer"  title="Delete"> </div>'+
				'</td>'+
				'</tr>');
			});
		}
	}
	
	function responseCrudsJobAnalysis(response) 
	{	
		var ja_title 	= $('#title').val();
		var description = $('#description').val();
		var s_title  	= $('#status').val();
			
			switch(s_title) 
			{
				case '1' : s_title = 'New';
				break;
				
				case '2' : s_title = 'Discussion';
				break;
				
				case '3' : s_title = 'Description Creation';
				break;
				
				case '4' : s_title = 'Person Specification';
				break;
				
				case '5' : s_title = 'Job Advertistment';
				break;
			}
		
		if( response===true ) 
		{
			$('#myModal').modal('hide');
		    
			// Update
			var hash = $('#hash').val();
				
			$(".title_"+cleanHash(hash)).html(ja_title);
			$(".description_"+cleanHash(hash)).html(description);
			$(".status_"+cleanHash(hash)).html(s_title);
			
		} else {

			var final_response = response.split(':');
			if (final_response[0]==="create"){
				
				$('#myModal').modal('hide');
				$('#hash').val(final_response[1]);
				$('#action').val('create');
				
				$('table').prepend('<tr><td class="title_'+cleanHash(final_response[1])+'">'+ja_title+'</td><td class="description_'+cleanHash(final_response[1])+'">'+description+'</td><td class="status_'+cleanHash(final_response[1])+'">'+s_title+'</td>'+
					'<td>'+
						'<span  id="'+final_response[1]+'" class="glyphicon glyphicon-edit ja-edit" style="color:green;cursor:pointer" data-target="#myModal" data-toggle="modal" title="Edit"> </span> &nbsp;'+
						'<span  class="glyphicon glyphicon-trash" style="color:red;cursor:pointer"  title="Delete"> </span>'+
						'<span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>'+	
					'</td>'+
					'</tr>');
				$('form#createJobAnalysyForm')[0].reset();
				
			} else {
				$.each(response,function(key, val){
					$('#'+key).css({'border-color' : 'red'});
					$(".error-message-"+key).html(val).css({'color' : 'red'});
				});
			}
		}
		
		return false;
	}
	
	function responseCrudsJobAnalysisGedit(response)
	{
		var title 		= response[0].title;
		var description = response[0].description;
		var status 		= response[0].status;
		var hash 		= response[0].hash;
		
		$('#title').val(title);
		$('#description').val(description);
		$('#status').val(status);
		$('#hash').val(hash);

		return false;
	}
	
	// Actions
	// ADD will serve as EDIT as well
	$('form#createJobAnalysyForm').on('submit', function(e)
	{
		$('.error').html("");
		$('input').css({'border-color' : '#F1F1F1'});
		var post_data 		= $('form#createJobAnalysyForm').serialize();		
		standardAjaxSubmit(post_data, 'post', '/hr/cruds_job_analysis', responseCrudsJobAnalysis);
		e.preventDefault();
		return false;
	});
	
	//Trigger for the modal
	$("div").on('click', '.ja-add', function()
	{
		$("#myModalLabel").html("Create New Job Analysis");
		$('#hash').val(""); // reset hidden hash	
		$('form#createJobAnalysyForm')[0].reset(); // reset the form
	});
	
	// EDIT
	// Trigger for the modal and load the single data
	$('div').on('click', '.ja-edit', function(e)
	{
		var ja_id = this.id;
		standardAjaxSubmit({'action' : 'gedit', '_token' : "<?php echo $token; ?>", 'ja_id' : ja_id}, 'post', '/hr/cruds_job_analysis', responseCrudsJobAnalysisGedit);
		$("#myModalLabel").html("Update Job Analysis");
	});
			
</script>