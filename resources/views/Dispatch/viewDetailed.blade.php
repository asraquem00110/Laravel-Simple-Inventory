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
 // window.print()
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
      <td style="text-align: center;padding:10px;font-size: 14pt;font-weight: bold;">DELIVERY RECEIPT</td>
    </tr>
  </table>
  <br/>
  <table class="noborder" width="100%">
    <tr>
      <td width="15%">Delivered To:</td>
      <td width="45%" style="border-bottom: 2px solid gray;margin:0;padding:0">{{$viewModel->dispatch()->client->name}}</td>
      <td width="15%">Date:</td>
      <td width="25%" style="border-bottom: 2px solid gray">{{date_format(date_create($viewModel->dispatch()->date),'M d, Y')}}</td>
    </tr>

       <tr>
      <td width="15%">TIN:</td>
      <td width="45%" style="border-bottom: 2px solid gray;margin:0;padding:0">{{$viewModel->dispatch()->tin}}</td>
      <td width="15%">Ref No:</td>
      <td width="25%" style="border-bottom: 2px solid gray">{{$viewModel->dispatch()->refNo}}</td>
    </tr>

       <tr>
      <td width="15%">Address:</td>
      <td width="45%" style="border-bottom: 2px solid gray;margin:0;padding:0">{{$viewModel->dispatch()->address}}</td>
      <td width="15%">Control No:</td>
      <td width="25%" style="border-bottom: 2px solid gray">{{$viewModel->dispatch()->controlno}}</td>
    </tr>


  </table>
  <br/>

  <table class="border" width="100%">
    <tr style="background: dimgray;color:white;">
      <td width="15%;">QTY</td>
      <td width="15%;">UNIT</td>
      <td>DESCRIPTION</td>
    </tr>
               @foreach($viewModel->ItemsSummary() as $item)
                              <tr>
                                <td width="10%">{{$item->quantity}}</td>
                                <td><!-- {{$viewModel->itemInfo($item->item_id)->unitMeasurement}} -->{{$item->uom}}</td>
                                <td><span style="font-weight: bold;">{{$viewModel->itemInfo($item->item_id)->description}}</span> / {{$viewModel->itemInfo($item->item_id)->productCode}}</td>
                              </tr>

                              @if($itemlist = $viewModel->getItemlist($item->item_id))

                                  @foreach($itemlist as $iteml)
                                    @if($iteml->itemlist_id == NULL)
                                       <tr style="background: #F2F2F2">
                                        <td></td>
                                        <td><small>{{$iteml->qty.' '.$iteml->uom}}</small></td>
                                        <td><small>DESCRIPTION: {{ $iteml->item->description}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BARCODE: none&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SERIAL NO: none</small></td>
                                      </tr>
                                    @else
                                      <tr style="background: #F8F8E7">
                                        <td></td>
                                        <td><small>{{$iteml->qty.' '.$iteml->uom}}</small></td>
                                        <td><small>DESCRIPTION: {{ $iteml->item->description}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BARCODE: {{$iteml->itemlist->barcode}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SERIAL NO: {{$iteml->itemlist->serialNumber}}</small></td>
                                      </tr>
                                    @endif
                                  @endforeach

                              @endif

                              @endforeach

  </table>

  <br/>


  <table class="noborder" width="100%">
    <tr>
    <td width="50%"></td>
    <td width="50%"><small style="font-size:9pt;">Received the above goods and services in good order and conditions</small></td>
  </tr>
    <tr>
      <td></td>
      <td style="border-bottom: 2px solid gray;">BY: </td>
    </tr>
    <tr>
    <td width="50%"></td>
    <td width="50%" style="text-align:center;"><small style="font-size:9pt;">Cashier/Authorized Representative</small></td>
  </tr>
  </table>






  <!--   <div class="pagediv">Page <span class="pagenum"></span></div>
 -->
</body>
</html>