<?php

session_start();

session_destroy();

header("location: ../sisti/login.php");