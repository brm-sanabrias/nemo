<?php
/**
 * Table Definition for mp_id_temp
 */

class DataObject_MpIdTemp extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_id_temp';                      // table name
    public $id;                              // int(11)  not_null primary_key auto_increment
    public $idBrandXSocialNetwork;           // int(11)  multiple_key
    public $idFbField;                       // blob(65535)  blob
    public $typeFbField;                     // blob(65535)  blob
    public $date;                            // datetime(19)  binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpIdTemp',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idBrandXSocialNetwork' =>  DB_DATAOBJECT_INT,
             'idFbField' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'typeFbField' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
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
             'idFbField' => '',
             'typeFbField' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
