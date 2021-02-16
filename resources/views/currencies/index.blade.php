@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i><strong>Currencies and exchange rates</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered data-table" style="width:100%" >
                                <thead class="thead-light">
                                <tr id="">
                                <th>Currency</th>
                                <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rates as $rate)
                                    <tr>
                                        <td>{{ $rate['currency'] }}</td>
                                        <td>{{ $rate['price'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if( $currency)
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <strong>Set your currency</strong>
                    <span class="center"> </span>
                </div>
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('currencies.update', $currency->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('base_currency') ? ' has-error' : '' }} ">
                                <label class="col-form-label" for="base_currency">Base currency <span class="text-danger">*</span></label>
                                        <select class="form-control{{ $errors->has('base_currency') ? ' is-invalid' : '' }} " required="required" id="base_currency" name="base_currency" >
                                            <option value="" selected="selected">Select a base currency</option>
                                            @foreach ($base_rates as $rate)
                                            <option value="{{ $rate['currency'] }}"  @if($rate['currency'] == $currency->base_currency) selected="selected" @endif>{{ $rate['currency'] }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('base_currency'))
                                            <span class="text-danger">{{ $errors->first('base_currency') }}</span>
                                        @endif

                            </div>
                            <div class="form-group{{ $errors->has('user_currency') ? ' has-error' : '' }} ">
                                <label class="col-form-label" for="user_currency">User symbol currency <span class="text-danger">*</span></label>
                                        <select class="form-control{{ $errors->has('user_currency') ? ' is-invalid' : '' }} " required="required" id="user_currency" name="user_currency" >
                                            <option value="" selected="selected">Select a user symbol currency</option>
                                            @foreach ($base_rates as $rate)
                                            <option value="{{ $rate['currency'] }}"  @if($rate['currency'] == $currency->user_currency) selected="selected" @endif>{{ $rate['currency'] }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('user_currency'))
                                            <span class="text-danger">{{ $errors->first('user_currency') }}</span>
                                        @endif

                            </div>
                            <div class="form-group{{ $errors->has('notify') ? ' has-error' : '' }} ">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name='notify' id="customCheck" @if($currency->notify == 1) checked @endif name="notify" {{ old('notify') }}>
                                    <label class="custom-control-label" for="customCheck">Notify me when 1 {{ $currency->user_currency }} goes below {{ $base_currency[0]['price'] }} to {{ $currency->base_currency }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Save
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <strong>Set your currency</strong>
                    <span class="center"> </span>
                </div>
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('currencies.store') }}" method="POST" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('base_currency') ? ' has-error' : '' }} ">
                                <label class="col-form-label" for="base_currency">Base currency <span class="text-danger">*</span></label>
                                        <select class="form-control{{ $errors->has('base_currency') ? ' is-invalid' : '' }} " required="required" id="base_currency" name="base_currency" >
                                            <option value="" selected="selected">Select a base currency</option>
                                            @foreach ($rates as $rate)
                                            <option value="{{ $rate['currency'] }}">{{ $rate['currency'] }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('base_currency'))
                                            <span class="text-danger">{{ $errors->first('base_currency') }}</span>
                                        @endif

                            </div>
                            <div class="form-group{{ $errors->has('user_currency') ? ' has-error' : '' }} ">
                                <label class="col-form-label" for="user_currency">User symbol currency <span class="text-danger">*</span></label>
                                        <select class="form-control{{ $errors->has('user_currency') ? ' is-invalid' : '' }} " required="required" id="user_currency" name="user_currency" >
                                            <option value="" selected="selected">Select a user symbol currency</option>
                                            @foreach ($rates as $rate)
                                            <option value="{{ $rate['currency'] }}">{{ $rate['currency'] }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('user_currency'))
                                            <span class="text-danger">{{ $errors->first('user_currency') }}</span>
                                        @endif

                            </div>
                            <div class="form-group{{ $errors->has('notify') ? ' has-error' : '' }} ">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck" value="1"  name="notify" {{ old('notify') }}>
                                    <label class="custom-control-label" for="customCheck">Notify me when 1 ZAR goes above 0.0567106 EUR</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Save
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        @endif
    </div>
</div>


@endsection





@section('scripts')

<script type="text/javascript">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    $(document).ready(function () {
        $('.data-table').DataTable({processing: true,responsive: true, "order": [],"aaSorting": []});
        });

    </script>
@stop
