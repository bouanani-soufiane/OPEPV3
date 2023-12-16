<?php
include('../model/theme.php');
function allThemes(){
    $theme = new Theme();
    $themes = $theme->showTheme();
    return $themes;
}
?>
