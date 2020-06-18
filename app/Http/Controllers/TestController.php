<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Item\ItemExport;
use Excel;

class TestController extends Controller
{
    public function index(){
    	return Excel::download(new ItemExport, 'item.xlsx');
    }
}
