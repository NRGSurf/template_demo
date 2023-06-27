<?php
error_reporting( E_ALL ^ E_NOTICE ) ;

class View {
	private $_path;
	private $_template;
	private $_var = array();

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct( $path = '' ) {
		$this->_path = $path;
	}
	// __construct


  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function set( $name, $value ) {
		$this->_var[$name] = $value;
	}
	// set



  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __get( $name) {
		if (isset($this->_var[$name])) return $this->_var[$name];
		return '';
	}
	// __get


  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  static function simple( $template, $vars = array()) {
    $instance = new self() ;
    $instance->_path = '' ;
    $instance->_template = $template ;

    foreach( $vars as $name => $value )
    {
      $instance->_var[$name] = $value ;
    }

    $out = $instance->render( $template ) ;

    return $out ;
  }
  // simple


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function display( $template, $lang = null, $finalTranslation = null ) {
		$this->_template = $this->_path . $template;
		if (!file_exists($this->_template)) die('Template ' . $this->_template . ' is missing!');

		ob_start();
		if ( $lang === true )
		{
			$fileContent = file_get_contents( $this->_template ) ;
			$fileContent = translateText( $fileContent ) ; 
			eval("?>" . $fileContent . "<?php ");
		}
		elseif ( $lang )
		{
			$fileContent = file_get_contents( $this->_template ) ;
			eval("?>" . $fileContent . "<?php ");
		}
		else
		{
			include( $this->_template ) ;
		}

		$result = ob_get_clean() ;

		$result = $finalTranslation ? translateText( $result ) : $result ;

		echo $result ;
		
		return $result ;
	}
	// display


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function render( $template, $lang = null ) {
		$this->_template = $this->_path . $template;
		if (!file_exists($this->_template)) die('Template ' . $this->_template . ' is missing!');

		ob_start();
		
		if ( $lang )
		{
			$fileContent = file_get_contents( $this->_template ) ;
			eval("?>" . $fileContent . "<?php ");
		}
		else
		{
			include( $this->_template ) ;
		}

		return ob_get_clean() ;
	}
	// render
}
