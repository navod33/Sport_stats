<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <title>Team Performance</title>
    <style>
        
        span{
            color: #333333;
        }
        .progress-bar{
            background-color: #00419C !important;
        }
        .percentage-span{
            color: #999999;
        }
        .labels-span{
            color: #000000;  
        }
    </style>
  </head>
  <body>
    <div style="background-color: #273043;">
    <img  src="{{ public_path('images/logo.png') }}" 
    alt="logo" style="width:10%;position:absolute;margin-top:10px;margin-left:20px;">
    <center><h5 style="color: white;padding:5px;font-family:'Open Sans' !important;">Overall Team Performance</h5>
    <h6 style="color: #cbcdcd">{{$performance->team_name}} </h6></center>
    {{-- <h6 style="color: rgb(225, 221, 221);position:absolute;right:20px;top:40px;font-size:14px;">Date : <?php echo Date("Y-m-d"); ?></h6> --}}
    </div>
    <br>

    <span>Team Conversion</span> <span class="float-right percentage-span"> {{$performance->team_conversion}}%</span>
    <div class="progress mt-2" style="height: 10px;">
        <div class="progress-bar" role="progressbar" style="width: {{$performance->team_conversion}}%;height:100%;" aria-valuenow="{{$performance->team_conversion}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <br>

    <span>Opposition Conversion </span><span class="float-right percentage-span"> {{$performance->opposition_conversion}}%</span>
    <div class="progress mt-2" style="height: 10px;">
        <div class="progress-bar" role="progressbar" style="width: {{$performance->opposition_conversion}}%;height:100%" aria-valuenow="{{$performance->opposition_conversion}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <br>

    <span>Center Pass Conversion </span><span class="float-right percentage-span"> {{$performance->center_pass_conversion}}%</span>
    <div class="progress mt-2" style="height: 10px;">
        <div class="progress-bar" role="progressbar" style="width: {{$performance->center_pass_conversion}}%;height:100%" aria-valuenow="{{$performance->center_pass_conversion}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <hr>
        <table width="100%">
        
            <tr>
                <td width="25%"> <span class="labels-span">Goal In</span> <br></td>
                <td width="25%"><span style="border: 2px solid #00B200;padding:10px 20px 10px 20px;" class="float-right"><?php echo substr(str_repeat(0, 2).$performance->goal_in , - 2); ?></span></td>
                <td width="25%"> <span style="margin-left: 10px;" class="labels-span"> Goal Missed</span> </td>
                <td width="25%"><span style="border: 2px solid #FF0000;padding:10px 20px 10px 20px;" class="float-right"><?php echo substr(str_repeat(0, 2).$performance->goal_missed , - 2); ?></span></td>
            </tr>
        </table>

        <table width="100%" style="margin-top:40px; ">
            <tr >
                <td width="25%"> <span class="labels-span">Contact/Obstruction</span> </td>
                <td width="25%"><span style="border: 2px solid #FFAA00;padding:10px 20px 10px 20px;" class="float-right"><?php echo substr(str_repeat(0, 2).$performance->contract, - 2); ?></span></td>
                <td width="25%"> <span style="margin-left: 10px;" class="labels-span"> Error</span> </td>
                <td width="25%"><span style="border: 2px solid #FF8FAB;padding:10px 20px 10px 20px;" class="float-right"><?php echo substr(str_repeat(0, 2).$performance->error_record , - 2); ?></span></td>
            </tr>
        </table>

        <table width="100%" style="margin-top:40px; ">
            <tr >
                <td width="25%"> <span class="labels-span">Tip</span> </td>
                <td width="25%"><span style="border: 2px solid #70D6FF;padding:10px 20px 10px 20px;" class="float-right"><?php echo substr(str_repeat(0, 2).$performance->tip , - 2); ?></span></td>
                <td width="25%"> <span style="margin-left: 10px;" class="labels-span"> Intercept</span> </td>
                <td width="25%"><span style="border: 2px solid #99D98C;padding:10px 20px 10px 20px;" class="float-right"><?php echo substr(str_repeat(0, 2).$performance->intercept, - 2); ?></span></td>
            </tr>
        </table>

        <table width="100%" style="margin-top:40px;margin-bottom:40px; ">
            <tr >
                <td width="25%"> <span class="labels-span">Center Passes</span> </td>
                <td width="25%"><span style="border: 2px solid #F9E22C;padding:10px 20px 10px 20px;" class="float-right"><?php echo substr(str_repeat(0, 2).$performance->center_pass, - 2); ?></span></td>
                <td width="25%"> <span style="margin-left: 10px;" class="labels-span"> Rebound</span> </td>
                <td width="25%"><span style="border: 2px solid #9388E9;padding:10px 20px 10px 20px;" class="float-right"><?php echo substr(str_repeat(0, 2).$performance->rebound, - 2); ?></span></td>
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