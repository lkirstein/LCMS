<?php

  // Database Connection Details
  // Will be set by the installation script.
  // Change to fit your Development-Environment
  $Servername = "localhost";
  $Username = "lcms";
  $Password = "lcms";
  $Database = "lcms";

  // Create connection
  $conn = new mysqli($Servername, $Username, $Password, $Database);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?> 