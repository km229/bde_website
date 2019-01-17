<?php

namespace App\Http\Controllers;

use App\Forms\IdeasForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

class IdeasController extends Controller
{
    //
    public function create(FormBuilder $formbuilder){
        $form = $formbuilder->create(IdeasForm::class);
        return view('ideas.ideas_create', compact('form'));
    }

    public function index(){
    	return view('ideas.ideas');
    }

    public function create_check(){
    	if(!empty($_POST)){

            DB::table('idea')->insert(
                array(
                    'idea_title' => $_POST['name'],
                    'idea_desc' => $_POST['description']
                )
            );
            return redirect(route('ideas'));
        }
    }
}
