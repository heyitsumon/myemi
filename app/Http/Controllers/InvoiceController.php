<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class InvoiceController extends Controller
{


    public function getPdf()
    {



        $mpdf = new Mpdf();
    }
}
