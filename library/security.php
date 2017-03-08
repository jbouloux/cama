<?php
  function hash_salt($str){
    return (hash('whirlpool', ('banane'.$str.'kiwi')));
  }
?>
