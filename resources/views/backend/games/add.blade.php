@extends('backend.layouts.app')

@section('page-title', trans('app.add_game'))
@section('page-heading', trans('app.add_game'))

@section('content')

    <section class="content-header">
        @include('backend.partials.messages')
    </section>

    <section class="content">
        <div class="box box-danger">
            {!! Form::open(['route' => 'backend.game.store', 'files' => true, 'id' => 'user-form']) !!}
            <div class="box-header with-border">
                <h3 class="box-title">@lang('app.add_game')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    @include('backend.games.partials.base', ['edit' => false, 'profile' => false])
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    @lang('app.add_game')
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </section>

@stop
