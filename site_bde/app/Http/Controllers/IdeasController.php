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
        $ideas = DB::table('idea')->join('members', 'idea.member_id_fk', '=', 'members.member_id');
        return view('ideas.ideas', compact("ideas"));

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
