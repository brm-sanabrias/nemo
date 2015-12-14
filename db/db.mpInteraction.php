<?php
/**
 * Table Definition for mp_interaction
 */
require_once 'DB/DataObject.php';

class DataObject_MpInteraction extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_interaction';      // table name
    public $idInteraction;                   // int(4)  primary_key not_null
    public $name;                            // text   not_null
    public $date;                            // datetime  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpInteraction',$k,$v); }

    function table()
    {
         return array(
             'idInteraction' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_TXT + DB_DATAOBJECT_NOTNULL,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
         );
    }

    function keys()
    {
         return array('idInteraction');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idInteraction', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'idInteraction' => null,
             'name' => null,
             'date' => null,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
