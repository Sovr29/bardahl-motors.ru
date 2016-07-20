<?php
class Document {
	private $title;
        private $name;
	private $description;
	private $keywords;
	private $links = array();
	private $styles = array();
	private $scripts = array();
        private $scriptTexts = array();

	public function setTitle($title, $add=true) {
		$this->title = trim($title).($add ? " | Официальный сайт Bardahl" : "");
	}

	public function getTitle() {
		return $this->title;
	}
        
        public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}

	public function getKeywords() {
		return $this->keywords;
	}

	public function addLink($href, $rel) {
		$this->links[$href] = array(
			'href' => $href,
			'rel'  => $rel
		);
	}

	public function getLinks() {
		return $this->links;
	}

	public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
		$this->styles[$href] = array(
			'href'  => $href,
			'rel'   => $rel,
			'media' => $media
		);
	}

	public function getStyles() {
		return $this->styles;
	}

	public function addScript($script) {
		$this->scripts[md5($script)] = $script;
	}
        
    public function getScripts() {
		return $this->scripts;
	}
        
        public function addScriptText($script) {
		$this->scriptTexts[md5($script)] = $script;
	}

	public function getScriptTexts() {
		return $this->scriptTexts;
	}
}