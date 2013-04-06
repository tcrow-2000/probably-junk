<?php
// Include the main Propel script
require_once '../vendor/propel/runtime/lib/Propel.php';

// Initialize Propel with the runtime configuration
Propel::init("../rockalist_db/build/conf/rockalist-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("../rockalist_db/build/classes" . PATH_SEPARATOR . get_include_path());

?>