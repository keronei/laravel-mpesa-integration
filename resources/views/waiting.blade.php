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
        <script src="{!! asset('js/waterbubble.min.js') !!}"></script>

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

    </head>
        <body>
        <div class="content">
        <h4><?= $CustomerMessage ?></h4><br>
        <canvas id="progress"></canvas>

           <div class="title m-b-md">
                    Please wait . . .
                </div>

        </div>
       <script>
      console.log('<?= $complete ?>' + ': STatus completion');
            var time_counter = 0;
            var final_data = 0;
               printbubble();
                var status_completion = '<?= $complete ?>';
                if(!status_completion){
                //if status_completion = false, request went well...continue processing
                if('<?= $CheckoutRequestID ?>'){
                 var CheckoutRequestID = '<?= $CheckoutRequestID ?>';
                
                var refreshIntervalId = setInterval(function getStatus() {
                    time_counter = time_counter + 2;
                 var status_update = (time_counter/240);
                 final_data = round(status_update,2);
                   printbubble();
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
                         console.log(data[0]);
                          
                                                          
                               switch(data[0]) {
                                    case  0:
                                      status_completion = true;
                                      clearInterval(refreshIntervalId);
                                      final_data = 1;
                                      console.log('PAID');
                                      printbubble();
                                      //window.alert('payment accepted!');
                                    
                                      break;
                                    case 1:
                                      console.log('pending...');
                                      break;
                                    case 2:
                                      status_completion = true;
                                      clearInterval(refreshIntervalId);
                                      final_data = 1;
                                      printbubble();
                                      console.log('Unfortunately payment failed');
                                      //window.alert('Rejected payment');
                                      
                                    break;
                                    default:
                                      final_data = 1;
                                      console.log('stray result..');
                                      status_completion = true;
                                      clearInterval(refreshIntervalId);
                                  }
                              } 
                            
                           
                        
                    });
                },2000);}
                }
                
                if(status_completion){
                    window.alert('Initiation rejected your payment');
                    console.log('Payment failed to initiate');
                    final_data=1;
                    printbubble();
                }
                                
                function round(value, precision) {
                    var multiplier = Math.pow(10, precision || 0);
                    return Math.round(value * multiplier) / multiplier;
                }
                           
       function printbubble(){
                $('#progress').waterbubble({
               
                 // bubble size
               
                 radius: 100,
               
                
               
                 // border width
               
                 lineWidth: undefined,
               
                 // data to present
               
                 data: final_data,
               
                 // color of the water bubble
               
                 waterColor: 'rgba(25, 139, 201, 1)',
               
                
               
                 // text color
               
                 textColor: 'rgba(06, 85, 128, 0.8)',
               
                 // custom font family
               
                 font: '',
               
                 // show wave
               
                 wave: true,
               
                 // custom text displayed inside the water bubble
               
                 txt: round((final_data*100),0) + '%',
               
                
               
                 // enable water fill animation
               
                 animation: true
               
               });}
       </script>
        </body>
</html>        