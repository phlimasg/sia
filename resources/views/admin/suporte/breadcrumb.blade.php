
@php
$aux = null;    
@endphp
<ul class="breadcrumb">
    @for ($i = 0; $i < sizeof(Request::segments()); $i++)
        @php($aux .= Request::segment($i).'/')
        <li class="breadcrumb-item"><a href="{{ url($aux) }}">{{Request::segment($i)}}</a></li>
    @endfor
  </ul>