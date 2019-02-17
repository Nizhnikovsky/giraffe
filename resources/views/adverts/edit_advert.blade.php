@extends('welcome')
@section('main-content')
    <edit-advert :result="{{json_encode($result)}}"></edit-advert>
@endsection

