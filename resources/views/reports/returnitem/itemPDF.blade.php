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
		<span style="font-size:12pt;float:right;">Return Report Per Item From: {{date_format(date_create($field->datefrom),'M d, Y')}} To: {{date_format(date_create($field->dateto),'M d, Y')}}</span>
	      
            <table class="border">
                        @foreach($items as $item)
                        @php $qty_total = 0 @endphp
                        <tr style="background: #F2F2F2;">
                          <td colspan="10">{{$item->description}} - {{$item->productCode}}</td>
                        </tr>

                          @if(count($viewModel->getReturn_PerItem($item->id,$field->datefrom,$field->dateto)) > 0)
                            <tr style="background: #D7F8D7;">
                          
                            <td width="10%">Date</td>
                            <td>RE RefNo</td>
                            <td>Site</td>
                            <td>Barcode</td>
                            <td>Serial</td>
                            <td>Specs/Description</td>
                            <td>Qty</td>
                            <td>Unit</td>
                            <td>Created By</td>
                            <td>Approved By</td>
                          </tr>

                              @foreach($viewModel->getReturn_PerItem($item->id,$field->datefrom,$field->dateto) as $reitem)
                                <tr>
                                  
                                  <td>{{date_format(date_create($reitem->datereturn),'M d, Y')}}</td>
                                  <td>{{$reitem->return->refNo}}</td>
                                  <td>{{$reitem->return->client->name}}</td>
                                  <td>
                                    @if($reitem->itemlist->freeStorage == 0)
                                    {{$reitem->itemlist->barcode}}
                                    @endif

                                  </td>
                                  <td>{{$reitem->itemlist->serialNumber}}</td>
                                  <td>{{$reitem->itemlist->description}}</td>
                                  <td>{{$reitem->qty}}</td>
                                  <td>{{$reitem->item->unitMeasurement}}</td>
                                  <td>{{$reitem->return->user->name}}<br/><small>{{date_format(date_create($reitem->return->created_at),"M d, Y h:i a")}}</small></td>
                                  <td>{{$reitem->return->approvedby}}<br/><small>{{date_format(date_create($reitem->return->ApprovedDateTime),"M d, Y h:i a")}}</small></td>
                                </tr>
                                  @php $qty_total += $reitem->qty; @endphp
                              @endforeach
                          @endif
                    
                            <tr>
                              <td colspan="6" align="right">TOTAL</td>
                              <td style="background: mistyrose;color: dimgray;">{{$qty_total}}</td>
                              <td style="background: mistyrose;color: dimgray;">{{$item->unitMeasurement}}</td>
                              <td></td>
                              <td></td>
                            </tr>

                            <tr>
                              <td colspan="10"></td>
                            </tr>
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