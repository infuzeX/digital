<?php
$plans = array("skill", "aspire", "inturn", "hyper");
parse_str($_SERVER["QUERY_STRING"]);
if(!in_array($plan, $plans)){
   header("Location:https://padhhigh.com/higher/payment.html");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padhhigh</title>
    <link rel="stylesheet" href="/higher/css/enrollPlan.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <script defer>
     const setPlanHeading = currentPlan => {
       const plan = {
        "hyper":["HYPER LEARNING", 1199],
        "skill":["SKILL BOOM", 1999],
        "aspire":["ASPIRE BOOST", 3499],
        "inturn":["INTURN MYSTERY", 4999]
       }[currentPlan];
       document.querySelector('.heading').textContent = plan[0];
       document.querySelector('.price').innerHTML = `&#8377;${plan[1]}`;
     }
    const data = {};
    data["plan"] = '<?php echo $plan ?>';
    </script>
</head>

<body>

    <main>
        <div class="">
            <div class="select">
                <div class="list">

                    <img class="pic" src="/higher/images/enroll_coupon.png">
                </div>

                <div class="option">
                    <header>
                        <img src="/higher/images/logo_coupon.png">
                    </header>
                    <p class="heading">INTURN MYSTERY</p>
                    <p class="price">&#1074;‚&#8470;4,999</p>

                    <div class="required">
<p class="status"></p>
                        <form>
                            <p class="field">Enter Name</p>
                            <input name="name" required type="text">
                            <p class="field">Enter Phone number</p>
                            <input name="contact" type="number" required>
                        </form>


                    </div>

                </div>

            </div>
        </div>
        <center>
            <div class="high">
                <div class="coupon">

                    <img src="https://img.icons8.com/fluent/48/000000/gift--v1.png">
                    <input id="input" name="coupon" placeholder="Have a High code?">
                    <div class="buy">
                        <button onclick="initPay()" class="pay">Proceed to pay</button>
                    </div>
                </div>
            </div>
        </center>
    </main>
</body>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const status = document.querySelector(".status");

    function showStatus(text, color) {
      status.textContent = text;
      status.style.color = color;
    }

    setPlanHeading(data.plan);

    async function initPay()  {
    
        try {
            const inputs = document.querySelectorAll('input');
            console.log(inputs);
            inputs.forEach((input) => data[input.name] = input.value)
             
            if(!data.name && !data.contact) {
              Swal.fire({
                title: 'Error!',
                text: "Please Enter your name or contact",
                icon: 'error',
                confirmButtonText: 'ok'
              })
              return;
            }
             
            showStatus("Applying Coupon", "blue");
            const res = await fetch('/higher/php/enrollPlanDb.php', {
                mode:"no-cors",
                method: "POST",
                headers: {
                    "content-type": "application/json"
                },
                body: JSON.stringify(data)
            });
            const resp = await res.json();
            if (resp.success === "success") {
                if(data.coupon){
                  showStatus("", "white");
                  Swal.fire({
                     title: 'Coupon Applied',
                     text: `Hurray! Discounted price Rs ${resp.price}`,
                     icon: 'Success',
                     confirmButtonText: 'ok'
                  })
                }
                showStatus("Please wait! Redirecting...", "blue");
                window.location.href = resp.message;
            } else {
               showStatus("", "white");
               Swal.fire({
                title: 'Error!',
                text: resp.message,
                icon: 'error',
                confirmButtonText: 'ok'
              })
            }
      
        }
        catch (err) {
             showStatus("", "white");
               Swal.fire({
                title: 'Error!',
                text: err.message,
                icon: 'error',
                confirmButtonText: 'ok'
              })
        }
    }
</script>

</html>