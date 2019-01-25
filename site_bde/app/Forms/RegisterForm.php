<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;

class RegisterForm extends Form
{
    public function buildForm()
    {
        $this->formOptions = [
            'method' => 'POST',
            'url' => route('register_check'),
            'id' =>'form_register'
        ];

        $db = DB::table('location')->get();
        $array = [];
        foreach($db as $choice){
            $array[] = $choice;

        }
        $table = [];

        for($i = 0; $i < sizeof($array); $i++){
            $table[] =  $array[$i] -> location_center;
        }

        $this
        ->add('first_name', 'text',[
            'rules'=>'required|min:1'
        ])
        ->add('last_name', 'text',[
            'rules'=>'required|min:1'
        ])
        ->add('location', 'choice',[
            'choices' => $table
        ])
        ->add('email', 'email',[
            'rules'=>'required|min:1|email'
        ])
        ->add('password', 'password',[
            'rules'=>'required|min:1|regex:(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}'
        ])
        ->add('submit', 'submit',[
            'label' => 'Sign up'
        ]);
    }
}
