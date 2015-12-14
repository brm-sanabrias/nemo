<?php
/**
 * Table Definition for mp_brand
 */
require_once 'DB/DataObject.php';

class DataObject_MpBrand extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_brand';            // table name
    public $idBrand;                         // int(4)  primary_key not_null
    public $idCategory;                      // int(4)   not_null
    public $picture;                         // text   not_null
    public $name;                            // varchar(45)   not_null
    public $date;                            // datetime   not_null default_0000-00-00%2000%3A00%3A00

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpBrand',$k,$v); }

    function table()
    {
         return array(
             'idBrand' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idCategory' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'picture' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_TXT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('idBrand');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idBrand', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'idBrand' => null,
             'idCategory' => null,
             'picture' => null,
             'name' => null,
             'date' => null,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
