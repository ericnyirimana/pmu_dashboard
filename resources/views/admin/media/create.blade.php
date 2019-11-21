@extends('admin.layouts.master')

@section('content')

<form class="row card-box" method="post" enctype="multipart/form-data" action="{{ route('media.store') }}">
      @csrf
      @include('admin.media.form')

</form>


@endsection
