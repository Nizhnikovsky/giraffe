@extends('welcome')
@section('main-content')
    <create-advert :result="{{json_encode($result)}}"></create-advert>
@endsection
