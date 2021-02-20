

<div class="user-panel">
    <div class="pull-left image">
        @empty(Auth::user()->img_url)
        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="img-circle" alt="User Image">
        @else
        <img src="{{Auth::user()->img_url}}" class="img-circle" alt="User Image">
        @endempty

      
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->name}}</p>
      <a href="#"> {{Auth::user()->email}}</a>
    </div>
  </div>