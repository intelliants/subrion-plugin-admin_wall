$(function()
{
	$('#js-admin-wall-post-submit').on('click', function(e)
	{
		e.preventDefault();

		var params = {
			url: intelli.config.admin_url + '/wall.json',
			type: 'post',
			data: $(this).closest('.js-wall-post-form').serialize()
		};

		$.ajax(params).done(function(response)
		{
			intelli.notifFloatBox({msg: response.messages, autohide: true, type: response.error ? 'error' : 'success'});
			if (typeof response.html != 'undefined' && !response.error)
			{
				$('<div class="widget-activity-item status-added">' + 
					'<div class="icon"><i class="i-bubble"></i></div>' + 
					'<div class="date">' + response.date + '</div>' +
					'<p>' + response.html + ' <br><i class="text-muted">' + _t('by') + ' ' + response.member + '</i></p>' + 
				  '</div>')
				  .prependTo('#js-wall-posts-placeholder').fadeIn(800);
			}
		});
	});
});