<?php
  require_once "vendor/autoload.php";
  use Google\Cloud\Translate\V2\TranslateClient;
  try {
    $translate = new TranslateClient([
        'keyFilePath' => './tidalfusion.json'
    ]);
    $result = $translate->translate($_POST['text'], [
      'target' => 'ar'
    ]);
    echo json_encode($result);
    // [source] => en [input] => Hello world! [text] => مرحبا بالعالم! [model] => )
} catch(Exception $e) {
    echo $e->getMessage();
}
?>
