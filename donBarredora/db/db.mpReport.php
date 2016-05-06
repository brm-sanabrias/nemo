<?php
/**
 * Table Definition for mp_report
 */

class DataObject_MpReport extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_report';                       // table name
    public $idReport;                        // int(11)  not_null primary_key auto_increment
    public $idBrand;                         // int(11)  not_null multiple_key
    public $date;                            // datetime(19)  not_null binary
    public $recurrence;                      // string(45)  not_null

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
         return array('idBrand', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'recurrence' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
