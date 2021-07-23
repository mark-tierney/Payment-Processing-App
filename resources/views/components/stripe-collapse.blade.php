@push('styles')
<style type="text/css">
    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        

        border: 1px solid white;
        border-radius: 4px;

    }

</style>
@endpush
<label class="mt-3" for="card-element">
    Card details: 
</label>

<div id="cardElement"></div>

<small class="form-text text-muted" id="cardErrors" role="alert"></small>

<div class="alert alert-info">
    <p><i>Use a stripe test card: </i>
        </br> &nbsp; No authentication: &ensp; &nbsp; <b>4242 4242 4242 4242 </b> 02/22 222 22222 
        </br> &nbsp; 3d secure: &emsp; &emsp; &emsp; &ensp; &nbsp;<b> 4000 0027 6000 3184 </b> 02/22 222 22222 
    </p>
</div>

<input type="hidden" name="payment_method" id="paymentMethod">

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');

    const elements = stripe.elements({ locale: 'en' });
    const cardElement = elements.create('card', {
        style: {
            base: {
            iconColor: '#c4f0ff',
            color: '#fff',
            fontWeight: '500',
            fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
            fontSize: '16px',
            fontSmoothing: 'antialiased',
            ':-webkit-autofill': {
                color: '#fce883',
            },
            '::placeholder': {
                color: '#87BBFD',
            },
            },
            invalid: {
            iconColor: '#FFC7EE',
            color: '#FFC7EE',
            },
        },
    });

    cardElement.mount('#cardElement');
</script>
<script>
    const form = document.getElementById('paymentForm');
    const payButton = document.getElementById('payButton');
    payButton.addEventListener('click', async(e) => {
        if (form.elements.payment_platform.value === "{{ $paymentPlatform->id }}") {
            e.preventDefault();
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: {
                        "name": "{{ auth()->user()->name }}",
                        "email": "{{ auth()->user()->email }}"
                    }
                }
            );
            if (error) {
                const displayError = document.getElementById('cardErrors');
                displayError.textContent = error.message;
            } else {
                const tokenInput = document.getElementById('paymentMethod');
                tokenInput.value = paymentMethod.id;
                form.submit();
            }
        }
    });
</script>
@endpush
