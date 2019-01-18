<?php

namespace App\Http\Controllers;

use App\Forms\ActivitiesForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

class ActivitiesController extends Controller
{
    //
	public function index(){
		$activities = DB::table('activity')->get();

        return view('activities.activities', compact("activities"));
	}

	public function create(FormBuilder $formbuilder){
		$form = $formbuilder->create(ActivitiesForm::class);
		return view('activities.activities_create', compact('form'));
	}

	public function create_check(){
		if(!empty($_POST)){

            DB::table('activity')->insert(
                array(
                    'activity_title' => $_POST['name'],
                    'activity_desc' => $_POST['description'],
                    'activity_date' => $_POST['date'],
                    'activity_img' => $_POST['image']
                )
            );
            return redirect(route('activities'));
        }
	}
}
