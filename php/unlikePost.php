<?php

@require("../models/Like.php");

Like::unlikePost($_GET['postId']);

echo "success";

?>