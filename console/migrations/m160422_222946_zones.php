<?php

class m160422_222946_zones extends CDbMigration
{
	public function up()
	{
		$this->createTable('zones', array(
			'id' => 'pk',
			'title' => 'varchar(200) NOT NULL',
			'time'  => 'integer NOT NULL',
			'restoran_id'  => 'integer NOT NULL',
			'params' => 'text',
		));

		$data = [
			'[
                                   		[
											[53.16467,50.07338],[53.16013,50.08918],[53.13371,50.06102],[53.14197,49.98755],[53.15291,49.98137],[53.15188,50.01982],[53.16034,50.05038],[53.16467,50.07338]
                                   		]
                                   	]',
			'[
	                                       	[
												[53.33392,50.19497],[53.33761,50.24166],[53.3485,50.25265],[53.39757,50.18604],[53.3986,50.16476],[53.40209,50.14588],[53.38957,50.15309],[53.37192,50.17437],[53.35508,50.19016],[53.33392,50.19497]
	                                       	]
	                                       ]',
			'[
	                                       	[
												[53.22752,50.28925],[53.25079,50.35843],[53.25677,50.37336],[53.26953,50.31792],[53.22752,50.28925]
	                                       	]
	                                       ]',
			'[
	                                       	[
												[53.21485,50.26728],[53.20186,50.23518],[53.19424,50.21629],[53.18052,50.19604],[53.17341,50.172],[53.18537,50.14797],[53.21124,50.11783],[53.22319,50.14615],[53.24596,50.17087],[53.2336,50.18735],[53.23854,50.19594],[53.2615,50.21533],[53.2757,50.22769],[53.26346,50.24143],[53.25131,50.221],[53.21485,50.26728]
	                                       	]
	                                       ]',
			'[
	                                       	[
												[53.31075,50.19354],[53.29142,50.22582],[53.27867,50.22719],[53.23749,50.18736],[53.24738,50.175],[53.31075,50.19354]
	                                       	]
	                                       ]',
			'[
	                                       	[
												[53.21959,50.26298],[53.25131,50.22264],[53.27159,50.25749],[53.24153,50.27328],[53.23782,50.28891],[53.22876,50.28307],[53.21959,50.26298]
	                                       	]
	                                       ]',
			'[
	                                       	[
												[53.21021,50.11707],[53.18527,50.14643],[53.18135,50.10609],[53.17382,50.0709],[53.18052,50.07227],[53.19558,50.08789],[53.20444,50.10265],[53.21021,50.11707]
	                                       	]
	                                       ]',
		];
		$restorans = [1,2,5,6];
		foreach ($restorans as $restoran) {
			foreach ($data as $key => $item){
				$zone = new Zones();
				$zone->title = 'зона '.$key;
				$zone->time  = '60 мин';
				$zone->params= $item;
				$zone->restoran_id= $restoran;
				$zone->save();
			}
		}

	}

	public function down()
	{
		$this->dropTable('zones');
	}
}