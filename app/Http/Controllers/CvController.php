<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Cv;
use App\Http\Requests\cvRequest;
use Auth;

class CvController extends Controller
{

   public function __construct(){

   	$this->middleware('auth');

   }







	//lister les cv 
    public function index(){
      
    	if(Auth::user()->is_admin)
    	{

    		$listcv=Cv::all();
    	}else{

          	$listcv= Auth::user()->cvs;


    	}


    
        return view('cv.index', ['cvs' => $listcv]);


    }

   // affiche le formulaire de creation d'un cv 
   public function create(){

      return view('cv.create');
   }
   
   //enregistre un cv 
    public function store(cvRequest $request){

    $cv= new Cv();
    $cv->titre=$request->input('titre');
   	$cv->presentation=$request->input('presentation');
    $cv->user_id=Auth::user()->id;
    if($request->hasFile('photo')){
    	$cv->photo=$request->photo->store('image');
    }


   	$cv->save();
   	
   	session()->flash('success','le cv a été bien enregistre');
      return redirect('cvs');

   }
   

   //permet de recuperer un cv puis de le mettre dans un le formulaire  
    public function edit($id){
    	$cv= Cv::find($id);
         $this->authorize('update',$cv);
    	return view('cv.edit', ['cv' => $cv]);


   }


   //permet de modifier un cv 
    public function update(cvRequest $request,$id){

    	$cv= Cv::find($id);

    	$cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');

          if($request->hasFile('photo')){
    	$cv->photo=$request->photo->store('image');
          }



        $cv->save();
        return redirect('cvs');
   }


   //permet de supprimer un cv 
    public function destroy(Request $request, $id){

      $cv= Cv::find($id);
      $cv->delete();

      return redirect('cvs');



   }








}
