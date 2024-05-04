@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                

                



<!-- dynamic post show section start-->
<div class="row">
@foreach ($posts as $allpost)
   <!-- <tr>
    <td>{{ $allpost->id }}</td>
    <td>{{ $allpost->user_id }}</td>
    <td>{{ $allpost->content }}</td>
    <td>{{ $allpost->image_path }}</td>
    <td>{{ $allpost->created_at }}</td>
    <td>{{ $allpost->updated_at }}</td>
   
    </tr> -->
    
    <!--public post div start-->
    <div class="row mb-3 ms-4">
    <!--left side start-->
        <div class="col-8">
        <!--Public post start-->
        <div class="card card-body p-0">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between gap-2 ">
                      
                      <div class="d-flex justify-content-start gap-2 ">
                        <img src="{{   $allpost->user->image }}"  style="border-radius: 25px; width:50px;">
                        <div class="form-group">
                        <h5 class="mb-0"> <p class="card-text mb-0"> {{ $allpost->user->username }}</p></h5>
                        <p class="card-text "><small class="text-body-secondary">{{ $allpost->updated_at }}</small></p>
                        </div>
                      </div>    
                      
                      <?php 
                    if($allpost->user_id ==Auth::user()->id){
                    ?>
                 
                      <div class="form-group">
                        <a class="btn btn-primary" href="/editpost/{{ $allpost->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Edit post
                        </a>
                      </div>

                      <?php } 
                     
                     else{}

                     ?>

                    </div>    
                </div>
                            
                <div class="card-body">

                    <div class="">
                        <h3 class="card-text ">
                        {{ $allpost->title }}
                        </h3>
                        <p class="card-text ">
                        {{ $allpost->content }}
                        </p>
                        <img src="{{ $allpost->image_path }}"  style="width:100%;">
                    </div>
                    

             
                    <!--show comment section start-->
                    @foreach ($allpost->comment as $comment)
                    <?php $user_image= App\Models\User::select('id','username','image')->where('id',$comment->user_id)->get(); ?>
                    
                    <div class="collapse show" id="collapseComment{{ $allpost->id }}">
                    <div class="d-flex justify-content-between gap-2 mt-2 " >

                    <div class="d-flex justify-content-start gap-2 mt-2 " >
                    <img src="{{$user_image[0]->image}}"  style="border-radius: 25px; width:50px; height:50px;">
                    <div class="form-group">
                    <h6 class="mb-0"> <p class="card-text fw-bolder mb-0"> {{$user_image[0]->username}}</p></h6>
                    <p class="card-text ">{{ $comment->content}} </p>
                    <small>{{ $comment->updated_at}} </small>
                    </div>
                    </div>
                    <?php 
                    if($user_image[0]->id==Auth::user()->id){
                    
                    
                    ?>
                      <!--delete/edit button start-->
                    <div class="d-flex justify-content-end gap-2 mt-2 " >
                          <div class="form-group ">
                            <a href="/deletecomment/{{ $comment->id}}" class="btn btn-primary col-12"> Delete </a>
                          </div>
                                        
                          <div class="form-group ">
                          
                          <button type="button" class="btn btn-primary editComment" 
                          value="{{ $comment->id}}"
                          >Edit</button>
                            

                            
                          </div>
                    </div>
                     <!--delete/edit button end-->

                     <?php } 
                     
                     else{}

                     ?>

                    </div>









                    </div>
                    @endforeach
                     <!--show comment section end-->
                    

                     <!--make comment start-->
                    <div class="mt-2">
                        <form method="POST" action="/postcomment" enctype="multipart/form-data">
                            @csrf                                      
                              <div class="form-row d-flex justify-content-between ">
                                <div class="form-group col-md-10">
                                <input type="text" class="form-control" id="comment" name="comment" placeholder="Type your comment">
                                <input type="hidden" class="form-control" value="{{Auth::user()->id }}" id="user_id" name="user_id">
                                <input type="hidden" class="form-control" value="{{ $allpost->id }}" id="post_id" name="post_id">
                                </div>
                                
                                <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-primary col-12">Post</button>
                                </div>
                              </div>
                            </form>
                    </div>
                    <!--make comment end-->            
                </div>
            </div>
        </div>
        <!--Public post end-->
    </div>
    <!--left side end-->

                        <!--right side start-->
                        <div class="col-4"></div>
                        <!--right side end-->
                    </div>
    <!--public post div end-->
    @endforeach
</div>
<!-- dynamic post show section end -->



                      
                      
                    <!--profile container end-->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="editCommentModalLabel" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <!--update comment start-->
      <form id="updateStudent" method="POST" action="/updatecomment">
      @csrf
        
            
            <input type="hidden" class="form-control" value="{{Auth::user()->id }}" id="user_id" name="user_id">
            <input type="hidden" class="form-control" value="" id="comment_id" name="comment_id">
            <input type="text" class="form-control" value="" id="comment_edit" name="comment_edit" >
        
        <div class="modal-footer">
            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
      <!--update comment end-->
      </div>
      
    </div>
  </div>
</div>

<script type="text/javascript">
 $(document).ready(function(){
   $(document).on('click', '.editComment', function(){

    var comment_id= $(this).val(); // get comment id
   // var comment= $(this).val();// get comment

    
    $('#editCommentModalLabel').modal('show');//load modal


  // alert(comment_id);

    $.ajax({
      type:"GET",
      url:"/editcomment/"+comment_id,
      success: function(response){
       // console.log(response.comment.content);
       
       $('#comment_edit').val(response.comment.content);
       $('#comment_id').val(comment_id);
      }
    });
   
    

   });

  });

 </script>
@endsection
