<?php

$project = new ZipArchive();
$file = $project->open("project.zip");
if($file === TRUE) {
    $project->extractTo("folder name to extract");
    $project->close();
    echo "Decompressed successfully!";
} else {
    echo "Fail";
}

?>