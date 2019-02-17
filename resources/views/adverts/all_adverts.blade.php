@extends('welcome')
@section('main-content')
<all-adverts :result="{{json_encode($result)}}"></all-adverts>
@endsection
