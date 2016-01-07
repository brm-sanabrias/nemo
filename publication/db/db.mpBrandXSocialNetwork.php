<?php
/**
 * Table Definition for mp_brand_x_social_network
 */
require_once 'DB/DataObject.php';

class DataObject_MpBrandXSocialNetwork extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_brand_x_social_network';    // table name
    public $idBrand;                         // int(4)  primary_key not_null
    public $idSocialNetwork;                 // int(4)  primary_key not_null
    public $idInteraction;                   // int(4)   not_null
    public $snID;                            // text   not_null
    public $date;                            // datetime   not_null default_0000-00-00%2000%3A00%3A00

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpBrandXSocialNetwork',$k,$v); }

    function table()
    {
         return array(
             'idBrand' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idSocialNetwork' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idInteraction' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'snID' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_TXT + DB_DATAOBJECT_NOTNULL,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('idBrand', 'idSocialNetwork');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idBrand', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'idBrand' => null,
             'idSocialNetwork' => null,
             'idInteraction' => null,
             'snID' => null,
             'date' => null,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
