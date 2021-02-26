<?php
session_start();

session_destroy();

header("Location: /bookshelf/index.html.php");
