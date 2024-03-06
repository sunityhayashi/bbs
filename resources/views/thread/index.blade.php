<!DOCTYPE html>
<html lang="jp">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BBS</title>

    <!-- Global Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate/animate.min.css">
    <link rel="stylesheet" href="css/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl-carousel/owl.theme.default.min.css">


    <!-- Core Stylesheets -->
    <link rel="stylesheet" href="css/bbs.css">
  </head>

  <body id="page-top">


<!--====================================================
                  HEADER
======================================================-->
    <header class="text-center">
      <div class="container">
        <h1 class="wow fadeInUp" data-wow-delay="0.1s">BBS</h1>
      </div>
    </header>

<!--====================================================
                  NEW THREAD
======================================================--> 
<section id="new-thread">
      <div class="container">  
        <div class="wrapper row">
          <div class="col-md-12">
            <div id="new-thread-form">
              <form action="" method="post">
                @csrf
                <div class="form-group">
                  <h2> [new thread] </h2>
                  <br>
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="thread_title" id="thread_title" value="{{old('thread_title')}}"> 
                  @error('thread_title')
                    {{$message}}
                  @enderror
                <div class="form-group">
                  <label for="name">Your Name</label>
                  <input type="text" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}"> 
                  @error('first_name')
                    {{$message}}
                  @enderror
                </div>  
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea class="form-control" name="first_message" id="first_message" rows="3">{{old('first_message')}}</textarea>
                  @error('first_message')
                    {{$message}}
                  @enderror
                </div>  
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name = "first_password" id="first_password"> 
                  @error('first_password')
                    {{$message}}
                  @enderror
                </div>  
                <input type="submit" value="SUBMIT"  class="btn btn-general btn-white">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

<br>
<br>

<!--====================================================
                  THREADS
======================================================--> 
<h2> [threads] </h2>
<br>
@foreach ($threads as $thread)
    <h3 id="show_thread_{{$thread->id}}">[{{$thread->title}}]</h3>
<!--====================================================
                  COMMENTS
======================================================--> 
@foreach ($thread->comments as $comment)
  <h4> comments </h4>
        <div id="show_comment">message: {{$comment->message}}  date: {{$comment->created_at}} name: {{$comment->name}}</div>
        <div id="delete_comment">
            <form action="/thread/{{$thread->id}}/comment/{{$comment->id}}" method="POST">
                @csrf
                @method('delete')
                <label for="input_del_pass">password</label>
                <input type="password" id="input_del_pass" name="input_del_pass">
                @if(App\Helpers\Helper::is_delete_comment_id($comment->id))
                  @error("input_del_pass")
                    {{$message}}
                  @enderror
                @endif
                <br>
                <input type="submit" value="DELETE">
                <br>
            </form>
        </div>
@endforeach
<!--====================================================
                  NEW COMMENT
======================================================--> 
    <section id="new-comment">
      <div class="container">  
        <div class="wrapper row">
          <div class="col-md-12">
            <div id="new-comment-form">
              <form action="/thread/{{$thread->id}}/comment/" method="post">
                @csrf
                <div class="form-group">
                <p>new comment</p>
                  <label for="name">Your Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"> 
                  @if(App\Helpers\Helper::is_add_comment_thread_id($thread->id))  
                    @error('name')
                      {{$message}}
                    @enderror
                  @endif
                </div>  
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea class="form-control" name="message" id="message" rows="3">{{old('message')}}</textarea>
                  @if(App\Helpers\Helper::is_add_comment_thread_id($thread->id))  
                    @error('message')
                      {{$message}}
                    @enderror
                  @endif
                </div>  
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password"> 
                  @if(App\Helpers\Helper::is_add_comment_thread_id($thread->id))  
                    @error('password')
                      {{$message}}
                    @enderror
                  @endif
                </div> 
                <input type="submit" value="SUBMIT"  class="btn btn-general btn-white">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
<br>
<br>
@endforeach
{{$threads->links()}}

    <!--Global JavaScript -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/popper/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/wow/wow.min.js"></script>
    <script src="js/owl-carousel/owl.carousel.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery-easing/jquery.easing.min.js"></script> 
    
    <script src="js/custom.js"></script> 
    <div id="drag-area">

</div>
  </body>

</html>