<?php
  namespace App\Service;

  // Filesystem
  use Symfony\Component\Filesystem\Filesystem;
  use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

  class AddMessage {

    public function sendMessage($message, $type) {
      // Set paths
      if($type === 'user') {
        $path = './data/';
        $log = 'outgoing.json';
      } elseif ($type === 'bot') {
        $path = './public/data/';
        $log = 'incoming.json';
      }
      // DateTime
      $timeStamp = strtotime("now");
      // New Array
      $reqArray = array('type' => ''.$type.'', 'msg' => ''.$message.'', 'time' => ''.$timeStamp.'');
      // Previous
      $chatList = file_get_contents($path.'conversation.json');
      $json = json_decode($chatList, true);
      // Join
      array_push($json['messages'], $reqArray);
      $newChat = json_encode($json);
      // Append to files
      $fs = new Filesystem();
      $fs->dumpFile($path.'conversation.json', $newChat);
      $fs->dumpFile($path.$log, $newChat);
      // Return
      if($type === 'bot') {
        return 'Successfully sent as chat bot.';
      }
    }
  }
?>