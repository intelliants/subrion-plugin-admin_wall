<?php
/******************************************************************************
 *
 * Subrion - open source content management system
 * Copyright (C) 2016 Intelliants, LLC <http://www.intelliants.com>
 *
 * This file is part of Subrion.
 *
 * Subrion is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Subrion is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Subrion. If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * @link http://www.subrion.org/
 *
 ******************************************************************************/

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