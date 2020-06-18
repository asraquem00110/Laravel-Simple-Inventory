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
		<span style="font-size:12pt;float:right;">Inbound Report Per Site From: {{date_format(date_create($field->datefrom),'M d, Y')}} To: {{date_format(date_create($field->dateto),'M d, Y')}}</span>
	         <table class="border">

                  
                    @foreach($sites as $site)
                      <tr style="background: #F2F2F2;">
                        <td colspan="11">{{$site->name}}</td>
                      </tr>
                          @if(count($viewModel->getInbound_PerSite($site->id,$field->datefrom,$field->dateto))>0)
                             <tr style="background: #D7F8D7;">
                        
                                <td width="10%;">Date</td>
                                <td>IB RefNo</td>
                                <td>Item</td>
                                <td>ProductCode</td>
                                <td>Barcode</td>
                                <td>Serial</td>
                                <td>Specs/Description</td>
                                <td>Qty</td>
                                <td>Unit</td>
                                <td>Created By</td>
                                <td>Approved By</td>
                              </tr>
                               @foreach($viewModel->getInbound_PerSite($site->id,$field->datefrom,$field->dateto) as $inbound)
                                @foreach($inbound->temp as $ibitem)
                                    <tr>
                                    
                                      <td>{{date_format(date_create($inbound->unloadDate),'M d, Y')}}</td>
                                      <td>{{$inbound->refNo}}</td>
                                      <td>{{$ibitem->item->description}}</td>
                                      <td>{{$ibitem->item->productCode}}</td>
                                      <td>{{$ibitem->itemlist->barcode}}</td>
                                      <td>{{$ibitem->itemlist->serialNumber}}</td>
                                      <td>{{$ibitem->itemlist->description}}</td>
                                      <td>{{$ibitem->quantity}}</td>
                                      <td>{{$ibitem->item->unitMeasurement}}</td>
                                      <td>{{$inbound->user->name}}<br/><small>{{date_format(date_create($inbound->created_at),"M d, Y h:i a")}}</small></td>
                                      <td>{{$inbound->approvedBy}}<br/><small>{{date_format(date_create($inbound->ApprovedDateTime),"M d, Y h:i a")}}</small></td>
                                    </tr>

                                @endforeach
                              @endforeach


                          @endif

                          <tr>
                            <td colspan="11"></td>
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