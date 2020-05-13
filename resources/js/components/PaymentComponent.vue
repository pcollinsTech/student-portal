<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Payment Details</div>

                    <div class="card-body">
                        <p>A fee of £206 will be require to proceed</p>

                        <!-- <template v-for="field in fields_0">
                          <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                        </template> -->
                        <button ref="button" id="payButtonId" class="btn btn-success">
                            Pay
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 text-right"><a href="/forward"><button class="btn btn-info">Forward</button></a></div>
        </div>
    </div>
</template>
<script>
    import RealexHpp from "../helpers/rxp-hpp.js"

    export default {
        data() {
            return {
                rpxData: null
            }
        },
        created() {
            console.log('PaymentComponent::created()');
            this.fetchPaymentData();
        },
        methods: {

            //
            fetchPaymentData() {
                console.log('fetching...')
                axios.get('/payment/request').then( ({ data }) => {
                    this.rpxData = data;
                    RealexHpp.setHppUrl("https://pay.sandbox.realexpayments.com/pay");
                    RealexHpp.lightbox.init(this.$refs.button.id, "payment/response", this.rpxData);
                })
                
            }
        }
    }
</script>