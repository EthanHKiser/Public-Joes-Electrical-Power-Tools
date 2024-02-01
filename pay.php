<?php
 session_start();
 $total = $_SESSION['charged'];
$Final = $total + 10.00;
$_SESSION["final"] = $Final;
?>
<script src="https://js.stripe.com/v3/"></script>

<style>
      #payment-form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
  }

  button[type="submit"] {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 20px;
  }

  button[type="submit"]:hover {
    background-color: #0056b3;
  }
  body {
    background: linear-gradient(to bottom, #99ccff, #003366);
  }
  html, body {
            height: 100%;
            margin: 0;
        }
</style>

<form action="charge.php" method="post" id="payment-form">
  <div class="form-row">
  <p>Subtotal: $<?php echo $_SESSION["total"] ?></p>
  <p>Shipping: $10</p>
  <p>Tax: $<?php echo $_SESSION["tax"] ?> </p>
  <p>Total: $<?php echo $Final ?></p>
  <br>
    <label for="card-element">Credit or Debit Card:</label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>
    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
  </div>
  <center>
  <button type="submit">Complete Payment</button>
  <p style="color: green;">✔ Payments secured by Stripe.</p>
  </center>
</form>

<script>
  // Create a Stripe instance with your Publishable Key
  const stripe = Stripe('pk_test_51NtwoLAALAHoRMAoEujG0S6wUH87mnCOVuYV2U9xxnb1UuS5CCMCbKVTk9Ms6AGJv9GQvTupV8jp1XrB60U5TGW000O0Oztul7');

  // Create an instance of Elements
  const elements = stripe.elements();

  // Create a card Element and mount it to the card-element div
  const card = elements.create('card');
  card.mount('#card-element');

  // Handle form submission
  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const { token, error } = await stripe.createToken(card);

    if (error) {
      const errorElement = document.getElementById('card-errors');
      errorElement.textContent = error.message;
    } else {
      // If token creation is successful, submit the form with the token to your server
      const tokenInput = document.createElement('input');
      tokenInput.setAttribute('type', 'hidden');
      tokenInput.setAttribute('name', 'stripeToken');
      tokenInput.setAttribute('value', token.id);
      form.appendChild(tokenInput);

      // Now submit the form
      form.submit();
    }
  });
</script>