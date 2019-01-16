<?php

namespace App\Http\Controllers;

use App\Forms\RegisterForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class RegisterController extends Controller
{
    public function index(FormBuilder $formbuilder){
        $form = $formbuilder->create(RegisterForm::class);
        return view('register', compact('form'));
    }
}
