<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form
{
    public function buildForm()
    {
        $this->formOptions = [
            'method' => 'POST',
            'url' => route('welcome')
        ];

        $this
            ->add('username', 'text')
            ->add('password', 'password')

            ->add('submit', 'submit',[
                'label' => 'Sign in'
            ]);
    }
}
