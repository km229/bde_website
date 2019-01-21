<?php

namespace App\Http\Controllers;

use App\Forms\ActivitiesForm;
use App\Forms\ActivitiesIdForm;
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

            //dd($_FILES);

        DB::table('activity')->insert(
            array(
                'activity_title' => $_POST['name'],
                'activity_desc' => $_POST['description'],
                'activity_date' => $_POST['date'],
                'activity_img' => file_get_contents($_FILES['image']['tmp_name'])
            )
        );
        return redirect(route('activities'));
    }
}

public function id($id, FormBuilder $formbuilder){
    $form = $formbuilder->create(ActivitiesIdForm::class);
    return view('activities.activities_create', compact('form'));
}
}
