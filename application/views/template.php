<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>SlamClan</title>
   
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="http://bootswatch.com/slate/bootstrap.min.css">
   
   <style>
   html {
      position: relative;
      min-height: 100%;
   }
   body {
      /* Margin bottom by footer height */
      margin-bottom: 30px;
   }
   body > .container {
      padding: 120px 15px 0;
   }
   </style>

</head>
<body>

   <!-- Fixed navbar -->
   <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Slam Clan</a>
         </div>
         <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
               <li class="active"><a href="#">Stats</a></li>
            </ul>
         </div><!--/.nav-collapse -->
      </div>
   </div>

   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h1 class="panel-title">
               Clan Statistics
            </h1>
         </div>

         <div class="panel-body">
            <p>Click a statistic for member contribution rankings.</p>
            <div class="panel-group" id="accordion">
               <?= $content ?>
            </div>
         </div>
      </div>
   </div>

</body>
</html>