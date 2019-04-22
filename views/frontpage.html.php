<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Homepage</title>
 <style>
  html, body{
    height: 100%;
  }
  body{
    display: flex;
    align-items: center;
    justify-content: center;
    min-width:100%;
    height:100%;
  }
  a {
   color:#fff;
   background-color:#000;
   width:200px;
   height:100px;
   padding:3px;
   text-align:center;
   line-height:100px;
   border-radius:10px;
   font-size:18px;
   text-decoration:none;
  }
 </style>
</head>
<body>
 <a href="<?=$login_url;?>">Login to Dropbox</a>
</body>
</html>