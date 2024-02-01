<?php
session_start();
    if (isset($_POST["submit"])) {
        $_SESSION["signoutTotal"] = $_POST["price"];
        $_SESSION["signouttitle"] = $_POST["title"];
        $_SESSION["quantity"] = $_POST["quantity"];
        $_SESSION["part"] = $_POST["part"];
    }
?>

<style>
    form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px #ccc;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        select,
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        select {
            height: 45px;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        } form {
    max-width: 400px;
    margin: 0 auto;
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
</style><br><br>
<form action="tax.php" method="POST">
        <!-- Street Address -->
        <label for="street">Street Address:</label>
        <input type="text" id="street" name="street" required>
        
        <!-- Apt/Suite/Unit (Optional) -->
        <label for="apt">Apt/Suite/Unit (optional):</label>
        <input type="text" id="apt" name="apt" placholder="optional">
        
        <!-- City -->
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
        
        <!-- State/Province (Optional, use a select element or input field) -->
        <label for="state">State/Province:</label>
        <select id="state" name="state" required>
    <option value="">Select</option>
    <option value="AL">Alabama</option>
    <option value="AK">Alaska</option>
    <option value="AZ">Arizona</option>
    <option value="AR">Arkansas</option>
    <option value="CA">California</option>
    <option value="CO">Colorado</option>
    <option value="CT">Connecticut</option>
    <option value="DE">Delaware</option>
    <option value="FL">Florida</option>
    <option value="GA">Georgia</option>
    <option value="HI">Hawaii</option>
    <option value="ID">Idaho</option>
    <option value="IL">Illinois</option>
    <option value="IN">Indiana</option>
    <option value="IA">Iowa</option>
    <option value="KS">Kansas</option>
    <option value="KY">Kentucky</option>
    <option value="LA">Louisiana</option>
    <option value="ME">Maine</option>
    <option value="MD">Maryland</option>
    <option value="MA">Massachusetts</option>
    <option value="MI">Michigan</option>
    <option value="MN">Minnesota</option>
    <option value="MS">Mississippi</option>
    <option value="MO">Missouri</option>
    <option value="MT">Montana</option>
    <option value="NE">Nebraska</option>
    <option value="NV">Nevada</option>
    <option value="NH">New Hampshire</option>
    <option value="NJ">New Jersey</option>
    <option value="NM">New Mexico</option>
    <option value="NY">New York</option>
    <option value="NC">North Carolina</option>
    <option value="ND">North Dakota</option>
    <option value="OH">Ohio</option>
    <option value="OK">Oklahoma</option>
    <option value="OR">Oregon</option>
    <option value="PA">Pennsylvania</option>
    <option value="RI">Rhode Island</option>
    <option value="SC">South Carolina</option>
    <option value="SD">South Dakota</option>
    <option value="TN">Tennessee</option>
    <option value="TX">Texas</option>
    <option value="UT">Utah</option>
    <option value="VT">Vermont</option>
    <option value="VA">Virginia</option>
    <option value="WA">Washington</option>
    <option value="WV">West Virginia</option>
    <option value="WI">Wisconsin</option>
    <option value="WY">Wyoming</option>
</select>

        
        <!-- ZIP/Postal Code -->
        <label for="zip">ZIP/Postal Code:</label>
        <input type="text" id="zip" name="zip" required>
        <!-- Submit Button -->
        <button type="submit">Next</button>
    </form>