<?php

namespace App\Http\Controllers;

use App\Forms\IdeasForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class IdeasController extends Controller
{
    //
    public function create(FormBuilder $formbuilder){
        $form = $formbuilder->create(IdeasForm::class);
        return view('ideas_create', compact('form'));
    }

    public function index(){
    	return view('ideas');
    }
}
