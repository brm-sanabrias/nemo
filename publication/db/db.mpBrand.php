<?php
/**
 * Table Definition for mp_brand
 */

class DataObject_MpBrand extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_brand';                        // table name
    public $idBrand;                         // int(11)  not_null primary_key auto_increment
    public $idCategory;                      // int(11)  not_null multiple_key
    public $name;                            // string(45)  not_null
    public $picture;
    public $date;                            // datetime(19)  not_null binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpBrand',$k,$v); }

    function table()
    {
         return array(
             'idBrand' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idCategory' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'picture'=>DB_DATAOBJECT_STR,
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
             'name' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
