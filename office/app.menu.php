<aside id="lyMenu" class='sidebar in'>
  <ul class='nav nav-stacked'>
    <?php
    foreach((array)$menus as $i => $value){
      $url = "app.php?mod={$value['id']}";
      if((InArray('VIEW', $permiss[$value['id']])) || ($_SESSION[OFFICE]['DATA']['level'] >= 4)){
        if(empty($menus_sub[$value['code']])){
          echo "<li id='menu-{$value['id']}'><a href='$url'><i class='fa {$value['icon']} fa-fw'></i>{$value['name']}</a></li>";
        }else{
          echo "<li id='menu-{$value['id']}' class='menu'>";
          echo "<a href='#' class='menu-toggle'><i class='fa {$value['icon']} fa-fw'></i>{$value['name']}<i class='caret'></i></a>";
          echo "<ul class='submenu'>";
          foreach($menus_sub[$value['code']] as $j => $submenu){
            if((InArray('VIEW', $permiss[$value['id'].'-'.$submenu['id']])) || ($_SESSION[OFFICE]['DATA']['level'] >= 4)){
              $url = "app.php?mod={$submenu['id']}&parent={$value['id']}";
              echo "<li id='submenu-{$value['id']}-{$submenu['id']}'><a href='$url'><i class='fa fa-angle-double-right fa-fw'></i><span>{$submenu['name']}</span></a></li>";
            }
          }
          echo "</ul>";
          echo "</li>";
        }
      }
    }
    ?>
  </ul>
</aside>