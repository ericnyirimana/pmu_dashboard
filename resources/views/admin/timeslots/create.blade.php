@extends('admin.layouts.master')

@section('content')

    @include('components.fields-require-alert')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <a href="{{ route('timeslots.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">Indietro</a>
            </div>
        </div>
    </div>
    <tag-form file :action="route('timeslots.store')">

        @include('admin.timeslots.parts.form')

    </tag-form>

@endsection
