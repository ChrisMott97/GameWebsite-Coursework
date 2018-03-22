<?php
session_start();
session_destroy();
header("Location: /cm740/coursework/#/login");