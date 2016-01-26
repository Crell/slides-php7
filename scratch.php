<?php

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
