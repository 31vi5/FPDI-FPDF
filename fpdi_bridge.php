<?php
/**
 * This file is part of FPDI
 *
 * @package   FPDI
 * @copyright Copyright (c) 2015 Setasign - Jan Slabon (http://www.setasign.com)
 * @license   http://opensource.org/licenses/mit-license The MIT License
 * @version   1.6.1
 */
class fpdi_bridge extends FPDF
{
	public $javascript;
	public $n_js;

	function IncludeJS ($script){
		$this->javascript = $script;
	}

	function _putjavascript (){
		$this->_newobj ();
		$this->n_js = $this->n;
		$this->_out ('<<');
		$this->_out ('/Names [(EmbeddedJS) ' . ($this->n + 1) . ' 0 R]');
		$this->_out ('>>');
		$this->_out ('endobj');
		$this->_newobj ();
		$this->_out ('<<');
		$this->_out ('/S /JavaScript');
		$this->_out ('/JS ' . $this->_textstring ($this->javascript));
		$this->_out ('>>');
		$this->_out ('endobj');
	}

	function _putresources (){
		parent::_putresources ();
		if ( !empty ($this->javascript) ) {
			$this->_putjavascript ();
		}
	}

	function _putcatalog (){
		parent::_putcatalog ();
		if ( !empty ($this->javascript) ) {
			$this->_out ('/Names <</JavaScript ' . ($this->n_js) . ' 0 R>>');
		}
	}
}