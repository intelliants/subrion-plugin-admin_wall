<?php
//##copyright##

if (iaView::REQUEST_JSON == $iaView->getRequestType())
{
	$error = false;
	$messages = array();
	$output = array();

	$iaCore->factory('util');

	$post = array(
		'body' => iaUtil::checkPostParam('body'),
		'member_id' => (int)iaUsers::getIdentity()->id,
		'date' => date(iaDb::DATETIME_FORMAT)
	);

	iaUtil::loadUTF8Functions('ascii', 'validation', 'bad');

	if (!utf8_is_valid($post['body']))
	{
		$post['body'] = utf8_bad_replace($post['body']);
	}

	$len = utf8_is_ascii($post['body']) ? strlen($post['body']) : utf8_strlen($post['body']);

	if (empty($post['body']))
	{
		$error = true;
		$messages[] = iaLanguage::get('error_empty_post');
	}
	else
	{
		$post['body'] = preg_replace('#(^|\s|\n)http(s)?\:\/\/([^\s^\n^\<^\>]+)(\s|\n|\<|\>|$)#i', '$1<a href="http$2://$3" target="_blank">http$2://$3</a>$4', $post['body']);
	}

	if (!$error)
	{
		$id = $iaDb->insert($post, null, 'admin_wall');

		if ($id)
		{
			$messages[] = iaLanguage::get('post_added');

			$output['html'] = iaSanitize::html($post['body']);
			$output['member'] = $iaDb->one('fullname', iaDb::convertIds($post['member_id']), iaUsers::getTable());
			$output['date'] = "Just now";
		}
		else
		{
			$error = true;
			$messages[] = iaLanguage::get('db_error');
		}
	}

	$output['error'] = $error;
	$output['messages'] = $messages;

	$iaView->assign($output);
}

if (iaView::REQUEST_HTML == $iaView->getRequestType())
{
	return iaView::errorPage(iaView::ERROR_NOT_FOUND);
}