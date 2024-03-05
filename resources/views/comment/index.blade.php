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
                  COMMENTS
======================================================--> 
@foreach ($comments as $comment)
  <h4> comments </h4>
        <div id="show_comment">message: {{$comment->message}}  date: {{$comment->created_at}} name: {{$comment->name}} password: {{$comment->password}}</div>
        <div id="delete_comment">
          <a pref="thread/{{$thread_id}}/comment/{{$comment->id}}">delete</a>
            <form action="comment/{{$comment->id}}" method="POST">
                @csrf
                @method('delete')
                <label for="input_del_pass">password</label>
                <input type="password" id="input_del_pass_{{$comment->id}}" name="input_del_pass_{{$comment->id}}">
                @error("input_del_pass_".$comment->id)
                  {{$message}}
                @enderror
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
              <form action="" method="post">
                @csrf
                <div class="form-group">
                <p>new comment</p>
                  <label for="name">Your Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"> 
                    @error('name')
                      {{$message}}
                    @enderror
                </div>  
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea class="form-control" name="message" id="message" rows="3">{{old('message')}}</textarea>
                    @error('message')
                      {{$message}}
                    @enderror
                </div>  
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password"> 
                    @error('password')
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