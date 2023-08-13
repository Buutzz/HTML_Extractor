<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ){
	exit;
}

/**
 * Class for database query
 */
class Query{

    /**
     * Delcare where static params 
     * @var string
     */
    const WHERE = "WHERE `id` = ";

    /**
     * Delcare FROM static params 
     * @var string
     */
    const FROM = "* FROM";

    public function __construct(){}

    /**
     * Return the name of the table
     * 
     * @return string the name of the table
     */
    public static function tableName(){
        global $wpdb;

        return $wpdb->prefix . 'posts';
    }

    /**
     * Used for compose query for database search
     * 
     * @return string prepared query for database
     */
    public function composeQuery($statement,$params){
        $table = ' ' . $this->tableName() . ' ' ;
        $where = self::WHERE . ' ' . $params;
        $statement = $statement . ' ' . self::FROM;

        $query = "{$statement}{$table}{$where}";

        return $query;
    }

    /**
     * Used for get result from database
     */

    public function query($arg){
        global $wpdb;
        $result = $wpdb->get_results($arg);

        return $result;
    }

}