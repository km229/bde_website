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
        ->add('first_name', 'text')
        ->add('last_name', 'text')
        ->add('location', 'text')
        ->add('email', 'text')
        ->add('password', 'password')
        ->add('submit', 'submit',[
            'label' => 'Sign up'
        ]);
}
}
