<?php

namespace App\Models\Inbound;
use App\Models\Inbound\Inbound;

Class getFilteredData {

	public function __construct(){

	}

	public function execute(array $data): object{

		$query = Inbound::select('inbounds.*','clients.name as clientname')
			   ->with(['user'])
			   ->leftjoin('clients','inbounds.client_id','=','clients.id')
			   ->approved();

		$query->when($data['datefrom'],function ($query) use ($data){
            $query->when($data['datefrom'] == $data['dateto'],
                function ($query) use ($data){
                    return $query->where('inbounds.unloadDate',$data['datefrom']);
                },
                function ($query) use ($data){
                   return $query->WhereBetween('inbounds.unloadDate',[$data['datefrom'],$data['dateto']]);
                }
             );
        });

        $query->when($data['refno'],function ($query) use ($data){
            return $query->where('inbounds.refNo',$data['refno']);
        });

        $query->when($data['controlno'],function ($query) use ($data){
            return $query->where('inbounds.controlNo',$data['controlno']);
        });

        $query->when($data['client'],function ($query) use ($data){
            return $query->where('clients.name','LIKE','%'.$data['client'].'%');
        });

        $res = $query->get();

		return $res;
	}

}