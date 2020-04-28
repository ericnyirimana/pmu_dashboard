@extends('admin.layouts.master')

@section('content')

<div class="row m-b-10">
    <div class="col-md-8 col-lg-12">
          <h2>{{ $user->name }}</h2>
    </div>
    <div class="col-12">
        <tag-form file :action="route('users.update', [$user])" method="put">
            @include('admin.users.parts.form')
        </tag-form>
    </div>
</div>

@endsection
