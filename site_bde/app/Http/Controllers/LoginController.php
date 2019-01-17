<?php

namespace App\Http\Controllers;

use App\Forms\LoginForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class LoginController extends Controller
{

    public function index(FormBuilder $formbuilder){
        $form = $formbuilder->create(LoginForm::class);
        return view('login', compact('form'));
    }
}
