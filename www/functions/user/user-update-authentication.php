<?php

if (isset($_POST['updateUser']) { // If an admin wishes to update a user
  $rbac->enforce("admin-users-update", $currentUserID);
}
else { // If user only wants to update its own password
  // no permission required.
}
?>
