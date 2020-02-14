<?php

//

use openconsult\tools\Ajax;

//

$args = [
];

?>

<html>
  <body>
    <p id="pdef">This is the default value</p>
    <button type="button" id="buttonElement">Click Me</button>

    <script src="util.js"></script>
    <script>
      // add listener to button

      buttonElement.addEventListener('click', function (event) {
        event.preventDefault();
        ajax(listener, params);
      });

      // set ajax callback function

      var listener = function () {
        document.get
        p.text("This has been clicked!");
      }

      // build params

      var params = "name=blah&b=3";
    </script>
  </body>
</html>
