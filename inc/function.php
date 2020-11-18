<?php

function cleanXss($value){
  return trim(strip_tags($value));
}

function br(){
  echo '<br>';
}

function debug($tableau)
{
  echo '<pre>';
  print_r($tableau);
  echo '</pre>';
}
function ValidationText($errors,$data,$key,$min,$max){
  if(!empty($data)) {
    if(mb_strlen($data) < $min) {
      $errors[$key] = 'Minimum '.$min.' caractères.';
    } elseif(mb_strlen($data) > $max) {
      $errors[$key] = 'Maximum '.$max.' caractères.';
    } else {
      // no error sur ce champ
    }
  } else {
    $errors[$key] = 'Veuillez renseigner ce champ.';
  }

  return $errors;
}


function pagination($page,$num,$count) { ?>
  <ul>
    <?php if($page > 1) { ?>
      <li><a href="index.php?page=<?php echo ($page - 1); ?>">Précédent</a></li>
    <?php } ?>
    <?php if($page*$num < $count) { ?>
      <li><a href="index.php?page=<?php echo ($page + 1); ?>">Suivant</a></li>
    <?php } ?>
  </ul>
<?php }

function pagination2($page,$num,$count) {
  $html = '';
  $html .= '<ul>';
  if($page > 1) {
    $html .= '<li><a href="index.php?page='.($page - 1).'">Précédent</a></li>';
  }
  if($page*$num < $count) {
    $html .= '<li><a href="index.php?page='.($page + 1).'">Suivant</a></li>';
  }
  $html .= '</ul>';
  return $html;
}

function formatageDate($valueDate)
{
  return date('d/m/Y à H:i',strtotime($valueDate));
}

function formatageDate2($valueDate)
{
  return date('d/m/Y',strtotime($valueDate));
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function isLogged()
{
  if(!empty($_SESSION['user'])) {
    if(!empty($_SESSION['user']['id']) && is_numeric($_SESSION['user']['id'])) {
      if(!empty($_SESSION['user']['prenom'])) {
        if(!empty($_SESSION['user']['role'])) {
          if($_SESSION['user']['role'] == 'abonne' || $_SESSION['user']['role'] == 'admin') {
            if (!empty($_SESSION['user']['avatar'])) {
              if(!empty($_SESSION['user']['ip']) && $_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
                return true;
              }
            }
          }
        }
      }
    }
  }
  return false;
}
