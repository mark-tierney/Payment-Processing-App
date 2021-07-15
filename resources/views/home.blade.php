@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header">Make a Payment</div>

                <div class="card-body">
    

                    <form action="{{ route('pay') }}" method="POST" id="paymentForm">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <label>How much would you like to pay?</label>
                                <input
                                    type="number"
                                    min="5"
                                    step="0.01"
                                    class="form-control bg-dark text-white "
                                    name="value"
                                    value="{{mt_rand(500,100000) / 100}}"
                                >   
                                <small class="form-text text-muted">
                                    Use values with up to two decimal positions, uusing a dot "."
                                </small>
                            </div>
                            <div class="col-auto">
                                <label>Currency</label>
                                <select name="currency" class="custom-select bg-dark text-white" required>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->iso }}">
                                            {{ strtoupper($currency->iso) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>
                                    Select desired payment method
                                </label>
                                <div class="form-group" id="toggler">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        @foreach ($paymentPlatforms as $paymentPlatform)
                                            <label 
                                                class="btn rounded m-1 p-2"
                                                data-target="#{{ $paymentPlatform->name }}Collapse"
                                                data-toggle="collapse"
                                            >
                                                <input 
                                                    type="radio"
                                                    name="payment_platform"
                                                    value="{{ $paymentPlatform->id }}"
                                                    required
                                                >
                                                <img class="img-thumbnail" src="{{ asset($paymentPlatform->image) }}">
                                            </label>
                                            
                                        @endforeach
                                    </div>
                                    @foreach ($paymentPlatforms as $paymentPlatform)
                                        <div
                                            id="{{ $paymentPlatform->name }}Collapse"
                                            class="collapse"
                                            data-parent="#toggler"
                                        >
                                            @includeIf('components.' . strtolower($paymentPlatform->name) . '-collapse')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <p class="border-bottom border-primary rounded">
                                    @if (! optional(auth()->user())->hasActiveSubscription())
                                        Subscribed users recieve a discount.
                                        <a href="{{ route('subscribe.show') }}">Subscribe</a>
                                    @else
                                        Recieve your <span class="font-weight-bold">10% price reduction</span> for being subscribed [applied at checkout].
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" id="payButton" class="btn btn-primary">Pay</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
