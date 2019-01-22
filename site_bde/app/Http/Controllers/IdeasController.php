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
        $likes = DB::table('idea')->select(DB::raw('idea_id, COUNT(idea_id) as idea_likes'))->join('link_member_idea_like', 'idea_id', '=', 'idea_id_fk')->groupBy('idea_id')->get();
        $links = $ideas->render();
        return view('ideas.ideas', compact("ideas", "links"));
    }

    public function display_idea($id){
        $idea = DB::table('idea')->where('idea_id', '=', $id)->get();
        $like = DB::table('idea')->select(DB::raw('idea_id, COUNT(idea_id) as idea_likes'))->join('link_member_idea_like', 'idea_id', '=', 'idea_id_fk')->groupBy('idea_id')->where('idea_id', '=', $id)->get();
        $verif_like = DB::table('idea')->join('link_member_idea_like', 'idea.idea_id', '=', 'link_member_idea_like.idea_id_fk')->where('idea_id', '=', $id)->get();
        return view('ideas.ideas_id', compact('idea', 'like', 'verif_like'));
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
