<?php

namespace Core\Database;

use PDO;

class Connection extends PDO
{
	protected string $host = 'localhost:3310';
	protected string $database = 'pengaduan_masyarakat';
	protected string $user = 'root';
	protected string $password = 'fr33pass';

	public function __construct()
	{
		parent::__construct("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password);

		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}