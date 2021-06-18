<?php

namespace NikNews\Models\News;

use NikNews\Services\Db;
use NikNews\Models\ActiveRecordEntity;

abstract class NewsEntity extends ActiveRecordEntity {

	public static function getById(int $id): ?self // Запрос новости из бд(для админа)
	{
		$db = Db::getInstance();
		$entities = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',[':id' => $id], static::class);
		return $entities ? $entities[0] : null;
	}

	public static function getByIdGuest(int $id): ?self // Запрос новости из бд(для гостя) + фиксация просмотра
	{
		$db = Db::getInstance();
		$db->query('UPDATE ' . static::getTableName() . ' SET views_count = views_count + 1 WHERE id =' . ' ' . $id, [], static::class);
		$entities = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;', [':id' => $id], static::class);
		return $entities ? $entities[0] : null;
	}
}