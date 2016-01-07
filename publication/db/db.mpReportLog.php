<?php
/**
 * Table Definition for mp_report_log
 */
require_once 'DB/DataObject.php';

class DataObject_MpReportLog extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_report_log';       // table name
    public $idReportLog;                     // int(4)  primary_key not_null
    public $idReport;                        // int(4)   not_null
    public $startDate;                       // datetime   not_null default_0000-00-00%2000%3A00%3A00
    public $endDate;                         // datetime   not_null default_0000-00-00%2000%3A00%3A00
    public $date;                            // datetime   not_null default_0000-00-00%2000%3A00%3A00
    public $URL;                             // text  

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
             'URL' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_TXT,
         );
    }

    function keys()
    {
         return array('idReportLog');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idReportLog', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'idReportLog' => null,
             'idReport' => null,
             'startDate' => null,
             'endDate' => null,
             'date' => null,
             'URL' => null,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
