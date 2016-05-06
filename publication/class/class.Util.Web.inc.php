<?php
     class Web{
        public function insert($modelo){
            $web = DB_DataObject::Factory('MpWeb');
          //  DB_DataObject::debugLevel(1);
            $web->idBrand=$modelo['idBrand'];
            $web->url=$modelo['url'];
            $web->date= date('Y-m-d H:i:s');
            $id=$web->insert();
            $web->free();
            return $id;
        }
        
         public function insertAnalytics($pagina,$usuario,$pass,$idBrand){
            $web = DB_DataObject::Factory('MpWeb');
           // DB_DataObject::debugLevel(1);
            $web->url=$pagina;
            $web->idBrand=$idBrand;
            $find=$web->find();
            if ($find>0) {
                while($web->fetch()){
                    $web->analyticsUser=$usuario;
                    $web->analyticsPass=$pass;
                    $web->update();    
                }
            }
            $web->free();
        }
    }
?>