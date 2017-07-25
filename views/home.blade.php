@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ Auth::user()->name }}<br />Employee ID - {{ Auth::user()->emp_id }}<br />Post - {{ Auth::user()->post }}
                </div>

                <div class="panel-body">
                    Hello
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
