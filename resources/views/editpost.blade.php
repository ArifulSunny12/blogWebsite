@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">

            
            
               

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!--profile container start-->
                    @foreach ($post as $allpost)

 

                      <!--new status post start-->
                      <div class="card card-body p-0">
                        <div class="card">
                            <h5 class="card-header">Update Post</h5>
                            <div class="card-body">
                                <form method="POST" action="/updatepost" enctype="multipart/form-data">
                                    @csrf
                                      <div class="form-row">
                                        <div class="form-group">
                                            <input type="text" class="form-control mb-2"  id="title" name="title" value="{{ $allpost->title }}"   required >
                                            <textarea class="form-control mb-1" style="min-height: 100px;" id="post" name="post" value="{{ $allpost->content }}"  ></textarea>
                                            <input type="hidden" class="form-control" value="{{ $allpost->user_id }}" id="user_id" name="user_id">
                                            <input type="hidden" class="form-control" value="{{ $allpost->id }}" id="post_id" name="post_id">
                                            
                                        </div>
                                      </div>

                                      <div class="form-row d-flex justify-content-start gap-2 mb-2">
                                        <div class="form-group col-md-6">
                                        <img src="{{ $allpost->image_path }}"  style="width:80%;">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                        <label for="file" class="col-form-label ">Change photo</label>
                                    
                                        <input type="file" class="form-control" id="post_image" name="post_image" placeholder="upload Image">
                                        </div>
                                      </div>





                                      <div class="form-row d-flex justify-content-evenly gap-2">
                                        <div class="form-group col-md-4">
                                        <a href="/deletepost/{{ $allpost->id }}" class="btn btn-primary col-12"> Delete Post </a>
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-primary col-12">Update Post </button>
                                        </div>
                                      </div>
                                </form>
                            </div>
                          </div>
                    </div>
                      <!--new status post end-->  
                      @endforeach         
                    <!--profile container end-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
