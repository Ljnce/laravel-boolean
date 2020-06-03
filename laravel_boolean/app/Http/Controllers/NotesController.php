<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use PDF;

use App\Page;

class NotesController extends Controller
{

    public function pdf(){

        $data['title'] = 'Notes List';
        $data['pages'] =  Page::where('visible', 1)->orderBy('created_at', 'DESC')->paginate(15);

        $pdf = PDF::loadView('pdf', $data);

        return $pdf->download('Download.pdf');
    }

}
