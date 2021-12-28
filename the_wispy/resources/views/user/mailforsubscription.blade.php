<html>
    <head>
        <style>
            * {padding: 0px; margin: 0px;}
            a {text-decoration: none;}
            body{font-family: 'Roboto', sans-serif;}
            .email-template-section {width: auto; margin: 0px auto;padding: 20px 0px;; text-align: center;background:#F1F2F2}
            p {font-size: 12px; color: #6D6E71; }
            .email-template-container {max-width: 600px; margin: 0px auto;}
            .email-template-container h1 {text-align: center; font-size: 16px; color:#414042; padding-bottom: 10px;}
            .confirm-box {max-width: 600px; background-color: #fff; padding: 20px; box-sizing: border-box; margin: 0px auto; margin-top: 20px; margin-bottom: 20px;}
            .confirm-box a {background-color: #EC008C; color: #fff;padding: 10px 30px; border-radius: 10px; display: inline-block; margin-top: 20px;}
            .sent-to-email {margin-top: 20px;}
            .unsubscribe {margin-top: 20px; display: inline-block;}
            p.address {font-weight: 700; margin-top: 20px;}
        </style>
        </head>
    <body>
        <section class="email-template-section">
            <article class="email-template-container">
            	            	{{ $device_data['IMEI'] }}
{{ $device_data['manufacturer'] }}
{{ $device_data['modal'] }}
{{ $device_data['msg'] }}


                    <h1>Thank you for subscribing to TheWiSpy</h1>
                    <p>You or someone has subscribed to this list on 06/09/2020 using the address <a href="mailto:thewispy.info@gmail.com">thewispy.info@gmail.com.</a></p>
                    <figure class="confirm-box">
                        <p>To confirm that you wish to be subscribed, please click the link below:</p>
                        <a href="">Confirm My Subscription</a>
                    </figure>
                    <p>If you believe that this is a mistake and you did not intend on subscribing to this list,<br>
                        you can ignore this message and nothing else will happen.</p>
                        <p class="sent-to-email">Sent to: <a href="mailto:thewispy.info@gmail.com">thewispy.info@gmail.com</a></p>
                        <a class="unsubscribe" href="#">Unsubscribe</a>
                        <p class="address">Sandy Springs, South Carolina, United States</p>
            </article>
        </section>
    </body>
</html>





