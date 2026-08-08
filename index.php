<?php
// Redirect document root requests to Laravel public folder when using /extech/
header('Location: public/');
exit;
