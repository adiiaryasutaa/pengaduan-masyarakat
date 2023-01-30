<?php

namespace Core\Http;

use Core\Application as App;

class RedirectResponse extends Response
{
	protected string $targetUrl;

	public function __construct(string $url, int $status = 302)
	{
		parent::__construct('', $status);
		$this->setTargetUrl($url);
	}

	public function setTargetUrl(string $url)
	{
		$this->targetUrl = $url;

		$this->setContent(
			"
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset=\"UTF-8\" />
					<meta http-equiv=\"refresh\" content=\"0;url='{$this->targetUrl}'\" />
					<title>Redirecting to {$this->targetUrl}</title>
				</head>
				<body>
					Redirecting to <a href=\"{$this->targetUrl}\">{$this->targetUrl}</a>.
				</body>
			</html>
			"
		);
	}

	public function with(string|array $key, $value = null)
	{
		session()->flash($key, $value);

		return $this;
	}

	public function error(string|array $key, $value = null)
	{
		session()->error($key, $value);

		return $this;
	}
}