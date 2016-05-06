<?php
/**
 * Table Definition for mp_web
 */

class DataObject_MpWeb extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_web';                          // table name
    public $id;                              // int(11)  not_null primary_key auto_increment
    public $idBrand;                         // int(11)  not_null
    public $url;                             // string(150)  not_null
    public $analyticsUser;                   // string(255) 
    public $analyticsPass;                   // string(255) 
    public $date;                            // datetime(19)  not_null binary

    /* Static get */
    function &staticGet($class,$k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpWeb',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idBrand' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'url' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'analyticsUser' => DB_DATAOBJECT_STR,
             'analyticsPass' => DB_DATAOBJECT_STR,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('id', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'url' => '',
         );
    }


    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
