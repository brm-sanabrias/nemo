<?php
/**
 * Table Definition for mp_brand_x_social_network
 */

class DataObject_MpBrandXSocialNetwork extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'mp_brand_x_social_network';       // table name
    public $id;                              // int(11)  not_null primary_key auto_increment
    public $idBrand;                         // int(11)  not_null multiple_key
    public $idSocialNetwork;                 // int(11)  not_null multiple_key
    public $idInteraction;                   // int(11)  not_null multiple_key
    public $snID;                            // blob(65535)  not_null blob
    public $ownedBrand;                      // string(1)  enum
    public $status;                          // string(1)  enum
    public $date;                            // datetime(19)  not_null binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_MpBrandXSocialNetwork',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idBrand' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idSocialNetwork' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idInteraction' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'snID' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'ownedBrand' =>  DB_DATAOBJECT_STR,
             'status' =>  DB_DATAOBJECT_STR,
             'date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idBrand', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'snID' => '',
             'ownedBrand' => 'N',
             'status' => 'L',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}