<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <link rel="stylesheet" href="{{url('../stylesheet/style.css')}}">
  <link rel="stylesheet" href="{{url('../stylesheet/responsive.css')}}">
  <!-- <link rel="stylesheet" href="../new/stylesheet/style.js"> -->
  
  <title>new</title>
</head>
  <body>
    <div id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul class="sidebar-nav m-3">
          <li class="active"><a class=" d-flex" href="{{url('/')}}"><img src="{{url('../img/dashboard.png')}}" alt=""><span >Dashboard</span></a></li>
          <li><a class="d-flex" href="{{url('/users')}}"><img src="{{url('../img/admin.png')}}" alt=""><span >Admin</span></a></li>
          <li><a class="d-flex" href="{{url('/sellers')}}"><img src="{{url('../img/vendor.png')}}" alt=""><span >Vendors</span></a></li>
          <li><a class="d-flex" href="{{url('/buyers')}}"><img src="{{url('../img/people.png')}}" alt=""><span >Customers</span></a></li>
          <li><a class="d-flex" href="{{url('/staffs/create')}}"><img src="{{url('../img/employees.png')}}" alt=""><span >Staffs</span></a></li>
          <li><a class="d-flex" href="{{url('/yarns')}}"><img src="{{url('../img/supplies.png')}}" alt=""><span >Woven Masterrs</span></a></li>
          <li><a class="d-flex" href="{{url('/yarns')}}"><img src="{{url('../img/web-design.png')}}" alt=""><span >Design Cards</span></a></li>
          <li><a class="d-flex" href="{{url('/woven-design-cards')}}"><img src="{{url('../img/3d-printing.png')}}" alt=""><span >Printed Masters</span></a></li>
          <li><a class="d-flex" href="{{url('/purchase-order')}}"><img src="{{url('../img/purchase.png')}}" alt=""><span >Purchase Order</span></a></li>
          <li><a class="d-flex" href="{{url('/roles')}}"><img src="{{url('../img/settings.png')}}" alt=""><span >Roles</span></a></li>
          <li><a class="d-flex" href="{{url('/categories')}}"><img src="{{url('../img/category.png')}}" alt=""><span >Category</span></a></li>
         
          <span class="acsetting"><li><a class="Accountmenu" href=""><h3 class="acount">Account settings</h3></a></li></span>
          <li><a class="d-flex" href="{{url('users/change-password')}}"><img src="{{url('../img/padlock.png')}}" alt=""><span >Change Password</span></a></li>
        </ul>
      </div>
      
      <!-- Page Content -->
     @yield('content')
     
     
    </div>
    
  <!-- script -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="{{url('../stylesheet/style.js')}}">
<script>
  $(document).ready(function(){
  $("#menu-toggle").click(function(e){
    e.preventDefault();
    $("#wrapper").toggleClass("menuDisplayed");
  });
});
</script>
</body>
</html>