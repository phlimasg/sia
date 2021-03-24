@extends('tv.parcial.layout')
@section('content')

<video id="my-player" class="video-js">
    <source src="http://dev2-new.abel.org.br/tv/abel/videos/9526273211569445775.mp4" type="video/mp4" />    
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>

<!--
    <div class="carousel slide" data-ride="carousel">
    
    <ul class=" carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>

    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="http://dev2-new.abel.org.br/tv/abel/images/8724720991555426691.jpg" alt="Los Angeles" width="100%"
                height="150px">
        </div>
        <div class="carousel-item">
            <img src="http://dev2-new.abel.org.br/tv/abel/images/8724720991555426691.jpg" alt="Chicago" width="100%"
                height="150px">
        </div>
        <div class="carousel-item">
            <img src="http://dev2-new.abel.org.br/tv/abel/images/8724720991555426691.jpg" alt="New York" width="100%"
                height="150px">
        </div>
    </div>

</div>
<img src="http://dev2-new.abel.org.br/tv/abel/images/8724720991555426691.jpg" alt="" srcset="" width="100%">-->
@endsection

@section('css')
<style>
    /* Make the image fully responsive */
    .carousel-inner img {
        width: 100%;
        height: 250px;
    }

</style>
@endsection

@section('js')
<script>
    videojs('my-player', {
        controls: true,
        preload: 'auto',
        autoplay: true,
        width: '450',        
    });
</script>
@endsection
