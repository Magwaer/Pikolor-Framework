<?php

require_once("../../../engine/core/Core.php");
require_once("../../controllers/Custom_field.php");
require_once("custom_field_photos.php");

$custom_field_photos = new custom_field_photos();
$custom_field_photos->manual_init();
$custom_field_photos->upload();
