<?php
$files = array_slice(scandir('./views'), 2);

echo json_encode($files);