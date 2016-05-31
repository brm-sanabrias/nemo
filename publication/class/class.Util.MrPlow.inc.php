<?php
    class Mrplow{
        public function lunchReport($idBrand,$idSocialNetwork,$idInteraction){
            $report = DB_DataObject::Factory('MpBrandXSocialNetwork');
           // DB_DataObject::debugLevel(1);
            $report->idBrand=$idBrand;
            $report->idInteraction=$idInteraction;
            $report->idSocialNetwork=$idSocialNetwork;
            $find= $report->find();
            if ($find>0) {
                while($report->fetch()){
                    if ($report->status=='L') {
                        $report->status='E';
                        $report->update();
                    }
                }
            }else{
                $report->snID="Aqui va algo";
                $report->ownedBrand='N';
                $report->status='E';
                $report->date=date('Y-m-d h:i:s');
                $l = $report->insert();
               // printVar($l);
            }
            $report->free();
            return 'ok';
        }
    }   
?>