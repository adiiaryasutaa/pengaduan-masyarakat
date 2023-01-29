<?php

namespace core\View;

class View
{
	protected array $data = [];

	protected array $nests = [];

	protected string $content;

	public function __construct(string $content, array $data = [], array $nests = [])
	{
		$this->data = $data;
		$this->nests = $nests;
		$this->content = $this->getContent($content);
	}

	public function nest(string $replace, string|View $view)
	{
		$this->nests[$replace] = $view instanceof View ? $view : new self($view);

		return $this;
	}

	protected function getContent($content): bool|string
	{
		foreach ($this->data as $key => $value) {
			$$key = $value;
		}

		if (file_exists($path = fromBasePath("app\\views\\{$content}.php"))) {
			ob_start();
			include_once($path);
			return ob_get_clean();
		}

		return $content;
	}

	public function build()
	{
		foreach ($this->nests as $replace => $nest) {
			$this->content = str_replace($replace, $nest, $this->content);
		}
	}

	public function __toString()
	{
		$this->build();
		return $this->content;
	}
}