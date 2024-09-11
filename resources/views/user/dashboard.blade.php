@extends('layouts2.app')
@section('content')
{{ Auth::user()->level->nama_level }}
@endsection
