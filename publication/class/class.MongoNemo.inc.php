<?php

 class MongoNemo
 {

     const HOST     = '127.0.0.1';
     const PORT     = 27017;
     const DBNAME   = 'barredoraTw';
     public static $instance;
     public $connection;
     public $database;
     /**
      * __construct
      */
     public function __construct()
     {
         $connectionString = sprintf('mongodb://%s:%d',
             MongoNemo::HOST,
             MongoNemo::PORT
         );
         try {
             $this->connection = new MongoClient($connectionString);
             $this->database = $this->connection->selectDB(MongoNemo::DBNAME);
         } catch (MongoConnectionException  $e) {
                die("Failed to connect to database ").$e->getMessage();
         }
     }
    /**
     * instantiate function
     * @return void
     * @author Steve Francia <steve.francia@gmail.com>
     */
    static public function instantiate()
    {
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }
    /**
     * get collection
     *
     * @return void
     */
    public function getCollection($name)
    {
        return $this->database->selectCollection($name);
    }
    public function getWordsTw(){
    	//$tweetSearch=$this->barredoraTw->tweetSearch;
    	$db = $this->database;
    	$tags = iterator_to_array($db->selectCollection('tweetTimeLine')->find()->sort(array('UScreatedAt' => -1))->limit(200));
        return $tags;
    }
 }