<?php

namespace App\Exports\Item;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ItemExport implements FromView,ShouldAutoSize
{
  
   public function view(): View
    {
        return view('exports.item.index');
    }
}
