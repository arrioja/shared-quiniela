<?php

/**
 * Classe du gestionnaire javascript de composants Flash
 * @author Bruno Mac� - AxeDesign Web Agency
 */
 
class MBSWFObject extends TCompositeControl{

    private $_container;

    public function createChildControls() {
		$this->_container=new TPanel;
        $this->_container->setID('Container');
        $this->getControls()->add($this->_container); 
    }

	/**
	 * Renders body contents of the table.
	 * @param THtmlWriter the writer used for the rendering purpose.
	 */
	public function renderControl($writer){
		$this->getContainer()->Controls[0] = "";				
		$this->getContainer()->renderControl($writer);
		$scriptincluded = TJavascript::renderScriptFile($this->getSWFObjectScriptPath());
		$scripts = array();
		$scripts[] = "var so = new SWFObject(\"".$this->getSWFPath()."\",\"".$this->getContainer()->getClientID()."\",\"".$this->getWidth()."\",\"".$this->getHeight()."\",\"".$this->getFlashVersion()."\",\"".$this->getBackgroundColor()."\");";
		foreach($this->getParams() as $param){
			$param_name = $param[0];
			$param_value = $param[1];
			$scripts[] = "so.addVariable(\"$param_name\",\"$param_value\");";
		}
		$scripts[] = "so.addParam(\"wmode\",\"".$this->getWmode()."\");";
		$scripts[] = "so.write(\"".$this->getContainer()->getClientID()."\");";
		$str = TJavascript::renderScriptBlocks($scripts);
		$writer->write($scriptincluded);
		$writer->write($str);
	}

    public function getContainer() {
        $this->ensureChildControls();
        return $this->_container;
    }

	/**
	 * @return array les pasam�tres � passer au SWF
	 */
	public function getParams()
	{
		return $this->getViewState('Params',array());
	}

	/**
	 * @param array les param�tres � passer au SWF
	 */
	public function setParams($value)
	{
		$this->setViewState('Params',$value,array());
	}
	
	/**
	 * @return int la largeur
	 */
	public function getWidth()
	{
		return $this->getViewState('Width','320');
	}

	/**
	 * @param string la largeur
	 */
	public function setWidth($value)
	{
		$this->setViewState('Width',$value,'320');
	}
	
	/**
	 * @return int la hauteur
	 */
	public function getHeight()
	{
		return $this->getViewState('Height','240');
	}

	/**
	 * @param int la hauteur
	 */
	public function setHeight($value)
	{
		$this->setViewState('Height',$value,'240');
	}
	
	/**
	 * @return int flash version
	 */
	public function getFlashVersion()
	{
		return $this->getViewState('FlashVersion',6);
	}

	/**
	 * @param int flash version
	 */
	public function setFlashVersion($value)
	{
		$this->setViewState('FlashVersion',$value,6);
	}
	/**
	 * @return string la couleur de fond
	 */
	public function getBackgroundColor()
	{
		return $this->getViewState('BackgroundColor',"#ffffff");
	}

	/**
	 * @param string la couleur de fond
	 */
	public function setBackgroundColor($value)
	{
		$this->setViewState('BackgroundColor',$value,"#ffffff");
	}
	
	/**
	 * @return le mode (transparence ou non du SWF)
	 */
	public function getWmode()
	{
		return $this->getViewState('Wmode','transparent');
	}

	/**
	 * @param string  le mode (transparence ou non du SWF)
	 */
	public function setWmode($value)
	{
		$this->setViewState('Wmode',$value,'transparent');
	}

	/**
	 * @return string le chemin vers le SWF � afficher
	 */
	public function getSWFPath()
	{
		return $this->getViewState('SWFPath',"");
	}

	/**
	 * @param string le chemin vers le lecteur flv
	 */
	public function setSWFPath($value)
	{
		$this->setViewState('SWFPath',$value,"");
	}
	
	/**
	 * 
	 */
	protected function getDeploymentPath(){
	//	$file = Prado::getPathOfNamespace('System.3rdParty.SWFObject', '');
    	$file = Prado::getPathOfNamespace('Application.clases.SWFObject', '');
		$url = $this->getApplication()->getAssetManager()->publishFilePath($file,false);
		return $url;
	}

	/**
	 * @return string le chemin vers le lecteur flv
	 */
	public function getSWFObjectScriptPath()
	{
		return $this->getDeploymentPath()."/swfobject.js";
	}


}

?>