<?php  defined('C5_EXECUTE') or die("Access Denied.");

$navItems = $controller->getNavItems();



/*** STEP 1 of 2: Determine all CSS classes (only 2 are enabled by default, but you can un-comment other ones or add your own) ***/
foreach ($navItems as $ni) {
  $classes = array();

  if ($ni->isCurrent) {
    //class for the page currently being viewed
    $classes[] = 'current';
  }

  if ($ni->inPath) {
    //class for parent items of the page currently being viewed
    $classes[] = 'section-active';
  }
  
  if($ni->name == 'Github Pages'){
    $classes[] = 'gitlink';
  }

  //Put all classes together into one space-separated string
  $ni->classes = implode(" ", $classes);
}


//*** Step 2 of 2: Output menu HTML ***/
?>
<div class="nav-wrapper">
  <nav class="nav-main" role="navigation">
    <ul class="nav inline-list">
<?php


foreach ($navItems as $ni) {

  echo '<li class="' . $ni->classes . '">'; //opens a nav item

  echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . '">' . $ni->name . '</a>';

  if ($ni->hasSubmenu) {
    echo '<ul>'; //opens a dropdown sub-menu
  } else {
    echo '</li>'; //closes a nav item
    echo str_repeat('</ul></li>', $ni->subDepth); //closes dropdown sub-menu(s) and their top-level nav item(s)
  }
}
?>

    </ul>
  </nav>
</div>
