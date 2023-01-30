<?php

namespace Core;

use Core\Auth\Auth;
use Core\Database\Connection;
use core\Http\Request;
use core\Routing\Router;
use Core\Session\SessionManager;

class Application
{
	protected static string $basePath;
	protected static Application $app;
	protected static Router $router;
	protected static Request $request;
	protected static Connection $connection;
	protected static SessionManager $sessionManager;
	protected static Auth $auth;

	public function __construct(array $options)
	{
		self::$basePath = $options['paths']['base'] ?? '/';
		self::$app = $this;

		self::$router = new Router();
		self::$request = new Request();
		self::$connection = new Connection();
		self::$sessionManager = new SessionManager();
		self::$auth = new Auth();

		$this->registerRoutes($options['paths']['route']);
	}

	protected function registerRoutes(string $path)
	{
		require_once($path);
	}

	public function start()
	{
		echo self::$router->resolve();
	}

	public static function getBasePath()
	{
		return self::$basePath;
	}

	public static function getInstance()
	{
		return self::$app;
	}

	public static function getRouter()
	{
		return self::$router;
	}

	public static function getRequest()
	{
		return self::$request;
	}

	public static function getConnection()
	{
		return self::$connection;
	}

	public static function getSessionManager()
	{
		return self::$sessionManager;
	}

	public static function getAuth()
	{
		return self::$auth;
	}
}