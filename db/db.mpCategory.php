<?php
/**
 * Table Definition for mp_category
 */
require_once 'DB/DataObject.php';

class DataObject_MpCategory extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_category';         // table name
    public $idCategory;                      // int(4)  primary_key not_null
    public $name;                            // varchar(45)   not_null
    public $date;                            // date  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpCategory',$k,$v); }

    function table()
    {
         return array(
             'idCategory' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE,
         );
    }

    function keys()
    {
         return array('idCategory');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idCategory', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'idCategory' => null,
             'name' => null,
             'date' => null,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
