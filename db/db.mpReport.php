<?php
/**
 * Table Definition for mp_report
 */
require_once 'DB/DataObject.php';

class DataObject_MpReport extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_report';           // table name
    public $idReport;                        // int(4)  primary_key not_null
    public $idBrand;                         // int(4)   not_null
    public $date;                            // datetime   not_null default_0000-00-00%2000%3A00%3A00
    public $recurrence;                      // varchar(45)   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpReport',$k,$v); }

    function table()
    {
         return array(
             'idReport' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idBrand' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'recurrence' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('idReport');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idReport', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'idReport' => null,
             'idBrand' => null,
             'date' => null,
             'recurrence' => null,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
