<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["street"])) {
    $_SESSION["street"] = $_POST["street"];
    $_SESSION["apt"] = $_POST["apt"];
    $_SESSION["city"] = $_POST["city"];
    $_SESSION["state"] = $_POST["state"];
    $_SESSION["zip"] = $_POST["zip"];

    $selectedState = $_SESSION["state"];
    
    if ($selectedState === 'AL') {
        $tax = 0.04;
    }
    if ($selectedState === 'AK') {
        $tax = 0.075;
    }
    if ($selectedState === 'AZ') {
        $tax = 0.056;
    }
    if ($selectedState === 'AR') {
        $tax = 0.065;
    }
    if ($selectedState === 'CA') {
        $tax = 0.0725;
    }
    if ($selectedState === 'CO') {
        $tax = 0.029;
    }
    if ($selectedState === 'CT') {
        $tax = 0.0635;
    }
    if ($selectedState === 'DE') {
        $tax = 0.00;
    }
    if ($selectedState === 'FL') {
        $tax = 0.06;
    }
    if ($selectedState === 'GA') {
        $tax = 0.04;
    }
    if ($selectedState === 'HI') {
        $tax = 0.0416;
    }
    if ($selectedState === 'ID') {
        $tax = 0.06;
    }
    if ($selectedState === 'IL') {
        $tax = 0.0625;
    }
    if ($selectedState === 'IN') {
        $tax = 0.07;
    }
    if ($selectedState === 'IA') {
        $tax = 0.06;
    }
    if ($selectedState === 'KS') {
        $tax = 0.065;
    }
    if ($selectedState === 'KY') {
        $tax = 0.06;
    }
    if ($selectedState === 'LA') {
        $tax = 0.0445;
    }
    if ($selectedState === 'ME') {
        $tax = 0.055;
    }
    if ($selectedState === 'MD') {
        $tax = 0.06;
    }
    if ($selectedState === 'MA') {
        $tax = 0.0625;
    }
    if ($selectedState === 'MI') {
        $tax = 0.06;
    }
    if ($selectedState === 'MN') {
        $tax = 0.06875;
    }
    if ($selectedState === 'MS') {
        $tax = 0.07;
    }
    if ($selectedState === 'MO') {
        $tax = 0.0423;
    }
    if ($selectedState === 'MT') {
        $tax = 0.00; // Montana has no sales tax, so set it to 0
    }
    if ($selectedState === 'NE') {
        $tax = 0.055;
    }
    if ($selectedState === 'NV') {
        $tax = 0.0685;
    }
    if ($selectedState === 'NH') {
        $tax = 0.00; // New Hampshire has no sales tax, so set it to 0
    }
    if ($selectedState === 'NJ') {
        $tax = 0.06625;
    }
    if ($selectedState === 'NM') {
        $tax = 0.05125;
    }
    if ($selectedState === 'NY') {
        $tax = 0.04;
    }
    if ($selectedState === 'NC') {
        $tax = 0.0475;
    }
    if ($selectedState === 'ND') {
        $tax = 0.05;
    }
    if ($selectedState === 'OH') {
        $tax = 0.0575;
    }
    if ($selectedState === 'OK') {
        $tax = 0.045;
    }
    if ($selectedState === 'OR') {
        $tax = 0.00; // Oregon has no sales tax, so set it to 0
    }
    if ($selectedState === 'PA') {
        $tax = 0.06;
    }
    if ($selectedState === 'RI') {
        $tax = 0.07;
    }
    if ($selectedState === 'SC') {
        $tax = 0.06;
    }
    if ($selectedState === 'SD') {
        $tax = 0.045;
    }
    if ($selectedState === 'TN') {
        $tax = 0.07;
    }
    if ($selectedState === 'TX') {
        $tax = 0.0625;
    }
    if ($selectedState === 'UT') {
        $tax = 0.0485;
    }
    if ($selectedState === 'VT') {
        $tax = 0.06;
    }
    if ($selectedState === 'VA') {
        $tax = 0.043;
    }
    if ($selectedState === 'WA') {
        $tax = 0.065;
    }
    if ($selectedState === 'WV') {
        $tax = 0.06;
    }
    if ($selectedState === 'WI') {
        $tax = 0.05;
    }
    if ($selectedState === 'WY') {
        $tax = 0.04;
    }

if (isset($_SESSION["useruid"])) {
    $taxes = $_SESSION["total"] * $tax;
    $taxes = round($taxes, 2); // Round to 2 decimal places
    $taxes = number_format($taxes, 2); // Format the rounded number with 2 decimal places
    $_SESSION['charged'] = $taxes + $_SESSION["total"];
    $_SESSION['tax'] = $taxes;
    header("location: pay.php");
exit();
} else {
    $taxes = $_SESSION["signoutTotal"] * $tax;
    $taxes = round($taxes, 2); // Round to 2 decimal places
    $taxes = number_format($taxes, 2); 
    $_SESSION['charged'] = $taxes + $_SESSION["signoutTotal"];
    $_SESSION['tax'] = $taxes;
    header("location: purchase.php");
exit();
}
}