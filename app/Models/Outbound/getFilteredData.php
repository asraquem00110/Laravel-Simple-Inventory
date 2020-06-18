<?php

namespace App\Models\Outbound;
use App\Models\Outbound\Outbound;

Class getFilteredData {

	public function __construct(){


	}

	public function execute(array $data): object{

		$query = Outbound::select('outbounds.*','clients.name as clientname')
			   ->with(['user'])
			   ->leftjoin('clients','outbounds.client_id','=','clients.id')
			   ->approved();

		$query->when($data['datefrom'],function ($query) use ($data){
            $query->when($data['datefrom'] == $data['dateto'],
                function ($query) use ($data){
                    return $query->where('outbounds.loadDate',$data['datefrom']);
                },
                function ($query) use ($data){
                   return $query->WhereBetween('outbounds.loadDate',[$data['datefrom'],$data['dateto']]);
                }
             );
        });

        $query->when($data['refno'],function($query) use ($data){
        	return $query->where('outbounds.refNo',$data['refno']);
        });

        $query->when($data['controlno'],function($query) use ($data){
        	return $query->where('outbounds.controlNo',$data['controlno']);
        });


        $query->when($data['client'],function($query) use ($data){
        	return $query->where('clients.name','LIKE','%'.$data['client'].'%');
        });

         $res = $query->get();

		return $res;
	}

}