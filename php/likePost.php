<?php

@require("../models/Like.php");

Like::likePost($_GET['postId']);

echo "success";

?>