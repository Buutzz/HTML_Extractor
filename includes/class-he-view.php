<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ){
	exit;
}

/**
 * Class for view and display proper tempalate
 */
class View{

	/**
	 * Base directory for views
	 * @var string
	 */
    const DIRECTORY = 'views';

	/**
	 * View script extension
	 * @var string
	 */
    const EXTENSION = '.php';

    /**
	 * Absolute path for view
	 * @var string
	 */
    protected $path = null;
    
    /**
	 * Template file name to render
	 * @var string
	 */
	protected $template = null;


    public function __construct(){
        // Looking for a basic irectory where plugin resides
        list($plugin_dir) = explode( '/', plugin_basename( __FILE__ ) );

        //Create an absolute path to views directory
        $path_array = array( WP_PLUGIN_DIR, $plugin_dir, self::DIRECTORY );

        $this->path = implode( '/', $path_array );
    }

    public function setTemplate( $template ){
        $this->template = trailingslashit( $this->path ) . $template . self::EXTENSION;
    }

    /**
	 * Returns the template
	 *
	 * Checks to make sure that the file exists and is readable.
	 *
	 * @return string|\WP_Error
	 */
    private function getRenderableFile(){

        if( ! is_readable( $this->template ) ){
            return new \WP_Error( 'invalid_template', sprintf( __( "Can't find view template: %s", 'html-extractor' ), $this->template ) );
        }
        else{
            return $this->template;
        }

    }

    /**
     * Render the view
     */
    public function render(){

        $file = $this->getRenderableFile();

        if( is_wp_error( $file ) ){
            return $file;
        }
        else{
            include $file;
            return $this;
        }

    }
}