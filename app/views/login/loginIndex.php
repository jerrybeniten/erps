<?php
	// Initialize country list
	foreach($countries as $key => $values)
	{
		$country_list[$values->country_iso_code ] = $values->country_name;
	}
	
	$token = csrf_token();
?>

<div class="container" style="margin-top:20px;">
  <div class="row">
      <div class="col-md-5">
          <div style="font-size:18px;" >ERPS Login</div>
          <hr/>
          <?php echo Form::open(array('action' => 'AuthenticateController@authenticate', 'role' => 'form')); ?>
            <div class="form-group">
              <?php echo Form::label('email_login', 'E-Mail Address'); ?>
              <?php echo Form::text('email_login', null, array('class' => 'form-control', 'placeholder' => 'Enter email')); ?>
            </div>
            <div class="form-group">
              <?php echo Form::label('password', 'Password'); ?>
              <?php echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
            </div>
            <div style="font-size:11px;">
				<input type="checkbox"> <span> Keep me logged in </span> | 
				<span style="font-size:11px;"><a href="#"> Forgot your password ? </a></span> 
			</div>
            <br />
            <?php echo Form::submit('Log in', array('class' => 'btn btn-primary') ); ?>
			 
			<!-- Modal Trigger : Sign up-->
			<?php echo Form::button('Sign up', 
					array(
						'class' 		=> 'btn btn-success', 
						'id' 			=> 'signnup', 
						'data-toggle' 	=> 'modal',
						'data-target' 	=> '#myModal'
					) 
				); 
			?>
            <br />
            <br />
          <?php echo Form::close(); ?>
      </div>    
      <div class="col-md-7">
          <div style="font-size:18px;">Keep in touch with employees and the organization around you on ERPS.</div>
          <hr/>
          <p>
            ERP provides an integrated view of core business processes, often in real-time, using common databases 
            maintained by a database management system. ERP systems track business resources—cash, raw materials, 
            production capacity—and the status of business commitments: orders, purchase orders, and payroll. 
            The applications that make up the system share data across the various departments (manufacturing, purchasing, sales, accounting, etc.) 
            that provide the data.
          </p>
          <p>
            Enterprise system software is a multi-billion dollar industry that produces components that support a variety of
            business functions. IT investments have become the largest category of capital expenditure in United States-based 
            businesses over the past decade. Though early ERP systems focused on large enterprises, smaller enterprises increasingly 
            use ERP systems.
          </p>
      </div>
  </div>
  
	<!-- Modal: Create New Job Analysis -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Sign Up - Setup your ERPS account</h4>
		  </div>
		  <?php echo Form::open(array('id' => 'createUsers', 'role' => 'form')); ?>
			  <?php echo Form::hidden('action', 'create'); ?>
			  <div class="modal-body">
					<div class="form-group">
					  <?php echo Form::label('email', 'Email'); ?>
					  <?php echo Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email')); ?>
					  <p class="error-message-email error"></p>
					</div>		
					<div class="form-group">
					  <?php echo Form::label('user_type', "I'am a..."); ?>
					  <?php echo Form::select('user_type', 
							array(
								''  => 'Select User Type', 
								'1' => 'Software Developer', 
								'2' => 'Company Owner', 							
								'3' => 'Manager',
								'4' => 'Employee'
							),
							'',
							array('class' => 'form-control')
						); ?>
					  <p class="error-message-user_type error"></p>
					</div>
					<div class="form-group">
					  <?php echo Form::label('country_name', "Country"); ?>
					  <?php echo Form::select('country_name', $country_list,
							$location->country,
							array('class' => 'form-control')
						); ?>
					  <p class="error-message-country_name error"></p>
					</div>
					<br />
					<br />				 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" value="Submit" />
			  </div>
		  <?php echo Form::close(); ?>
		</div>
	  </div>
	</div>
</div>
<script>
	// Callbacks
	function responseAddUsers( response )
	{	
		if( response===true ) 
		{
		
		} else {
			$.each(response,function(key, val){
				$('#'+key).css({'border-color' : 'red'});
				$(".error-message-"+key).html(val).css({'color' : 'red'});
			});
		}
		return false;
	}

	// Actions
	// ADD user
	$('form#createUsers').on('submit', function(e)
	{
		$('.error').html("");
		$('input').css({'border-color' : '#F1F1F1'});
		var post_data 		= $('form#createUsers').serialize();	
		standardAjaxSubmit(post_data, 'post', 'users/cruds_users', responseAddUsers);
		e.preventDefault();
	});
</script>