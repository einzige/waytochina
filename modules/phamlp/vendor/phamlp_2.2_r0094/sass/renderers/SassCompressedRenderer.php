<?php
/* SVN FILE: $Id: SassCompressedRenderer.php 67 2010-04-18 11:51:40Z chris.l.yates $ */
/**
 * SassCompressedRenderer class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Sass.renderers
 */
/**
 * SassCompressedRenderer class.
 * Compressed style takes up the minimum amount of space possible, having no
 * whitespace except that necessary to separate selectors and a newline at the
 * end of the file. It's not meant to be human-readable
 * @package			PHamlP
 * @subpackage	Sass.renderers
 */
class SassCompressedRenderer extends SassRenderer {
	/**
	 * Renders the brace between the selectors and the properties
	 * @return string the brace between the selectors and the properties
	 */
	protected function between() {
	  return '{';
	}

	/**
	 * Renders the brace at the end of the rule
	 * @return string the brace between the rule and its properties
	 */
	protected function end() {
	  return '}';
	}

	/**
	 * Renders a comment.
	 * @param SassNode the node being rendered
	 * @return string the rendered comment
	 */
	public function renderComment($node) {
	  return '';
	}

	/**
	 * Renders a directive.
	 * @param SassNode the node being rendered
	 * @param array properties of the directive
	 * @return string the rendered directive
	 */
	public function renderDirective($node, $properties) {
		return $node->directive . $this->between() . $this->renderProperties($properties) . $this->end();
	}

	/**
	 * Renders properties.
	 * @param array properties to render
	 * @return string the rendered properties
	 */
	public function renderProperties($properties) {
		return join('', $properties);
	}

	/**
	 * Renders a property.
	 * @param SassNode the node being rendered
	 * @return string the rendered property
	 */
	public function renderProperty($node) {
		return "{$node->name}:{$node->value};";
	}

	/**
	 * Renders a rule.
	 * @param SassNode the node being rendered
	 * @param array rule properties
	 * @param string rendered rules
	 * @return string the rendered directive
	 */
	public function renderRule($node, $properties, $rules) {
		return (!empty($properties) ? $this->renderSelectors($node) . $this->between() . $this->renderProperties($properties) . $this->end() : '') . $rules;
	}

	/**
	 * Renders the rule's selectors
	 * @param SassNode the node being rendered
	 * @return string the rendered selectors
	 */
	protected function renderSelectors($node) {
		$selectors = '';
		foreach ($node->selectors as $line) {
			$selectors .= join(',', $line) . ",";
		} // foreach
	  return substr($selectors, 0, -1);
	}
}