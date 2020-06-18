<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{config('app.name')}}</title>

	<style type="text/css">
  body {
  font:"calibri";
  font-size:12px; 
  -webkit-print-color-adjust: exact;
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

.pagenum:before {
        content: counter(page);
}

div.pagediv {
	        position: absolute;
        bottom: -35px;
        left: 50%
}


</style>
<script type="text/javascript">
 // window.print() ;
</script>
</head>
<body>
		  <img src="{{ public_path('images/company/'.$viewModel->getCompanySetting()[1]->value.'') }}" style="height: 50px;width: 100px;" />
		<span style="font-size:12pt;float:right;">Inbound Report Daily From: {{date_format(date_create($field->datefrom),'M d, Y')}} To: {{date_format(date_create($field->dateto),'M d, Y')}}</span>
		<table class="border">

  				

  				@foreach($viewModel->getDateRange($field->datefrom,$field->dateto) as $date)
  					 @if(count($viewModel->getInboundLogs($date))>0 || count($viewModel->getInboundsData($date)) > 0)

  							<tr style="background: dimgray;color: white;">
  								<td colspan="9">{{date_format(date_create($date),'M d, Y')}}</td>
  							</tr>
                  @foreach($viewModel->getInboundsData($date) as $ib)
                  <tr style="background: #F2F2F2">
                    <td colspan="1">{{$ib->refNo}}</td>
                    <td colspan="8">{{$ib->client->name}}</td>
                  </tr>
                  <tr style="background: #D7F8D7;">
                    <td>Product</td>
                    <td>Barcode</td>
                    <td>Serial</td>
                    <td>Specs/Description</td>
                    <td>Qty</td>
                    <td>Unit</td>
                    <td>Remarks</td>
                    <td>Created By</td>
                    <td>Approved By</td>
                  </tr>

                    @foreach($ib->temp as $item)
                            <tr>
                              
                              <td>{{$item->item->description}}</td>
                              <td>{{$item->itemList->barcode}}</td>
                              <td>{{$item->itemList->serialNumber}}</td>
                              <td>{{$item->itemList->description}}</td>
                              <td>{{$item->quantity}}</td>
                              <td>{{$item->item->unitMeasurement}}</td>
                              <td>{{$item->itemList->remarks}}</td>
                              <td>{{$ib->user->name}}<br/><small>{{date_format(date_create($ib->created_at),"M d, Y h:i a")}}</small></td>
                              <td>{{$ib->approvedBy}}<br/><small>{{date_format(date_create($ib->ApprovedDateTime),"M d, Y h:i a")}}</small></td>
                            </tr>

                    @endforeach


                @endforeach
                    @if(count($viewModel->getInboundLogs($date))>0)
                        <tr style="background: #F8F8E7;">
                          <td colspan="9">LOGS</td>
                        </tr>
                      <tr style="background: #D7F8D7;">
                        
                        <td>Product</td>
                        <td>Barcode</td>
                        <td>Serial</td>
                        <td>Specs/Description</td>
                        <td>Qty</td>
                        <td>Unit</td>
                        <td>Remarks</td>
                        <td>Modified By</td>
                        <td></td>


                      </tr>
                            @foreach($viewModel->getInboundLogs($date) as $log)
                              <tr>
                                
                                <td>{{$log->item->description}}</td>
                                <td>{{$log->itemlist->barcode}}</td>
                                <td>{{$log->itemlist->serialNumber}}</td>
                                <td>{{$log->itemlist->description}}</td>
                                <td>{{($log->newvalue - $log->oldvalue)}}</td>
                                <td>{{$log->item->unitMeasurement}}</td>
                                <td>{{$log->remarks}}</td>
                                <td>{{$log->modifiedby}}<br/><small>{{date_format(date_create($log->created_at),"M d, Y h:i a")}}</small></td>
                                <td></td>
                              </tr>
                              @endforeach
                       

                        @endif
                        <tr>
                          <td colspan="9"></td>
                        </tr>

                        	@endif
  						@endforeach
  						

  					</table>

  					<div style="margin-top: 50px;font-size:10pt;">
  						PREPARED BY: {{Auth::User()->name}}
  						<br/>
  						DATE & TIME: {{ date('M d, Y h:i a',time())}}
  					</div>



<!-- <div class="pagediv">Page <span class="pagenum"></span></div>
 -->
</body>
</html>