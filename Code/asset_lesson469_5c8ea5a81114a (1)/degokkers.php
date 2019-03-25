<?php
/**
 * Created by PhpStorm.
 * User: Floris
 * Date: 25-3-2019
 * Time: 16:23
 */

header("Content-disposition: attachment; filename=degokkers.zip");
header("Content-type: application/zip");
readfile("degokkers.zip");

?>