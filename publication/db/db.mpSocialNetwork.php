<?php
/**
 * Table Definition for mp_social_network
 */

class DataObject_MpSocialNetwork extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_social_network';               // table name
    public $idSocialNetwork;                 // int(11)  not_null primary_key auto_increment
    public $name;                            // string(45)  not_null
    public $date;                            // date(10)  not_null binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpSocialNetwork',$k,$v); }

    function table()
    {
         return array(
             'idSocialNetwork' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('idSocialNetwork');
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
