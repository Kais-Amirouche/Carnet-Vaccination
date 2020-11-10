<?php
function debug($tableau)
{
  echo '<pre>';
  print_r($tableau);
  echo '</pre>';
}

function cleanXss($value){
  return trim(strip_tags($value));
}

function formatageDate($valueDate)
{
  return date('d/m/Y à H:i',strtotime($valueDate));
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



function ValidationText($errors,$data,$key,$min,$max)
{
  if(!empty($data)) {
    if(mb_strlen($data) < $min) {
      $errors[$key] = 'Min '.$min.' caractères';
    } elseif(mb_strlen($data) > $max) {
      $errors[$key] = 'Max '.$max.' caractères';
    }
  } else {
    $errors[$key] = 'Veuillez renseigner ce champ';
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
