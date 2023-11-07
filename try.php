<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card</title>
    <style>
        body{
			
		}
        
        #div1 {
            margin: 0px;
            padding: 0px;
            border: 2px solid black;
            width: 540px;
            height: 350px;
            margin-left: 470px;
            margin-top: 60px;
            border-radius: 0px;
            background-color: white;
        }
        
        #p1 {
    display: flex;
    align-items: center;
    background-color: #1AA260;
    margin: 0px;
    color: white;
    font-weight: bold;
    text-align: center;
    font-size: 30px;
    padding: 10px;
}

.logo-container {
    margin-right: 10px;
	align-self: flex-start;
margin-top: -20px;
}

        
        img {
            border: 1px solid black;
            width: 170px;
            height: 187px;
            margin: 0px;
            padding: 0px;
            margin-top: 20px;
            margin-left: 20px;
            float: left;
        }
        
        #div2 {
            float: left;
            margin-left: 40px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        
        #p2 {
            margin-top: 0px;
            margin-bottom: 5px;
        }
        
        #p3 {
            margin-top: 0px;
            margin-bottom: 1px;
        }
        
        #label1 {
            font-size: 23px;
            font-weight: bold;
            opacity: 0.7;
        }
        
        #label2 {
            font-size: 25px;
            font-weight: bold;
            margin-left: 15px;
        }
        
        h1 {
            margin-left: 10px;
            margin-bottom: 0px;
        }
        
        h3 {
            margin-top: 0px;
            float: left;
            margin-left: 10px;
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        
        .contact-info {
            margin-left: 60px;
        }
    </style>
</head>
<body>
    <div id="div1">
        <p id="p1">
        <span class="logo-container">
            <img src="com/logo.png" alt="Logo" style="width: 55px; height: 55px;">
        </span>
        Western Coalfields Limited
    </p>

		
        <img src="image/tarif.jpg" alt="">
        <table>
  <tr>
    <td>EIS Number:</td>
    <td>123456</td>
  </tr>
  <tr>
    <td>Mobile Number:</td>
    <td>9876543210</td>
  </tr>
  <tr>
    <td>Department Visit:</td>
    <td>HR</td>
  </tr>
  <tr>
    <td>Employee to Visit:</td>
    <td>John Doe</td>
  </tr>
</table>

        <br>
        <div class="contact-info">
    <h3 style="margin-right: 20px;">www.westerncoal.in</h3>
    <h3 style="margin-left: 10px;">agmnagpur.wcl@coalindia.in</h3>
</div>
    </div>
</body>
</html>
