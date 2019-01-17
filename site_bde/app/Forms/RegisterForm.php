<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RegisterForm extends Form
{
    public function buildForm()
    {
        $this->formOptions = [
            'method' => 'POST',
            'url' => route('register_check')
        ];

        $this
        ->add('first_name', 'text',[
            'rules'=>'required|min:1'
        ])
        ->add('last_name', 'text',[
            'rules'=>'required|min:1'
        ])
        ->add('location', 'text',[
            'rules'=>'required|min:1'
        ])
        ->add('email', 'email',[
            'rules'=>'required|min:1'
        ])
        ->add('password', 'password',[
            'rules'=>'required|min:1'
        ])
        ->add('submit', 'submit',[
            'label' => 'Sign up'
        ]);
    }
}
