<div class="container">
	<?php echo Form::token(); ?>
	
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
			  <?php echo Form::hidden('action', 'create'); ?>
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
		standardAjaxSubmit({'action' : 'read'}, 'post', '/hr/cruds_job_analysis', responseCrudsJobAnalysisRead);
	})(jQuery);
		
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
					"<table class='table table-bordered table-striped'>"+
						"<thead>"+
						  "<tr>"+
							"<th class='col-sm-1'>Title</th>"+
							"<th class='col-sm-1'>Description</th>"+					
						  "</tr>"+
						"</thead>"+
						"<tbody>"+
						"</tbody>"+
					"</table>"+
				"</div>");
			
			
			$.each(response, function(key, value)
			{
				$('table').append('<tr><td>'+value.title+'</td><td>'+value.description+'</td></tr>');
			});
		}
	}
	
	function responseCrudsJobAnalysis(response) 
	{	
		// insert response
		if( response===true ) 
		{
			$('#myModal').modal('hide');
		} else {
			$.each(response,function(key, val){
				$('#'+key).css({'border-color' : 'red'});
				$(".error-message-"+key).html(val).css({'color' : 'red'});
			});
		}
		
		return false;
	}
	
   // Actions
	$('form#createJobAnalysyForm').on('submit', function(e)
	{
		$('.error').html("");
		$('input').css({'border-color' : '#F1F1F1'});
		var post_data 		= $('form#createJobAnalysyForm').serialize();		
		standardAjaxSubmit(post_data, 'post', '/hr/cruds_job_analysis', responseCrudsJobAnalysis);
		e.preventDefault();
		return false;
	});
			
</script>