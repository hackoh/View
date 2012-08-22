<?php
class View {
	private $_extends;
	private $_blocks = array();
	private $_current;
	public static function render($viewFileName, $_vars = array(), $_blocks = array()) {
		ob_start();
		extract($_vars);
		$view = new View();
		include $viewFileName;
		$_content = ob_get_clean();
		if ($view->_extends) {
			if ($view->_current !== null) $view->_clean();
			$_content = View::render($view->_extends, $_vars, array_merge($view->_blocks, $_blocks));
		}
		$_content = View::_parseBlock($_content, $_blocks);
		return $_content;
	}
	private static function _parseBlock($content, $blocks) {
		if (preg_match_all('/\<\!--\{(.*?)\}--\>[\r\n]*/', $content, $matches)) {
			foreach ($matches[1] as $index => $_key) {
				if (isset($blocks[$_key]))
					$content = str_replace($matches[0][$index], $blocks[$_key], $content);
			}
		}
		return $content;
	}
	public function extend($filename) {
		$this->_extends = $filename;
	}
	public function block($name) {
		$this->_blocks[$name] = true;
		$this->_current = $name;
		ob_start();
	}
	private function _clean() {
		ob_clean();
		$this->_current = null;
	}
	public function blockend() {
		if ($this->_current === null) trigger_error('block end error', E_USER_ERROR);
		$this->_blocks[$this->_current] = View::_parseBlock(ob_get_clean(), $this->_blocks);
		$this->_current = null;
	}
}