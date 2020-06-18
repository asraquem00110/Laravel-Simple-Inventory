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
			<td style="text-align: center;padding: 10px;font-size: 14pt;font-weight: bold;">INBOUND RECEIPT</td>
		</tr>
	</table>
	<br/>
	<table width="45%" class="border">
				<tr>
					<td style="width: 20%;background: #F8F8E7"><span>CLIENT'S NAME</span></td>
					<td style="width: 30%">{{$viewModel->inbound()->client->name}}</td>
					<td style="width: 20%;background: #F8F8E7;">CONTROL #</td>
					<td style="width: 30%">{{$viewModel->inbound()->controlNo}}</td>
				</tr>

				<tr>
					<td style="width: 20%;background: #F8F8E7"><span>DRIVER'S NAME</span></td>
					<td style="width: 30%">{{$viewModel->inbound()->driver}}</td>
					<td style="width: 20%;background: #F8F8E7;">DATE</td>
					<td style="width: 30%">{{date_format(date_create($viewModel->inbound()->unloadDate),'M d, Y')}}</td>
				</tr>

				<tr>
					<td style="width: 20%;background: #F8F8E7"><span>PLATE #</span></td>
					<td style="width: 30%">{{$viewModel->inbound()->plateNo}}</td>
					<td style="width: 20%;background: #F8F8E7;">UNLOADING TIME</td>
					<td style="width: 30%">{{date_format(date_create($viewModel->inbound()->unloadTime),'h:i a')}}</td>
				</tr>

				<tr>
					<td style="width: 20%;background: #F8F8E7"><span>CONTAINER #</span></td>
					<td style="width: 30%">{{$viewModel->inbound()->container}}</td>
					<td style="width: 20%;background: #F8F8E7;">TIME FINISHED</td>
					<td style="width: 30%">{{date_format(date_create($viewModel->inbound()-> finishUnloadTime),'h:i a')}}</td>
				</tr>

				<tr>
					<td style="width: 20%;background: #F8F8E7"><span>REFERENCE #</span></td>
					<td style="width: 30%">{{$viewModel->inbound()->refNo}}</td>
					<td style="width: 20%;background: #F8F8E7;">ORIGIN</td>
					<td style="width: 30%">{{$viewModel->inbound()->origin}}</td>
				</tr>

	</table>
	<br/>

	<table width="100%" class="border">
			<tr style="background: dimgray;color: white;">
				<td>DESCRIPTION</td>
				<td>ITEM CODE</td>
				<td>QTY</td>
				<td>UOM</td>
				<td>REMARKS</td>
			</tr>

			 @foreach($viewModel->inboundItemsSummary() as $tempitem)
                          <tr>
                            <td>{{$tempitem->item->description}}</td>
                            <td>{{$tempitem->item->productCode}}</td>
                            <td>{{$tempitem->quantity}}</td>
                            <td>{{$tempitem->item->unitMeasurement}}</td>
                            <td>{{$tempitem->remarks}}</td>
                          </tr>
                          @endforeach

	</table>

	<br/>
	
	<table class="border" width="100%">
		<tr>
			<td>RECEIVED BY: {{$viewModel->inbound()->receivedby}}</td>
			<td>CHECKED BY: {{$viewModel->inbound()->checkedby}}</td>
			<td>NOTED BY: {{$viewModel->inbound()->notedby}}</td>
		</tr>
	</table>

<!--   <div class="pagediv">Page <span class="pagenum"></span></div>
 -->
</body>
</html>