<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title> PayPal Checkout Integration | Server Demo </title>
</head>

<body>
<div id="paypal-button-container"></div>
<script
    src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}&currency=USD">
</script>
<script src="{{ asset('js/paypal.js') }}" type="text/javascript"></script>
</body>

</html>

