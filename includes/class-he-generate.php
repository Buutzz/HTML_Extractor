<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ){
	exit;
}

/**
 * Core class for the plugin
 */
class Generate{

    /**
     * Respond text if someone want to get draft HTML
     */
    const NOT_PUBLISHED = 'You don\'t have acces to this content. It\'s impossible to generate HTML Code right now.';

    /**
     * Respond text if someone want to get draft HTML
     */
    const FOR_HEADER = 'Code generate for: ';

    /**
     * HTML code for post or page
     * @var string
     */

    protected $html;

    public function __construct(){}

    /**
     * Used to check if page or post are published
     * @return bool
     */
    protected function checkIsValid( $post_status ){
        if($post_status == "publish"){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * 
     * Get object with information about post or page
     * 
     * @return string
     */
    public function generateRespondHeader( $title, $id ){
        $respond = self::FOR_HEADER . " " . $title . " (" . $id . ")";
        return $respond;
    }

    /**
     * 
     * Get object with information about post or page
     * 
     * @return string
     */
    public function generateHtmlCode( $post ){

        if( $this->checkIsValid( $post->post_status ) ){
            $respond = wp_remote_get( $post->guid );
            $this->html = $respond['body'];
            return $this->html;
        }
        else{
            return self::NOT_PUBLISHED;
        }

    }

}