<?php

namespace App\Http\Controllers;

use App\Forms\IdeasForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
    session_start();
}

class IdeasController extends Controller
{
    //
    public function create(FormBuilder $formbuilder){
        $form = $formbuilder->create(IdeasForm::class);
        return view('ideas.ideas_create', compact('form'));
    }

    public function index(){
        $ideas = DB::table('idea')->join('members', 'idea.member_id_fk', '=', 'members.member_id')->paginate(9);
        $links = $ideas->render();
        return view('ideas.ideas', compact("ideas", "links"));
    }

    public function ideas_ppage(){
        $ideas = DB::table('idea')->join('members', 'idea.member_id_fk', '=', 'members.member_id')->paginate($_POST['ppage']);
        return $ideas;
    }

    public function create_check(){
    	if(!empty($_POST)){

            DB::table('idea')->insert(
                array(
                    'idea_title' => $_POST['name'],
                    'idea_desc' => $_POST['description'],
                    'member_id_fk' => $_SESSION['id']
                )
            );
            return redirect(route('ideas'));
        }
    }
}
