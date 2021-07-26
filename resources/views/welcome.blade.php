@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark text-white">
                <div class="card-header">Payment Process App</div>

                <div class="card-body">
                    <p>This is a payment processing system implemented using Laravel PHP and sqlite. Users can register, login, make payments and subscribe to monthly or yearly payments in multiple currencies using Stripe or Paypal. This app was developed by Mark L Tierney for demonstration purposes.</p>
                    <a href="https://github.com/mark-tierney/Payment-Processing-App" target="_blank" class="btn btn-success"><i class="bi bi-github" ></i> Github</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
