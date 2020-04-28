@extends('admin.layouts.master')

@section('content')

    @include('components.fields-require-alert')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <a href="{{ route('showcases.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
            </div>
        </div>
    </div>
    <tag-form :action="route('showcases.update', $showcase)" method="put" >
        @include('admin.showcases.parts.form')
    </tag-form>
@endsection
