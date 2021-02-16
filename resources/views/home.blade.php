@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="row">
                        <div class="col-4">
                            <select name="currency" class="form-control">
                                @foreach ($rates->keys() as $rate)
                                <option value="{{ $rate }}">{{ $rate }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="currency" class="form-control">
                                @foreach ($rates->keys() as $rate)
                                <option value="{{ $rate }}">{{ $rate }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    @foreach ($rates->keys() as $rate)

                    <table class="table">
                        <tr>
                            <th>Code</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td>{{ $rate }}</td>
                            <td>{{ $rate }}</td>
                        </tr>
                    </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
