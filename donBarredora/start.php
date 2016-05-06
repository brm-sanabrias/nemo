<?php
require_once("db/requires.php");

/*
function startBarredora(){
*/

echo 'Hola, entramos a mrplow';

die();
	$General=new General;

	// Despues de 15 min en estado 'P' -> proceso sin ninguna actualización de registro, se actualiza el estado del fanpage a 'E' -> En espera, para que vuelva en donde quedo
	$fechaMenosDiezMin = date ( 'Y-m-d H:i:s' , strtotime ( '-15 minute' , strtotime ( date('Y-m-d H:i:s') ) ) );
	$fanpageUpdate = $General->getTotalDatos("MpViewFanpage",['id','MAX(dateUpdate) AS dateUpdate'],"status='P'",'',-1,-1,'id');
	if($fanpageUpdate!=false){
		foreach ($fanpageUpdate as $fpUpdate) {
			if ( $fpUpdate->dateUpdate < $fechaMenosDiezMin) {
				$General->setUpdateInstancia("MpBrandXSocialNetwork",array("status"=>"E"),array("id"=>$fpUpdate->id));
			}
		}
	}
	

	/* Empieza */

	do{
		
		$Fanpage = $General->getTotalDatos("MpBrandXSocialNetwork","",'status="E"','',0,1);

		if ($Fanpage!=false) {
			// Camelcase String 	//	$nameFanpage=lcfirst(str_replace(" ", "", ucwords(strtolower("asd_Asd_asd_sdd"))));

			/**
			Inicio Proceso
			**/

			/* ** Diario **

				$hoy = date("Y-m-d");
				$since = date("Y-m-d",strtotime ( '-1 day' , strtotime ( $hoy ) )) ;
				$until = $hoy;
			
			*/

			$since = "2016-03-21";
			$until = "2016-03-23";


			$idFanpage = $Fanpage[0]->id;
			$idBrand = $Fanpage[0]->idBrand;

			$nameResult = $General->getTotalDatos("MpBrand","name",'idBrand="'.$idBrand.'"','',0,1);

			$nameFanpage="fb_".str_replace(" ", "_", strtolower(quitar_tildes($nameResult[0]->name)));

			$marcaPropia = $Fanpage[0]->ownedBrand;
			
			// Actualiza estado del fanpage a "P" -> en Proceso
			$updateFanpage=new General;
			$updateFanpage->setUpdateInstancia("MpBrandXSocialNetwork",array("status"=>"P"),array("id"=>$idFanpage));

			/**
			Proceso y configuración
			**/


			// Request idTemp  si se cayo barredora, para que inicie desde ahí
			$idTemp = $General->getTotalDatos("MpIdTemp",['typeFbField'],'idBrandXSocialNetwork='.$idFanpage.' and idFbField<>""','',0,1);
			$idTipo=$idTemp[0]->typeFbField;


			if($idTipo == 'Posts' || $idTipo == false){
				/* Post */
				$barredora = new Barredora([
					'idFanpage'=>$idFanpage,
					'nameCollection'=>$nameFanpage,
					'limite'=>25,
					'me'=>'Posts',
					'meSearch'=>'Posts',
					'padre'=>'Fanpage',
					'camposTraer'=>['icon','picture','message','link','shares','status_type','story_tags','subscribed','timeline_visibility','type','updated_time','created_time','from','full_picture','id','is_expired','is_hidden','is_instagram_eligible','is_published','is_spherical','name','object_id','privacy','promotion_status'],
					'direcciones'=>['next'],
					'otherUrl'=>"",
					'since'=>$since,
					'until'=>$until,
					'limitNext'=>"",
					'desdeCeros'=>'N',
					'reply'=>"",
					]);
				$barredora->start();
				$idTipo=false;
			}

			if($idTipo == 'Comments' || $idTipo == false){

				/* Comment */
				$barredora = new Barredora([
					'idFanpage'=>$idFanpage,
					'nameCollection'=>$nameFanpage,
					'limite'=>5000,
					'me'=>'Comments',
					'meSearch'=>'Comments',
					'padre'=>'Posts',
					'camposTraer'=>['can_comment','can_like','can_remove','comment_count','created_time','from','id','is_private','message','like_count','user_likes'],
					'direcciones'=>['next'],
					'otherUrl'=>"",
					'since'=>"",
					'until'=>"",
					'limitNext'=>"",
					'desdeCeros'=>'N',
					'reply'=>"N",
					]);
				$barredora->start();
				$idTipo=false;
			}


			/* Comment Reply*/
			$barredora = new Barredora([
				'idFanpage'=>$idFanpage,
				'nameCollection'=>$nameFanpage,
				'limite'=>5000,
				'me'=>'Comments',
				'meSearch'=>'Comments',
				'padre'=>'Comments',
				'camposTraer'=>['can_comment','can_like','can_remove','comment_count','created_time','from','id','is_private','message','like_count','user_likes'],
				'direcciones'=>['next'],
				'otherUrl'=>"",
				'since'=>"",
				'until'=>"",
				'limitNext'=>"",
				'desdeCeros'=>'N',
				'reply'=>'S',
				]);
			$barredora->start();
			$idTipo=false;


			if($idTipo == 'LikesComments' || $idTipo == false){
				/* Likes  Comments*/
				/*$barredora = new Barredora([
					'idFanpage'=>$idFanpage,
					'nameCollection'=>$nameFanpage,
					'limite'=>5000,
					'me'=>'LikesComments',
					'meSearch'=>'Likes',
					'padre'=>'Comments',
					'camposTraer'=>['can_post','id','link','name','pic','pic_crop','pic_large','pic_small','pic_square','profile_type'],
					'direcciones'=>['next'],
					'otherUrl'=>"",
					'since'=>"",
					'until'=>"",
					'limitNext'=>"",
					'desdeCeros'=>'N',
					'reply'=>"",
					]);
				$barredora->start();
				$idTipo=false;*/
			}

			if($idTipo == 'LikesPosts' || $idTipo == false){
				/* Likes Posts*/
				/*$barredora = new Barredora([
					'idFanpage'=>$idFanpage,
					'nameCollection'=>$nameFanpage,
					'limite'=>5000,
					'me'=>'LikesPosts',
					'meSearch'=>'Likes',
					'padre'=>'Posts',
					'camposTraer'=>['can_post','id','link','name','pic','pic_crop','pic_large','pic_small','pic_square','profile_type'],
					'direcciones'=>['next'],
					'otherUrl'=>"",
					'since'=>"",
					'until'=>"",
					'limitNext'=>"",
					'desdeCeros'=>'N',
					'reply'=>"",
					]);
				$barredora->start();
				$idTipo=false;*/
			}


			if($idTipo == 'Events' || $idTipo == false){
				/* Events */
				$barredora = new Barredora([
					'idFanpage'=>$idFanpage,
					'nameCollection'=>$nameFanpage,
					'limite'=>5000,
					'me'=>'Events',
					'meSearch'=>'Events',
					'padre'=>'Fanpage',
					'camposTraer'=>['attending_count','can_guests_invite','cover','declined_count','description','guest_list_enabled','id','is_page_owned','is_viewer_admin','maybe_count','name','noreply_count','owner','place','start_time','end_time','timezone','type','updated_time'],
					'direcciones'=>['next'],
					'otherUrl'=>"",
					'since'=>$since,
					'until'=>$until,
					'limitNext'=>"",
					'desdeCeros'=>'N',
					'reply'=>"",
					]);
				$barredora->start();
				$idTipo=false;
			}


			if($idTipo == 'EventAttending' || $idTipo == false){
				/* Events  Attending */
				$barredora = new Barredora([
					'idFanpage'=>$idFanpage,
					'nameCollection'=>$nameFanpage,
					'limite'=>5000,
					'me'=>'EventAttending',
					'meSearch'=>'Attending',
					'padre'=>'Events',
					'camposTraer'=>['context','cover','id','install_type','is_verified','link','middle_name','name','rsvp_status','third_party_id','updated_time'],
					'direcciones'=>['next'],
					'otherUrl'=>"",
					'since'=>"",
					'until'=>"",
					'limitNext'=>"",
					'desdeCeros'=>'N',
					'reply'=>"",
					]);
				$barredora->start();
				$idTipo=false;
			}


			if($idTipo == 'EventDeclined' || $idTipo == false){
				/* Events  Declined */
				$barredora = new Barredora([
					'idFanpage'=>$idFanpage,
					'nameCollection'=>$nameFanpage,
					'limite'=>5000,
					'me'=>'EventDeclined',
					'meSearch'=>'Declined',
					'padre'=>'Events',
					'camposTraer'=>['context','cover','id','install_type','is_verified','link','middle_name','name','rsvp_status','third_party_id','updated_time'],
					'direcciones'=>['next'],
					'otherUrl'=>"",
					'since'=>"",
					'until'=>"",
					'limitNext'=>"",
					'desdeCeros'=>'N',
					'reply'=>"",
					]);
				$barredora->start();
				$idTipo=false;
			}


			if($idTipo == 'EventNoreply' || $idTipo == false){
				/* Events  Noreply */
				$barredora = new Barredora([
					'idFanpage'=>$idFanpage,
					'nameCollection'=>$nameFanpage,
					'limite'=>5000,
					'me'=>'EventNoreply',
					'meSearch'=>'Noreply',
					'padre'=>'Events',
					'camposTraer'=>['context','cover','id','install_type','is_verified','link','middle_name','name','rsvp_status','third_party_id','updated_time'],
					'direcciones'=>['next'],
					'otherUrl'=>"",
					'since'=>"",
					'until'=>"",
					'limitNext'=>"",
					'desdeCeros'=>'N',
					'reply'=>"",
					]);
				$barredora->start();
				$idTipo=false;
			}


			if(($idTipo == 'Insights' || $idTipo == false) && $marcaPropia=="S"){
				/* Insights*/
				$fecha1=$since;
				$fecha2 = date("Y-m-d", strtotime($until ."- 1 days")) ;
				for($date=$fecha1;$date<=$fecha2;$date = date("Y-m-d", strtotime($date ."+ 1 days"))){
					$since = $date;
					$until = date("Y-m-d", strtotime($date ."+ 1 days"));
					$barredora = new Barredora([
						'idFanpage'=>$idFanpage,
						'nameCollection'=>$nameFanpage,
						'limite'=>1,
						'me'=>'Insights',
						'meSearch'=>'Insights',
						'padre'=>'Fanpage',
						'camposTraer'=>[],
						'direcciones'=>['next'],
						'otherUrl'=>"/page_impressions_unique/day",
						'since'=>$since,
						'until'=>$until,
						'limitNext'=>1,
						'desdeCeros'=>'S',
						'reply'=>"",
						]);
					$barredora->start();
					$idTipo=false;
				}
			}


			/**
			Fin Proceso
			**/

			// Actualiza estado del fanpage a "L" -> Listo
			$updateFanpage->setUpdateInstancia("MpBrandXSocialNetwork",array("status"=>"L"),array("id"=>$idFanpage));

		}
	}while($Fanpage!=false);
/*}*/
?>