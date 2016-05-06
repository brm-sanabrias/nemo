<?php
/**
 * Table Definition for mp_view_fanpage
 */

class DataObject_MpViewFanpage extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_view_fanpage';                 // table name
    public $id;                              // int(11)  not_null
    public $snID;                            // blob(65535)  not_null blob
    public $name;                            // string(135)  not_null
    public $date;                            // datetime(19)  not_null binary
    public $status;                          // string(3)  enum
    public $idFbField;                       // blob(65535)  blob
    public $typeFbField;                     // blob(65535)  blob
    public $dateUpdate;                      // datetime(19)  binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpViewFanpage',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'snID' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'status' =>  DB_DATAOBJECT_STR,
             'idFbField' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'typeFbField' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'dateUpdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
         );
    }

    function keys()
    {
         return array();
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idBrand', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'id' => 0,
             'snID' => '',
             'name' => '',
             'status' => 'L',
             'idFbField' => '',
             'typeFbField' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
