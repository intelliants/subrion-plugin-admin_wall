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

class iaWallpost extends abstractPlugin
{
	protected static $_table = 'admin_wall';


	public function get()
	{
		$sql =
			"SELECT p . * , m.`fullname` `member` "
			. "FROM  `:prefix:table_posts` p "
			. "LEFT JOIN  `:prefix:table_members` m ON ( m.`id` = p.`member_id`) "
			. "ORDER BY `date` DESC";
		$sql = iaDb::printf($sql, array(
			'prefix' => $this->iaDb->prefix,
			'table_posts' => self::getTable(),
			'table_members' => iaUsers::getTable()
		));

		return $this->iaDb->getAll($sql);
	}
}