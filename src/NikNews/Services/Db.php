<?php

namespace NikNews\Services;

use NikNews\Models\News\News;
use NikNews\Exceptions\DbException;

class Db
{
	private static $instaceCount = 0;

	private static $instanse;

	private $pdo;

	private function __construct()
	{
		self:$instaceCount++;

		$dbOptions = (require __DIR__ . '/../../settings.php')['db'];

		try{
			$this->pdo = new \PDO (
				'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'], 
				$dbOptions['user'],
				$dbOptions['password']
			);

			$this->pdo->exec('SET NAMES UTF8');
		} catch (\PDOException $e) {
        throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
    }
	}


	public function query(string $sql, $params = [], string $className = 'stdClass'): ?array
	{
		$sth = $this->pdo->prepare($sql);
		$result = $sth->execute($params);

		if (false === $result) {
			return null;
		}

		return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
	}

	public static function getInstance(): self
	{
		if (self::$instanse === null) {
			self::$instanse = new self();
		}

		return self::$instanse;
	}

	public function getLastInsertId(): int 
    {
        return (int) $this->pdo->lastInsertId();
    }
}