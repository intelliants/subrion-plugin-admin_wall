<?php
//##copyright##

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