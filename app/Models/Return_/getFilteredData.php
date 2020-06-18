<?php

namespace App\Models\Return_;

use App\Models\Return_\Return_;

Class getFilteredData {

	public function __construct(){

	}

	public function execute(array $data): object {
		$query = Return_::select('returns.*','clients.name as clientname')
			   ->with(['user'])
			   ->leftjoin('clients','returns.client_id','=','clients.id')
			   ->approved();

		$query->when($data['datefrom'],function ($query) use ($data){
            $query->when($data['datefrom'] == $data['dateto'],
                function ($query) use ($data){
                    return $query->where('returns.datereturn',$data['datefrom']);
                },
                function ($query) use ($data){
                   return $query->WhereBetween('returns.datereturn',[$data['datefrom'],$data['dateto']]);
                }
             );
        });

        $query->when($data['refno'],function($query) use ($data){
        	return $query->where('returns.refNo',$data['refno']);
        });

        $query->when($data['deliveryno'],function($query) use ($data){
        	return $query->where('returns.dispatch_refno',$data['deliveryno']);
        });

        $query->when($data['client'],function($query) use ($data){
        	return $query->where('clients.name','LIKE','%'.$data['client'].'%');
        });

		return $query->get();

	}

}