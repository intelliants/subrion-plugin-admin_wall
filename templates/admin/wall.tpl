<div class="widget widget-large" id="widget-wall">
	<div class="widget-header"><i class="i-pen"></i> {lang key='admin_wall'}
		<ul class="nav nav-pills pull-right">
			<li><a href="#" class="widget-toggle"><i class="i-chevron-up"></i></a></li>
		</ul>
	</div>
	<form class="ia-form clearfix js-wall-post-form" style="margin-bottom: 10px; border-bottom: 1px solid #eee; padding: 10px;">
		<div class="row">
			<div class="col-lg-11" style="padding-right: 10px;">
				<textarea name="body" rows="2" cols="62" class="form-control js-wall-post-body" style="resize: none;"></textarea>
			</div>
			<div class="col-lg-1" style="padding-left: 0;">
				<button id="js-admin-wall-post-submit" class="btn btn-primary btn-block" title="{lang key='sumbit_post'}" style="padding: 16px 0;"><i class="i-checkmark"></i></button>
			</div>
		</div>
	</form>
	<div class="widget-content">
		<div class="widget-activity">
			<div id="js-wall-posts-placeholder">
				{foreach $wallposts as $wallpost}
					<div class="widget-activity-item status-added">
						<div class="icon">
							<i class="i-bubble"></i>
						</div>
						<div class="date">{$wallpost.date|date_format:$core.config.date_format}</div>
						<p>{$wallpost.body|escape:'html'} <br><i class="text-muted">{lang key='by'} {$wallpost.member}</i></p>
					</div>
				{/foreach}
			</div>
		</div>
	</div>
</div>
{ia_add_media files='js:_IA_URL_plugins/admin_wall/js/admin/index'}