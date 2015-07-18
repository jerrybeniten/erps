<style media="screen" type="text/css">
    a.decoration-none{
		text-decoration:none;
	}
</style>

<span> &nbsp; &nbsp;
	<a class="decoration-none" href="<?php echo URL::to('/hr/job_analysis'); ?>">Job Analysis <span class="badge ja-count">0</span> </a>
	<a class="decoration-none" href="#">&nbsp; &nbsp; Recruitment and Selection <span class="badge">0</span> </a>
	<a class="decoration-none" href="#">&nbsp; &nbsp; Employees <span class="badge">0</span> </a>
</span>

<?php $token = csrf_token(); ?>

<script>

	function responseCounterRead( response )
	{
		$.each(response, function(key, value)
		{
			$('.ja-count').text( value.counter );
		});
		return false;
	}

	standardAjaxSubmit_2({'action' : 'read', '_token' : "<?php echo $token; ?>"}, 'post', '/hr/counter', responseCounterRead);
	
</script>