<?php
/**
 * Table Definition for mp_report_log
 */

class DataObject_MpReportLog extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_report_log';                   // table name
    public $idReportLog;                     // int(11)  not_null primary_key auto_increment
    public $idReport;                        // int(11)  not_null multiple_key
    public $startDate;                       // datetime(19)  not_null binary
    public $endDate;                         // datetime(19)  not_null binary
    public $date;                            // datetime(19)  not_null binary
    public $URL;                             // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpReportLog',$k,$v); }

    function table()
    {
         return array(
             'idReportLog' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idReport' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'startDate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'endDate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'URL' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
         );
    }

    function keys()
    {
         return array('idReportLog');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idBrand', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'URL' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
