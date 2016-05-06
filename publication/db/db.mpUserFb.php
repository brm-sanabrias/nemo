<?php
/**
 * Table Definition for mp_user_fb
 */

class DataObject_MpUserFb extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_user_fb';                      // table name
    public $id;                              // int(11)  not_null primary_key auto_increment
    public $name;                            // string(75)  
    public $clientIdFb;                      // blob(65535)  blob
    public $clientSecretFb;                  // blob(65535)  blob
    public $idFb;                            // string(75)  
    public $date;                            // datetime(19)  binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpUserFb',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR,
             'clientIdFb' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'clientSecretFb' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'idFb' =>  DB_DATAOBJECT_STR,
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
             'name' => '',
             'clientIdFb' => '',
             'clientSecretFb' => '',
             'idFb' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
