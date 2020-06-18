<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{config('app.name')}}</title>

	<style type="text/css">
  body {
  font:"Calibri";
  font-size:12px; 
}

table.border td, th {
    border: 1px solid gray;
    height: 20px;
   /* font-family: tahoma; */
  }
  
table.border {
    border-collapse: collapse;
    width: 100%;
  }
  
table.noborder td, th {
    border: 0;
    font-size: 11pt;
  }

tr.top td {
  border-top: thin solid black;
}

tr.bottom td {
  border-bottom: thin solid black;
}

tr td {
	padding: 5px;
}

tr td,{
	font-size: 10pt;
	font-weight: normal;
}

/*span {
	font-size: 10pt;
}
*/
/*@page {
    size: 35.7cm 25cm;
    margin: 5mm 10mm 5mm 10mm;
}*/

tr {page-break-inside:avoid; page-break-after: auto;}
thead {display: table-header-group;}
tfoot {display: table-footer-group;}
div {page-break-inside: avoid;}

</style>
<script type="text/javascript">
 // window.print() ;
</script>
</head>
<body>
		<div style="text-align: center;margin-bottom: 20px;">
	 <img src="{{ public_path('images/company/'.$viewModel->getCompanySetting()[1]->value.'') }}" style="height: 50px;width: 100px;position: absolute;" />
	<span style="font-weight: bold;font-size: 14pt;">{{$viewModel->getCompanySetting()[0]->value}}</span><br/>
	<small>{{$viewModel->getCompanySetting()[2]->value}}</small>
	</div>
	<table width="100%" class="">
		<tr style="background: #F2F2F2;">
			<td style="text-align: center;padding: 10px;font-size: 14pt;font-weight: bold;">OUTBOUND RECEIPT</td>
		</tr>
	</table>


	<br/>

	<table class="border">
		<tr>
			<td style="width: 20%;background: #F8F8E7"><span>CLIENT'S NAME</span></td>
			<td style="width: 30%">{{$viewModel->outbound()->client->name}}</td>
			<td style="width: 20%;background: #F8F8E7;">CONTROL #</td>
			<td style="width: 30%">{{$viewModel->outbound()->controlNo}}</td>
		</tr>
			<tr>
			<td style="width: 20%;background: #F8F8E7"><span>DRIVER'S NAME</span></td>
			<td style="width: 30%">{{$viewModel->outbound()->driver}}</td>
			<td style="width: 20%;background: #F8F8E7;">DATE</td>
			<td style="width: 30%">{{date_format(date_create($viewModel->outbound()->loadDate),'M d, Y')}}</td>
		</tr>
			<tr>
			<td style="width: 20%;background: #F8F8E7"><span>PLATE NO</span></td>
			<td style="width: 30%">{{$viewModel->outbound()->plateNo}}</td>
			<td style="width: 20%;background: #F8F8E7;">TIME OF LOADING</td>
			<td style="width: 30%">{{date_format(date_create($viewModel->outbound()->loadTime),'h:i a')}}</td>
		</tr>
			<tr>
			<td style="width: 20%;background: #F8F8E7"><span>CONTAINER NO</span></td>
			<td style="width: 30%">{{$viewModel->outbound()->container}}</td>
			<td style="width: 20%;background: #F8F8E7;">TIME ENDED</td>
			<td style="width: 30%">{{date_format(date_create($viewModel->outbound()->finishloadTime),'h:i a')}}</td>
		</tr>
			<tr>
			<td style="width: 20%;background: #F8F8E7"><span>REFERENCE NO</span></td>
			<td style="width: 30%">{{$viewModel->outbound()->refNo}}</td>
			<td style="width: 20%;background: #F8F8E7;">DESTINATION</td>
			<td style="width: 30%">{{$viewModel->outbound()->destination}}</td>
		</tr>
	</table>
	<br/>

	<table width="100%" class="border">
			       	
			       			<tr style="background: dimgray;color:white;">
                              <td>DESCRIPTION</td>
                              <td>ITEM CODE</td>
                              <td>QTY</td>
                              <td>UOM</td>
                              <td></td>
                            
                            </tr>
                  
			 @foreach($viewModel->outboundItemsSummary() as $item)
                          <tr>
                            <td>{{$item->item->description}}</td>
                            <td>{{$item->item->productCode}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->item->unitMeasurement}}</td>
                            <td></td>
                          </tr>

                            @if($item->item->outbounditems[0]->itemlist->freeStorage == 0)
                           		 <tr style="background: #F8F8E7">  
                                  <td><span style="font-size:8pt;margin-left: 30px;font-weight: bold;">Barcode</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">SerialNumber</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Description/Specs</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Qty</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Remarks</span></td>
                                </tr>
                              @foreach($viewModel->getOutboundItems($item->item_id,$viewModel->outbound()->id) as $item)
                                    <tr>
                                    <td><span style="font-size: 8pt;margin-left: 30px;">{{$item->itemlist->barcode}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->itemlist->serialNumber}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->itemlist->description}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->quantity.' '.$item->item->unitMeasurement}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->remarks}}</span></td>
                                  </tr>

                              @endforeach

                            @endif
               @endforeach

	</table>

	<br/>

		<table width="100%" class="">
		<tr style="background: #F2F2F2;">
			<td style="text-align: center;font-size: 10pt;font-weight: bold;">RECEIVED THE ABOVE ITEMS IN COMPLETE AND IN GOOD CONDITION</td>
		</tr>
	</table>

	<br/>

	<table class="border" width="100%">
		<tr>
			<td  width="33%">PREPARED BY: {{$viewModel->outbound()->preparedby}}<br/><small>{{date_format(date_create($viewModel->outbound()->created_at),'M d, Y h:i a')}}</small></td>
			<td  width="33%">CHECKED BY: {{$viewModel->outbound()->checkedby}}</td>
			<td  width="33%">GUARD ON DUTY: </td>
		</tr>

		<tr>
			<td>APPROVED BY: {{$viewModel->outbound()->approvedby}}<br/><small>{{date_format(date_create($viewModel->outbound()->ApprovedDateTime),'M d, Y h:i a')}}</small></td>
			<td>SIGNATURE:</td>
			<td>DATE:</td>
		</tr>

		<tr>
			<td>RECEIVED BY: {{$viewModel->outbound()->recievedby}}</td>
			<td>SIGNATURE:</td>
			<td>DATE:</td>
		</tr>
	</table>




</body>
</html>