<?php
/**
 * Table Definition for mp_token
 */

class DataObject_MpToken extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_token';                        // table name
    public $id;                              // int(11)  not_null primary_key auto_increment
    public $idUserFb;                        // int(11)  not_null multiple_key
    public $token;                           // blob(65535)  blob
    public $status;                          // string(1)  enum
    public $dateUpdate;                      // datetime(19)  binary
    public $date;                            // datetime(19)  binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpToken',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idUserFb' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'token' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'status' =>  DB_DATAOBJECT_STR,
             'dateUpdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idBrand', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'token' => '',
             'status' => 'N',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
