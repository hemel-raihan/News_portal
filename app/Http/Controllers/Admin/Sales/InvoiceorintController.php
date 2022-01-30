<?php

namespace App\Http\Controllers\Admin\Sales;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceorintController extends Controller
{
    public function invoice_download($id)
    {
        $order = Order::findOrFail($id);
        return PDF::loadView('backend.invoices.invoice',[
            'order' => $order,
        ], [], [])->download('order-'.$order->code.'.pdf');
    }
}
