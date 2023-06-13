
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.container {
  position: relative;
  text-align: center;
  color: black;
  width: 100%;
  margin: :0px auto;
  padding: :0px auto;
}

.centered1 {
  position: absolute;
  top: 45%;
  left: 50%;
  transform: translate(-45%, -50%);
   margin: :0px auto;
   padding: :0px auto; 
   text-transform: uppercase;  
}

.centered {
  position: absolute;
  top: 47%;
  left: 50%;
  transform: translate(-50%, -50%);
   margin: :0px auto;
   padding: :0px auto;
   text-transform: uppercase;
}
.centered2 {
  position: absolute;
  top: 62%;
  left: 50%;
  transform: translate(-50%, -50%);
   margin: :0px auto;
   padding: :0px auto;
   text-transform: uppercase;
}
</style>
</head>
<body>
<div class="container">
  <img src="{{ asset('wp-content/uploads/doc/flag.png') }}" alt="Snow" style="width:100%;margin:0px auto;">
  <div class="centered">{{$cities}}</div>
  <div class="centered1">{{$name}}</div>
  <div class="centered2">{{$name}}</div>
  
  
</div>

</body>
</html> 




<!--<!DOCTYPE html>
<html>
<head>
<style>
.container {
  position: absolute;
  text-align: center;
  color: #000000;
  width:100%; 
  margin: 0px auto;
  padding: 0px auto;
}

.top-left {
    position: absolute;
    top: 10%;
    left: 15%;
    font-size: 18px;
    color: #000000;
    text-transform: uppercase;
}*/

/*.top-left {
    position: absolute;
    top: 305px;
    left: 340px;
    font-size: 14px;
    color: #000000;
    text-transform: uppercase;
}*/

/*.top-left-next {
    position: absolute;
    top: 506px;
    left: 340px;
    font-size: 18px;
    color: #000000;
    text-transform: uppercase;
}

.top-left-new {
    position: absolute;
    top: 670px;
    left: 340px;
    font-size: 18px;
    color: #000000;
    text-transform: uppercase;
}
*/
</style>
</head>
<body>


 <div class="container">
  <img src="http://103.65.20.170/fitind/wp-content/uploads/doc/flag.png" style="width:73%;margin: 0px auto;">  
  <div class="top-left">{{$name}}</div>
 <div class="top-left-next">{{$cities}}</div>
  <div class="top-left-new">{{$name}}</div>
</div>
</body>
</html> -->


