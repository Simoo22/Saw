<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="my-5 mx-5">

      <form class="" action="send.php" method="post">
      <div class="form-group">
        <label for="emailobject">Email Object</label>
        <input type="text" class="form-control" id="emailobject" name="emailobject" placeholder="Object" required>
      </div>
      <div class="form-group">
     <label for="emailtext">Text</label>
     <textarea class="form-control" id="emailtext" name="emailtext" rows="20" required></textarea>
   </div>
    <div class="form-group">
      <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="sendto" id="registerdoption" value="true" required>
  <label class="form-check-label" for="registerdoption">Registered only</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="sendto" id="alloption" value="false" required>
    <label class="form-check-label" for="alloption">All</label>
  </div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" id="usehtml" name="usehtml" value="true" checked>
      <label class="form-check-label" for="usehtml">Use html</label>
    </div>
    <button type="submit" class="btn btn-primary">Invia</button>
  </form>
</div>
  </body>
</html>
