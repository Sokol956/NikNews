<?php

namespace NikNews\Models\Reviews;

use NikNews\Services\Db;
use NikNews\Models\ActiveRecordEntity;

abstract class ReviewsEntity extends ActiveRecordEntity {

	public static function getById(int $id): ?self //запрос на получение записи из бд по id
	{
		$db = Db::getInstance();
		$list = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;', [':id' => $id], static::class);
		return $list ? $list[0] : null;
	}
}