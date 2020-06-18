<?php

namespace App\Models\Dispatch;

use App\Models\Dispatch\Dispatch;

Class getDeliveryData {

	public function __construct(){

	}

	public function execute(array $data): object{
		$query = Dispatch::select('dispatches.*','clients.name as clientname')
			   ->with(['user'])
			   ->leftjoin('clients','dispatches.client_id','=','clients.id')
			   ->approved();

		$query->when($data['datefrom'],function ($query) use ($data){
            $query->when($data['datefrom'] == $data['dateto'],
                function ($query) use ($data){
                    return $query->where('dispatches.date',$data['datefrom']);
                },
                function ($query) use ($data){
                   return $query->WhereBetween('dispatches.date',[$data['datefrom'],$data['dateto']]);
                }
             );
        });

        $query->when($data['refno'],function($query) use ($data){
        	return $query->where('dispatches.refNo',$data['refno']);
        });

        $query->when($data['controlno'],function($query) use ($data){
        	return $query->where('dispatches.controlno',$data['controlno']);
        });


        $query->when($data['client'],function($query) use ($data){
        	return $query->where('clients.name','LIKE','%'.$data['client'].'%');
        });
			 

		return $query->get();
	}

}