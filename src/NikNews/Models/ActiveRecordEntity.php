<?php

namespace NikNews\Models;

use NikNews\Services\Db;

abstract class ActiveRecordEntity//класс с универсальными функциями
{
	protected $id;

	public function getId(): int
	{
		return $this->id;
	}

	public function __set(string $name, $value)
	{
		$camelCaseName = $this->underscoreToCamelCase($name);
		$this->$camelCaseName = $value;
	}

	private function underscoreToCamelCase(string $source): string //универсальная функция для приведения текста из стиля Underscore в CamelCase
	{
		return lcfirst(str_replace('_', '', ucwords($source, '_')));
	}

	abstract protected static function getTableName(): string; 

	private function mapPropertiesToDbFormat(): array //универсальная функция для приведения текста под DB
	{
		$reflector = new \ReflectionObject($this);
		$properties = $reflector->getProperties();

		$mappedProperties = [];
		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
			$mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
		}

		return $mappedProperties;
	}

	private function camelCaseToUnderscore(string $source): string //универсальная функция для приведения текста из стиля CamelCase в Underscore
	{
		return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
	}

	public function save(): void // проверка на наличие данных в масиве, если не пусто то вызвать функцию для обновления DB, если пусто вызвать функцию для добавления новой звписи
	{
		$mappedProperties = $this->mapPropertiesToDbFormat();
		if ($this->id !== null) {
			$this->update($mappedProperties);
		} else {
			$this->insert($mappedProperties);
		}
	}

	public static function findAll($first, $sort, $role): array//получение всех новостей(для гостевой панели только не опубликованные)
	{
		$sorting = '';
		if ($sort == 'sortNew') {
			$sorting = 'create_at DESC';
		} elseif ($sort == 'sortOld') {
			$sorting = 'create_at';
		} elseif ($sort == 'sortPopular') {
			$sorting = 'views_count DESC';
		} elseif ($sort == 'sortNotPopular') {
			$sorting = 'views_count';
		}
		$db = Db::getInstance();
		if ($role == 'guest') {
			$roleFilter = ' WHERE status = 1';
		} elseif ($role == 'admin') {
			$roleFilter = '';
		}
		$list = $db->query('SELECT * FROM `' . static::getTableName() . '`' . $roleFilter .' ORDER BY ' . $sorting . ' LIMIT '. $first . ', 10;', [], static::class);
		$countNotes = ceil(count($db->query('SELECT * FROM `' . static::getTableName() . '`' . $roleFilter .' ;', [], static::class)) / 10);
		return array($list, $countNotes);
	}

	private function update(array $mappedProperties): void// Функция для обновления записи в DB
	{
		$columns2params = [];
    $params2values = [];
    $index = 1;
    foreach ($mappedProperties as $column => $value) {
    	$param = ':param' . $index;
    	$columns2params[] = $column . ' = ' . $param;
    	$params2values[$param] = $value;
    	$index++;
    }
    $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
    $db =  Db::getInstance();
    $db->query($sql, $params2values, static::class);
  }

  private function insert(array $mappedProperties): void // Функция для обавления новой записи в DB
  {
  	$filteredProperties = array_filter($mappedProperties);

  	$columns = [];
  	$paramsNames = [];
  	$params2values = [];
  	foreach ($filteredProperties as $columnName => $value) {
  		$columns[] = '`' . $columnName. '`';
  		$paramName = ':' . $columnName;
  		$paramsNames[] = $paramName;
  		$params2values[$paramName] = $value;
  	}

  	$columnsViaSemicolon = implode(', ', $columns);
  	$paramsNamesViaSemicolon = implode(', ', $paramsNames);

  	$sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';
  	$db = Db::getInstance();
  	$db->query($sql, $params2values, static::class);
  	$this->id = $db->getLastInsertId();
  }

  public static function delete(int $id) // Функция для удаления записи
  {
  	$array = ["a" => "1", "b" => "2"];// Масив - костыль, query - универсальная функция для передачи любого количества данных, для передачи требуется масив
  	$db = Db::getInstance();
  	$sql = 'DELETE FROM ' . static::getTableName() . ' WHERE id = ' . $id . ';';
		$db->query($sql, $array, static::class);	
  }

  public static function publish(int $id) //Функция для публикования для админов
  {
  	$array = ["a" => "1", "b" => "2"];
  	$db = Db::getInstance();
  	$sql = 'UPDATE ' . static::getTableName() . ' SET status = 1 WHERE id = ' . $id . ';';
		$db->query($sql, $array, static::class);	
  }
}