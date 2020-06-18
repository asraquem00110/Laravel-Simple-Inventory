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
  //window.print() ;
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
			<td style="text-align: center;padding: 10px;font-size: 14pt;font-weight: bold;">RETURN RECEIPT</td>
		</tr>
	</table>
	<br/>
	<table class="border">
		<tr>
			<td style="width: 20%;background: #F8F8E7">SITE</td>
			<td style="width: 30%">{{$viewModel->getReturn()->client->name}}</td>
			<td style="width: 20%;background: #F8F8E7">REF #</td>
			<td style="width: 30%">{{$viewModel->getReturn()->refNo}}</td>
		</tr>

		<tr>
			<td style="width: 20%;background: #F8F8E7">DATE RETURN</td>
			<td style="width: 30%">{{ date_format(date_create($viewModel->getReturn()->datereturn),'M d, Y')}}</td>
			<td style="width: 20%;background: #F8F8E7">DELIVER REF #</td>
			<td style="width: 30%">{{$viewModel->getReturn()->dispatch_refno}}</td>
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

                             @foreach($viewModel->ItemsSummary() as $item)
                          @php $iteminfo = $viewModel->itemInfo($item->item_id); @endphp
                          <tr>
                            <td>{{$iteminfo->description}}</td>
                            <td>{{$iteminfo->productCode}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->uom}}</td>
                            <td></td>
                          </tr>
                          @endforeach
		                
		     </table>

	
		     <br/>

		     <table width="100%" class="border">
		     	<tr>
		     		<td style="width: 20%;background: #F8F8E7">CREATED BY:</td>
		     		<td style="width=30%">{{$viewModel->getReturn()->user->name}}<br/><small>{{ date_format(date_create($viewModel->getReturn()->created_at),'M d, Y h:i a') }}</small></td>
		     		<td style="width: 20%;background: #F8F8E7">PREPARED BY:</td>
		     		<td style="width=30%">{{Auth::User()->name}}<br/><small>{{date('M d, Y h:i a',time())}}</small></td>
		     	</tr>

		     </table>


<!--   <div class="pagediv">Page <span class="pagenum"></span></div>
 -->

</body>
</html>