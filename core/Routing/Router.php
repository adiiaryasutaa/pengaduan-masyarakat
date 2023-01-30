<?php

namespace core\Routing;

use core\Application as App;
use Closure;
use Core\Http\Response;
use core\View\View;

class Router
{
	protected array $routes = [];

	protected array $currentRouteActionParams = [];

	public function __construct(array $routes = [])
	{
		$this->routes = $routes;
	}

	public function addRoute(string $method, string $uri, array |Closure $action): void
	{
		$this->routes[$method][$uri] = $action;
	}

	public function has(string $method, string $uri)
	{
		return isset($this->routes[$method][$uri]);
	}

	public function resolve()
	{
		$action = $this->getAction();

		if (!$action) {
			return "404 | Route Not Found";
		}

		if (is_array($action)) {
			$action = [new $action[0], $action[1]];
		}

		session()->input($_POST);
		$response = call_user_func($action, ...$this->currentRouteActionParams);

		if ($response instanceof View) {
			$response = new Response($response);
		}

		$response->send();
	}

	protected function getAction()
	{
		$request = App::getRequest();
		$method = $request->method();
		$uri = $request->uri();

		$this->resetCurrentRouteActionParams();

		if ($this->has($method, $uri)) {
			return $this->routes[$method][$uri];
		}

		// All routes from current request method
		$routes = $this->routes[$method];

		foreach ($routes as $route => $callback) {
			$route = trim($route, '/');
			$paramNames = [];

			// Find all route names from route
			if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
				$paramNames = $matches[1];
			}

			// Convert route name into regex pattern
			$routeRegex = "@^" . preg_replace_callback(
				'/\{\w+(:([^}]+))?}/',
				fn($match) => isset($match[2]) ? "({$match[2]})" : '(\w+)',
				$route
			) . "$@";

			// Test and match current route against $routeRegex
			if (preg_match_all($routeRegex, $uri, $valueMatches)) {
				$values = [];

				for ($i = 1; $i < count($valueMatches); $i++) {
					$values[] = $valueMatches[$i][0];
				}

				array_push($this->currentRouteActionParams, ...array_combine($paramNames, $values));

				return $callback;
			}
		}

		return false;
	}

	protected function getRequestFromApp()
	{
		return App::getInstance()->getRequest();
	}

	protected function resetCurrentRouteActionParams()
	{
		$this->currentRouteActionParams = [];
	}
}