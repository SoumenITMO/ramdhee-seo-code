<!DOCTYPE html>
<html>
<head>
<title> Maitsev ja maitsev toit </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="icon" type="image/png" href="https://ramadhee.ee/favicon.ico" sizes="196x196" />
<meta http-equiv="Estonian" content="et">
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<style>
/*
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

.navbar {
  overflow: hidden;
  background-color: #333; 
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.subnav {
  float: left;
  overflow: hidden;
}

.subnav .subnavbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.subnav .subnavbtn1 {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.subnav2 {
	disply: none;
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .subnav:hover .subnavbtn {
  background-color: red;
}

.navbar a:hover, .subnav:hover .subnavbtn1 {
  background-color: red;
}

.subnav-content {
  display: none;
  position: absolute;
  left: 0;
  background-color: red;
  width: 100%;
  z-index: 1;
}

.subnav-content1 {
  display: none;
  position: absolute;
  left: 260px;
  background-color: red; 
  z-index: 2;
}

.subnav-content a {
  float: left;
  color: white;
  text-decoration: none;
}

.subnav-content a:hover {
  background-color: #eee;
  color: black;
}

.subnav:hover .subnav-content {
  display: block;
}

.subnavbtn1:hover .subnav-content1 {
  display: block;
}
*/
#nav {
            list-style: none inside;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        #nav li {
            display: block;
            position: relative;
            float: left;
            background: #333;
            /* menu background color */
        }

        #nav li a {
            display: block;
            padding: 0;
            text-decoration: none;
            width: 200px;
            /* this is the width of the menu items */
            line-height: 35px;
            /* this is the hieght of the menu items */
            color: #ffffff;
            /* list item font color */
        }

        #nav li li a {
            font-size: 100%;
        }

        /* smaller font size for sub menu items */

        #nav li:hover {
            background: #ff1b1b;
        }

        /* highlights current hovered list item and the parent list items when hovering over sub menues */

        #nav ul {
            position: absolute;
            padding: 0;
            left: 0;
            display: none;
            /* hides sublists */
        }

        #nav li:hover ul ul {
            display: none;
        }

        /* hides sub-sublists */

        #nav li:hover ul {
            display: block;
        }

        /* shows sublist on hover */

        #nav li li:hover ul {
            display: block;
            /* shows sub-sublist on hover */
            margin-left: 200px;
            /* this should be the same width as the parent list item */
            margin-top: -35px;
            /* aligns top of sub menu with top of list item */
        }
		
		.arrow-right {
			position: relative;
			left: 10%;
		}
		
		.menu-font {
			font-family: Arial, Helvetica, sans-serif;
		}
		
		.down-arrow-color {
			color: white;
		}
</style>

<body>
<!--
<div class="navbar">
  <a href="#home">Home</a>
  <div class="subnav">
    <button class="subnavbtn">About <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#company">Company</a>
      <a href="#team">Team</a>
      <a href="#careers">Careers</a>
    </div>
  </div> 
  
  <div class="subnav">
    <button class="subnavbtn">Services <i class="fa fa-caret-down"></i>
	</button>
    <div class="subnav-content">
      <a href="#bring">Bring</a>
      <a href="#deliver">Deliver</a>
      <a href="#package">Package</a>
    </div>
  </div> 
  
  <div class="subnav">
    <button class="subnavbtn">Partners <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#link1">Link 1</a>
      <a href="#link2">Link 2</a>
      <a href="#link3">Link 3</a>
      <a href="#link4">Link 4</a>
    </div>
  </div>
  <a href="#contact">Contact</a>
</div>
-->

<ul id="nav">
        <li class = "menu-font"><a href="#">Main Item 1</a></li>
        <li class = "menu-font"><a href="#">Main Item 2 &nbsp; <i class="fa fa-caret-down down-arrow-color"> </a></i>
            <ul>
                <li class = "menu-font"><a href="#">Sub Item</a></li>
                <li class = "menu-font"><a href="#">Sub Item</a></li>
                <li class = "menu-font"><a href="#">SUB SUB LIST <i class="fa fa-caret-right arrow-right"></i></a>
                    <ul>
                        <li class = "menu-font"><a href="#">Sub Sub Item 1</a>
                        <li class = "menu-font"><a href="#">Sub Sub Item 2</a>
                    </ul>
                    </li>
            </ul>
            </li>
            <li class = "menu-font"><a href="#">Main Item 3 </a></li>
    </ul>

</body>
</html>