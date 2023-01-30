<?php

namespace core\View;

class View
{
	protected array $data = [];

	protected array $nests = [];

	protected string $original;

	public function __construct(string $content, array $data = [], array $nests = [])
	{
		$this->data = $data;
		$this->nests = $nests;
		$this->original = $content;
	}

	public function nest(string $replace, string|View $view)
	{
		$this->nests[$replace] = $view instanceof View ? $view : new self($view);

		return $this;
	}

	public function render(): bool|string
	{
		$content = '';

		if (file_exists($path = fromBasePath("app\\views\\{$this->original}.php"))) {
			foreach ($this->data as $key => $value) {
				$$key = $value;
			}

			ob_start();
			include_once($path);
			$content = ob_get_clean();
		}

		foreach ($this->nests as $replace => $nest) {
			$content = str_replace($replace, $nest->render(), $content);
		}

		return $content;
	}
}