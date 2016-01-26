<?php

/*

// Spaceship

usort($array, function ($a, $b) {
  if ($a < $b) {
    return -1;
  }
  elseif ($a > $b) {
    return 1;
  }
  else {
    return 0;
  }
});

usort ($array, function($a, $b) {
  return $a <=> $b;
});

usort($people, function (Person $a, Person $b) {
  if ($a->lastName() < $b->lastName()) {
    return -1;
  }
  elseif ($a->lastName() > $b->lastName()) {
    return 1;
  }
  else {
    if ($a->firstName() < $b->firstName()) {
      return -1;
    }
    elseif ($a->firstName() > $b->firstName()) {
      return 1;
    }
    else {
      return 0;
    }
  }
});

usort($people, function (Person $a, Person $b) {
  return $a->lastName() < $b->lastName() ? -1
    : ($a->lastName() > $b->lastName() ? 1
      : $a->firstName() < $b->firstName() ? -1
        : ($a->firstName() > $b->firstName() ? 1 : 0));
});


usort($people, function (Person $a, Person $b) {
  return [$a->lastName(), $a->firstName()] <=> [$b->lastName(), $b->firstName()];
});

*/

/*
// NULL Coalesce

$username = $username ? $username : 'Anonymous';

$username = $username ?: 'Anonymous';

// But what if $username doesn't exist?

$username = isset($username) && !is_null($username) ? $username : 'Anonymous';

$username = $username ?? 'Anonymous';

$username = $submitted['username'] ?? $user->username() ?? 'Anonymous';

// ?? checks setness, not truthiness

*/

// Engine exceptions

try {
  nonexistant_function();
}
catch (\Error $e) {
  print "The error was " . $e->getMessage();
}

function doStuff(Request $r) {
  // ...
}

$u = new User();

try {
  doStuff($u);
}
catch (\TypeError $e) {
  print "Wrong variable type, dummy." . PHP_EOL;
}

try {
  include 'buggy_file.php';
}
catch (\ParseError $e) {
  $logger->error("That file is buggy!");
}

set_exception_handler(function(\Exception $e) {

});
