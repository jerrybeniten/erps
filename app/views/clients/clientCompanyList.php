<div class="container">

	<?php $token = csrf_token(); ?>
	
	<!-- Initialize Data -->
	<?php 
		// States
		$state[''] = 'Please Select a State';
		foreach( $state_list as $values ){
			$state[$values->id] = $values->state_name.' ('.$values->state_code.')';
		}
		
		// Countries
		$country[''] = 'Please Select a Country';
		foreach( $country_list as $values_c ){
			$country[$values_c->geoname_id] = $values_c->country_name.' ('.$values_c->country_iso_code.')';
		}
	?>
	
	<!-- Modal Trigger : Create New Company -->
	<div class="container" style='width:70%'>
		<div class="modal-zero">
			<a href="#" data-toggle="modal" data-target="#myModal"><span class="label label-default">
				No Companies Yet! Click this message to create one!</span></a>
		</div>
	</div>
	
	<!--Company Table -->
	<div class="co-table">
	</div>
	
	<!-- Modal: Create New Company -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Create New Company</h4>
		  </div>
		  <?php echo Form::open(array('id' => 'createNewCompanyForm', 'role' => 'form')); ?>
			  <?php echo Form::hidden('action', 'create', array('id' => 'action')); ?>
			  <?php echo Form::hidden('hash', '', array('id' => 'hash')); ?>
			  <div class="modal-body">
					
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <?php echo Form::label('company_name', 'Company Name'); ?>
								  <?php echo Form::text('company_name', null, array('class' => 'form-control', 'placeholder' => 'Company Name')); ?>
								  <p class="error-message-company_name error"></p>
								</div>
								<div class="form-group">
								  <?php echo Form::label('street_number', 'Street Number'); ?>
								  <?php echo Form::text('street_number', null, array('class' => 'form-control', 'placeholder' => 'Street Number')); ?>
								  <p class="error-message-street_number error"></p>
								</div>
								<div class="form-group">
								  <?php echo Form::label('street', 'Street'); ?>
								  <?php echo Form::text('street', null, array('class' => 'form-control', 'placeholder' => 'Street')); ?>
								  <p class="error-message-street error"></p>
								</div>
								<div class="form-group">
								  <?php echo Form::label('city', 'City'); ?>
								  <?php echo Form::text('city', null, array('class' => 'form-control', 'placeholder' => 'City')); ?>
								  <p class="error-message-city error"></p>
								</div>					
								<div class="form-group">
								  <?php echo Form::label('state_id', 'State'); ?>
								  <?php echo Form::select('state_id', 
										$state,
										null,
										array('class' => 'form-control', 'placeholder' => 'State')
									); ?>
								  <p class="error-message-state error"></p>
								</div>		
								<div class="form-group">
								  <?php echo Form::label('postcode', 'Postcode'); ?>
								  <?php echo Form::text('postcode', null, array('class' => 'form-control', 'placeholder' => 'Postcode')); ?>
								  <p class="error-message-postcode error"></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <?php echo Form::label('country_id', 'Country'); ?>
								  <?php echo Form::select('country_id', 
										$country,
										null,
										array('class' => 'form-control', 'placeholder' => 'Country')
									); ?>
								  <p class="error-message-country_id error"></p>
								</div>
								<div class="form-group">
								  <?php echo Form::label('mobile', 'Mobile'); ?>
								  <?php echo Form::text('mobile', null, array('class' => 'form-control', 'placeholder' => 'Mobile')); ?>
								  <p class="error-message-mobile error"></p>
								</div>
								<div class="form-group">
								  <?php echo Form::label('phone', 'Phone'); ?>
								  <?php echo Form::text('phone', null, array('class' => 'form-control', 'placeholder' => 'Phone')); ?>
								  <p class="error-message-phone error"></p>
								</div>
							</div>
						</div>
				
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
	
	function responseCrudsCompanies(response)
	{
		return false;
	}

	// Actions
	// ADD will serve as EDIT as well
	$('form#createNewCompanyForm').on('submit', function(e)
	{
		$('.error').html("");
		$('input').css({'border-color' : '#F1F1F1'});
		var post_data 		= $('form#createNewCompanyForm').serialize();		
		standardAjaxSubmit(post_data, 'post', '/clients/cruds_companies', responseCrudsCompanies);
		e.preventDefault();
		return false;
	});

</script>
