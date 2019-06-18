@extends('layouts.app')


@section('content')

  
   <div class="container">
 	
   <div  class="row">
   	
      <div class="col-md-12">
      	
    
         	<h1>la liste de mes cv </h1>
         	 
               <hr>
              <div class = "float-right">
         	 	<a href="{{url('cvs/create')}}" class="btn btn-success" > Nouveau cv </a>
         	 </div>
              <hr>
              <div class="row">
               @foreach($cvs as $cv )

                <div class="col-sm-6  col-md-d">

                  <div class="thumbnaill">
                         <img src="{{asset('storage/'.$cv->photo)}}" alt="..." class="img-thumbnail">

                     <div class="caption">
                        <h1>{{$cv->titre}}</h1>
                        
                        
                           <a href="" class="btn btn-primary" role="button" > Show </a> 
                           <a href="{{url('cvs/'.$cv->id.'/edit')}}" class="btn btn-warning" role="button"> Editer </a>
                      
 
 
                       
                         <form action="{{url('cvs/'.$cv->id)}}" method="post"> 
                            {{csrf_field()}}
                            {{method_field('DELETE')}}

                         <button  type="submit" class="btn btn-danger"> Supprimer</button> 
                        </form>
                     
                     </div>
            
                   </div>

               </div>
               @endforeach
            </div>

  </div>
</div>
</div>


@endsection