<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MPesa Pay Result</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <style>
          html, body {
                background-color: #fff;
                color: #636b6f;
                padding-top:80px;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 80%;
                margin: 0;
               
            }
             .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 25px;
                padding:20px;
            }
            
            .send {
                background-color:#b3e6b3;
                height:40px;
                width:150px;
                border-radius:60px;
                font-family: 'Raleway', sans-serif;
                font-weight: 150;
                font-size:15px;
            }
        </style>
            <script>
            var CheckoutRequestID = '<?= $CheckoutRequestID ?>';
            var status_completion = '<?= $complete ?>';
               
                if(!status_completion){
                var refreshIntervalId = setInterval(function getStatus() {
                     $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                    $.ajax({
                        url: 'check/'+CheckoutRequestID,
                        method: 'GET',
                        async: true,
                        success: function(data) {
                         console.log(data);
                            
 
                               console.log(data);
                               
                               switch(data) {
                                    case Array({status: 0}):
                                      console.log('PAID');
                                      window.alert('payment accepted!');
                                      status_completion = true;
                                      clearInterval(refreshIntervalId);
                                      break;
                                    case Array({status: 1}):
                                      console.log('pending...');
                                      break;
                                    case Array({status: 2}):
                                      console.log('Unfortunately payment failed');
                                      window.alert('Rejected payment');
                                      status_completion = true;
                                      clearInterval(refreshIntervalId);
                                    break;
                                    default:
                                      console.log('stray result..');
                                      status_completion = true;
                                      clearInterval(refreshIntervalId);
                                  }
                             
                            }
                           
                        
                    });
                },2000);
                }
                
                if(status_completion){
                    window.alert('Initiation rejected your payment');
                    console.log('Payment failed to initiate');
                }
                
            
</script>
    </head>
        <body>
        <div class="content">
        <h4><?= $CustomerMessage ?></h4>
           <div class="title m-b-md">
                    Your payment is being processed. Continue shopping...
                </div>

        </div>
       
        </body>
</html>        