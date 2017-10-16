<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;
use UGCore\Http\Controllers\Controller;

class TutoriaController extends Controller
{
        public function index(){

    	return view('Titulacion/tutorias');
    }
 }