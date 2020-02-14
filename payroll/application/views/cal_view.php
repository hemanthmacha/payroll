







<!DOCTYPE html>
<html lang="en">
<head>
  <title>Calculation Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
.box {
  background-color: ;
  width: 500px;
  border: 1px solid black;
  padding: 30px;
  margin: 1px;
}
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 70%;
}

th, td {
  padding: 10px;
}
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.3%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>


</head>

<body>


<div class="container">
<div class="row">

  <div class="column">
      <h2>Conditions</h2>         
  <table >
    <thead>
      <tr>
        <th>Start Hour</th>
        <th>End Hour</th>
        <th>Rate</th>
        <th>Percentage</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>0</td>
        <td>20</td>
        <td>100</td>
         <td>0</td>
      
      </tr>
      <tr>
      <td>21</td>
        <td>40</td>
        <td>50</td>
         <td>30</td>
      </tr>
      <tr>
      <td>41</td>
        <td>60</td>
        <td>80</td>
         <td>50</td>
      </tr>
      <tr>
      <td>61</td>
        <td>100</td>
        <td>70</td>
         <td>40</td>
      </tr>
    </tbody>
  </table>
</div>
<div class="column">
  <h2>Billed Hours</h2>
<table>
  <tr>
    <th>Sno</th>
    <th>Billed hours</th>
    </tr>
  <tr>
    <td>1</td>
    <td>5</td>
     </tr>
  <tr>
    <td>2</td>
    <td>18</td>
   </tr>
  <tr>
    <td>3</td>
    <td>20</td>
  </tr>
  <tr>
    <td>4</td>
    <td>11</td>
  </tr>
  <tr>
    <td>5</td>
    <td>43</td>
  </tr>
</table>
</div>
<div class="column">
<h2>Sample calculation:</h2>
<div class="box">
<!-- <p><b>SUM =</b>&emsp;SUM OF BILLED HOURS</p> 
 --><p><b>SUM = BILLED HOURS * RATE</b>&nbsp;&nbsp;(if percentage is zero)</p>
<p><b>SUM = (BILLED HOURS * RATE)*PERCENTAGE / 100</b><br> (if percentage is not zero)</p>
<p><b>BILLED HOURS = BILLED HOURS(N) + BILLED HOURS(N-1)</b></p>
</div>
 </div>
</div>

<br>
<div class="row">
  <div class="column">
<p style="font-size: 20px">For Example</p>
<p style="font-size: 15px"><b>Billed hours 1 = 5</b></P>
<!-- <p style="font-size: 15px">Here, Above Billed hours range is in between 0 to 20 <br>
so here calculation will be like  -->
<p style="font-size: 15px"><b>1.&emsp;</b>5 *100 =500 </p>
<p style="font-size: 15px"> Billed hours = 5 </p>
<p style="font-size: 15px"> Amount = 500 </p></div>
<br>
<div class="column">      
<p style="font-size: 15px"><b>Billed hours 2 = 18</b></P>
<!-- <p style="font-size: 15px">Here, Above Billed hours is 18,That is Billed hours 1 + Billed hours 2 is 5 + 18 = 23 <br> in between 0 to 20 and 20 to 40.
so here calculation will be like --> 
 <p style="font-size: 15px"><b>1.&emsp;</b>15 *100 =1500  </p>
 <p style="font-size: 15px"><b>2.&emsp;</b> 3 * 50 *(30 / 100) = 45 </p>
<p style="font-size: 15px"> Billed hours = 23&nbsp;(5+18)</p>
<p style="font-size: 15px"> Amount = 1545 </p>      
</div>


<div class="column">
<p style="font-size: 15px"><b>Billed hours 3 = 20</b></P><!-- 
<p style="font-size: 15px">Here, Above Billed hours is 18,That is Billed hours 1 + Billed hours 2 + Billed hours 3 is 5 + 18 +20 = 43 <br> in between 0 to 20 and 20 to 40 and 40 to 60  -->
    <!-- <p style="font-size: 15px"><b>1.&emsp;</b>5 *100 =500  </p>
     --><p style="font-size: 15px"><b>1.&emsp;</b>(17 * 50 *(30/100) =255   </p>  
    <p style="font-size: 15px"><b>2.&emsp;</b>(3 * 80*(50/100))) = 120 </p>
      <p style="font-size: 15px"> Billed hours = 43&nbsp;(23+20) </p>
    <p style="font-size: 15px"> Amount = 375 </p>       
</div>

<div class="column">
<p style="font-size: 15px"><b>Billed hours 4 = 11</b></P><!-- 
<p style="font-size: 15px">Here, Above Billed hours is 18,That is Billed hour 1 + Billed hour 2 is 5 + 18 = 23 <br> in between 0 to 20 and 20 to 40.
so here calculation will be like -->
    <!-- <p style="font-size: 15px"><b>1.&emsp;</b>5 *100 =500  </p>
    <p style="font-size: 15px"><b>2.&emsp;</b> (15 * 100) + 3 * 50 *(30 / 100) = 1545 </p>  
     <p style="font-size: 15px"><b>1.&emsp;</b>(17 * 50 *(30/100) +(3 * 80*(50/100))) = 375 </p>-->
     <p style="font-size: 15px"><b>1.&emsp;</b>11 * 80 *(50/100) = 440</p>
     <p style="font-size: 15px"> Billed hours = 54&nbsp;(43+11) </p>
    <p style="font-size: 15px"> Amount = 440 </p>       
</div>
    <div class="column">
    <p style="font-size: 15px"><b>Billed hours 5 = 43</b></P>
    <!-- <p style="font-size: 15px"><b>1.&emsp;</b>5 *100 =500  </p>
    <p style="font-size: 15px"><b>2.&emsp;</b> (15 * 100) + 3 * 50 *(30 / 100) = 1545 </p>  
    <p style="font-size: 15px"><b>3.&emsp;</b>(17 * 50 *(30/100) +(3 * 80*(50/100))) = 375</p>
     --><p style="font-size: 15px"><b>1.&emsp;</b>5 * 80 *(50/100) =240 </p>
      <p style="font-size: 15px"><b>2.&emsp;</b>(38 * 70 *(40/100)) = 1064</p>
      <p style="font-size: 15px"> Billed hours = 97&nbsp;(54+43)</p>
      <p style="font-size: 15px"> Amount = 1304 </p>      
</div>
<div class="column">  <p style="font-size: 15px"><B>TOTAL BILLEDHOURS = 97</B><br><br><B>TOTAL AMOUNT = 4164</B> </p>       
      <p style="font-size: 15px"> </p>      
</div>
      
</div>
</div>
  

</div>
</div>
</div>
<a type="button" class="btn btn-primary buttondelete" href="javascript:window.history.go(-1);">Back</a>

</body>
</html>
