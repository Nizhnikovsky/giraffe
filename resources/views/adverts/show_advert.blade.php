@extends('welcome')
@section('main-content')
    <one-advert :result="{{json_encode($result)}}"></one-advert>
@endsection
