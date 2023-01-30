<?php

namespace App\Model;

use Core\Application as App;
use Core\Database\Model;
use PDO;

class Laporan extends Model
{
	public string $title;
	public string $content;
	public string $date;
	public string $location;

	public static function store(array $data)
	{
		$connection = App::getConnection();

		$preparedStatement = $connection->prepare("INSERT INTO laporan (user_id, title, content, date, location) VALUES (:user_id, :title, :content, :date, :location)");

		$preparedStatement->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
		$preparedStatement->bindValue(':title', $data['title']);
		$preparedStatement->bindValue(':content', $data['content']);
		$preparedStatement->bindValue(':date', $data['date']);
		$preparedStatement->bindValue(':location', $data['location']);

		return $preparedStatement->execute();
	}
}