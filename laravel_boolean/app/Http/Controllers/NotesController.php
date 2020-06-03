<?php

namespace App\Http\Controllers;

use App\User;
use App\Page;
use Illuminate\Http\Request;
use Redirect;
use PDF;

class NotesController extends Controller
{

    public function index()
    {

    }

    public function pdf(){

        $data['title'] = 'Notes List';
             $data['pages'] =  Page::where('visible', 1)->orderBy('created_at', 'DESC')->paginate(15);

             $pdf = PDF::loadView('pdf', $data);

             return $pdf->download('Download.pdf');
    }


}
