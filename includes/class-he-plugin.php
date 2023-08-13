<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ){
	exit;
}

/**
 * Core class for the plugin
 */
class Plugin{

    /**
	 * Plugin version
	 * @var string
	 */
	const VERSION = '1.0';

	/**
	 * The slug of the plugin
	 * @var string
	 */
    const SLUG = 'html-extractor';
    
    /**
	 * Singleton instance
	 */
	protected static $instance = null;

    /**
	 * View object
	 */
    protected $view = null;

    /**
	 * Current page name
	 * @var string
	 */
    protected $current_page = '';
    
    /**
	 * Generetaed HTML code
	 * @var string
	 */
    public $html = '';
    
    /**
	 * Generetaed header for HTML code
	 * @var string
	 */
	public $html_header = '';

    public static function instance(){
        if( null === self::$instance ){
            self::$instance = new self();
            self::$instance->includes();

            // Enqueue admin styles
            add_action( 'admin_enqueue_scripts', array( self::$instance, 'enqueueAdminStyles' ) );
            // Add the menu item
            add_action( 'admin_menu', array( self::$instance, 'addPluginAdminMenu' ), 2 );
            
            self::$instance->view = new View();
            
            $page = isset( $_POST['page'] ) ? $_POST['page'] : '';
            self::$instance->current_page = self::$instance->getCurrentPage( $page );

            if(isset( $_POST['post_id'] ) AND $_POST['post_id'] !== ''){
                $post_id = (int) $_POST['post_id'];
                $respond = self::$instance->getPageInfo( $post_id );
                if( $respond ){
                    self::$instance->getHtmlCode( $respond );
                }

            }
        }
        
        return self::$instance;
    }

    /**
     * Include required files
     * @return void
     */
    public function includes(){
        $path = plugin_dir_path( dirname( __FILE__ ) );
        require_once $path . 'includes/model/class-he-model.php';
        require_once $path . 'includes/class-he-view.php';
        require_once $path . 'includes/class-he-query.php';
        require_once $path . 'includes/class-he-generate.php';
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu
     * @return void
     */
    public function addPluginAdminMenu(){

        // Add main menu item
		add_menu_page(
			__( 'HTML Extractor', 'html-extractor' ),
			__( 'HTML Extractor', 'html-extractor' ),
			'administrator',
			self::SLUG,
			array( self::$instance, 'display' )
        );
        
    }
    
    /**
	 * Enqueue admin-specific style sheets for this plugin's admin pages only
	 * @return void
	 */
	public function enqueueAdminStyles() {
		// Plugin admin CSS. Tack on plugin version.
		wp_enqueue_style( self::SLUG . '-admin-styles', plugin_dir_url( dirname( __FILE__ ) ) . 'css/admin.css', array(), self::VERSION );
    }
    
    /**
     * Set current page information
     */
    protected function getCurrentPage( $page ){

        $page = str_replace( self::SLUG, '', $page );

        switch($page){
            case '':
                $current_page = 'main';
            break;
            case 'generate':
                $current_page = 'generate';
            break;
            default:
                $current_page = 'main';
            break;
        }

        return $current_page;

    }

    /**
     * Display proper tempalte from views directory
     */
    public function display(){

        $this->view
            ->setTemplate($this->current_page);

        $this->view
            ->render(); 

    }

    /**
     * Get info about page/post
     */
    protected function getPageInfo( $page_id ){
        $query = new Query();

        $compose_query = $query->composeQuery("SELECT",$page_id);

        $respond = $query->query($compose_query);

        return $respond[0];
    }

    /**
     * Gather and set information about HTML code
     */
    protected function getHtmlCode( $post ){
        $html = new Generate();
        $respond = $html->generateHtmlCode( $post );

        $this->html = $respond;
        $this->html_header = $html->generateRespondHeader( $post->post_title, $post->ID );

    }

}