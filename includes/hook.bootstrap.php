<?php
//##copyright##

if (iaView::REQUEST_HTML == $iaView->getRequestType())
{
	$iaWallpost = $iaCore->factoryPlugin('admin_wall', iaCore::ADMIN, 'wallpost');

	$iaView->assign('wallposts', $iaWallpost->get());
}