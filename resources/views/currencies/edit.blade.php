@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-md-6">


<div class="container">
    <div class="card">
        <div class="card-header">
            {{--  <strong>Create artitle</strong>  --}}
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
                        <label class="col-form-label" for="base_currency">base_currency <span class="text-danger">*</span></label>
                                <select class="form-control{{ $errors->has('base_currency') ? ' is-invalid' : '' }} " required="required" id="base_currency" name="base_currency" >
                                    <option value="">Select a base_currency</option>
                                    @foreach ($rates->keys() as $rate)
                                    <option value="{{ old('base_currency',$currency->base_currency) }}"  @if($rate == $currency->base_currency) selected="selected" @endif>{{ $rate }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('base_currency'))
                                    <span class="text-danger">{{ $errors->first('base_currency') }}</span>
                                @endif

                    </div>
                    <div class="form-group{{ $errors->has('user_currency') ? ' has-error' : '' }} ">
                        <label class="col-form-label" for="user_currency">user_currency <span class="text-danger">*</span></label>
                                <select class="form-control{{ $errors->has('user_currency') ? ' is-invalid' : '' }} " required="required" id="user_currency" name="user_currency" >
                                    <option value="" >Select a user_currency</option>
                                    @foreach ($rates->keys() as $rate)
                                    <option value="{{ old('base_currency',$currency->user_currency) }}"  @if($rate == $currency->base_currency) selected="selected" @endif>{{ $rate }}</option>
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
</div>
</div>
@endsection
