<?php
$routes = [
    'checkUrlSafety',
    'checkUrlsSafety',
    'getThreatLists',
    'getThreatListUpdates',
    'checkSafetyByHashs',
    'metadata'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

