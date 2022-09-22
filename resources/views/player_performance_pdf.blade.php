<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Player Performance</title>
    <style>
        span{
            color: #646868;
        }

    </style>
  </head>
  <body>
    <div style="background-color: #191a1a;">
    <img  src="{{ public_path('images/logo.png') }}" 
    alt="logo" style="width:10%;position:absolute;margin-top:10px;margin-left:20px;">
    <center><h5 style="color: white;padding:5px;">Player Performance</h5>
    <h6 style="color: #cbcdcd">{{$performance->player_name}} </h6></center>
    <h6 style="color: rgb(225, 221, 221);position:absolute;right:20px;top:40px;font-size:14px;">Date : <?php echo Date("Y-m-d"); ?></h6>
    </div>
    <br>

    <span>Conversion</span> <span class="float-right"> {{$performance->conversion}}%</span>
    <div class="progress mt-2" style="height: 10px;">
        <div class="progress-bar" role="progressbar" style="width: {{$performance->conversion}}%;height:100%" aria-valuenow="{{$performance->conversion}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <br>

    <hr>
        <table width="100%">
        
            <tr>
                <td width="25%"> <span>Goal In</span> <br></td>
                <td width="25%"><span style="border: 2px solid green;padding:10px 20px 10px 20px;" class="float-right">{{$performance->goal_in }}</span></td>
                <td width="25%"> <span style="margin-left: 10px;"> Goal Missed</span> </td>
                <td width="25%"><span style="border: 2px solid red;padding:10px 20px 10px 20px;" class="float-right">{{$performance->goal_missed }}</span></td>
            </tr>
        </table>

        <table width="100%" style="margin-top:40px; ">
            <tr >
                <td width="25%"> <span>Contact/Obstruction</span> </td>
                <td width="25%"><span style="border: 2px solid #ff751a;padding:10px 20px 10px 20px;" class="float-right">{{$performance->contract}}</span></td>
                <td width="25%"> <span style="margin-left: 10px;"> Error</span> </td>
                <td width="25%"><span style="border: 2px solid #ff471a;padding:10px 20px 10px 20px;" class="float-right">{{$performance->error_record }}</span></td>
            </tr>
        </table>

        <table width="100%" style="margin-top:40px; ">
            <tr >
                <td width="25%"> <span>Tip</span> </td>
                <td width="25%"><span style="border: 2px solid #1ab2ff;padding:10px 20px 10px 20px;" class="float-right">{{$performance->tip }}</span></td>
                <td width="25%"> <span style="margin-left: 10px;"> Intercept</span> </td>
                <td width="25%"><span style="border: 2px solid #00e600;padding:10px 20px 10px 20px;" class="float-right">{{$performance->intercept}}</span></td>
            </tr>
        </table>

        <table width="100%" style="margin-top:40px;margin-bottom:40px; ">
            <tr >
                <td width="25%"> <span>Center Passes</span> </td>
                <td width="25%"><span style="border: 2px solid #e6e600;padding:10px 20px 10px 20px;" class="float-right">{{$performance->center_pass}}</span></td>
                <td width="25%"> <span style="margin-left: 10px;"> Rebound</span> </td>
                <td width="25%"><span style="border: 2px solid #5c00e6;padding:10px 20px 10px 20px;" class="float-right">{{$performance->rebound }}</span></td>
            </tr>
        </table>
  <hr>
  <span>Additional Comments </span>
  <br><br>
  <p><span>{{$performance->comment }}</span></p>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>