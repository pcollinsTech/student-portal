@extends('layouts.app')

@section('content')

    <payment-component></payment-component>
    <div class="card">
    <div class="card-body">
        <button id="hihi">
            PAYYYY
        </button>
    </div>
    </div>
@endsection

@section('scripts')

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="{{ asset('js/rxp-hpp.js') }}"></script>
<script>
  $(document).ready(function() {
    $.getJSON("/payment", function(jsonFromRequestEndpoint) {
        console.log("jsonFromRequestEndpoint", jsonFromRequestEndpoint)
      RealexHpp.setHppUrl("https://pay.sandbox.realexpayments.com/pay");
      RealexHpp.lightbox.init("hihi", "responseEndpoint", jsonFromRequestEndpoint);
      });
  });
</script>

@endsection