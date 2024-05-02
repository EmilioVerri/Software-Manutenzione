<?php
/*

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    

    if (!isset($_SESSION['FirstVisit'])) {

    //show site for the first time part
    $_SESSION['FirstVisit'] = 1;
 

    // Don't forget to add http colon slash slash www dot before!

    } else { 
        $_SESSION['FirstVisit']++;
     }
*/
?>

<!DOCTYPE html>
<html>
<head>
  <title>Baxter Application</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/css/uikit.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/js/uikit-icons.min.js"></script>
</head>
<body>
  <div class="uk-grid uk-grid-match">
    <div class="uk-width-4-5 uk-card uk-card-default uk-card-body uk-flex" style="height:700px;"> 
    <p uk-margin>
    <input type="text"class="uk-button uk-button-default">
    <input type="text" class="uk-button uk-button-default">
    <input type="text" class="uk-button uk-button-default">
</p>
    </div>


    
    <div class="uk-width-1-5 uk-card uk-card-default uk-card-body uk-flex" style="height:700px;">
      Large
    </div>
  </div>
</body>
</html>







