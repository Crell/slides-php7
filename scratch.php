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


// CSPRNG

$junk = random_bytes(16);

$val = random_int(1, 100);

// Expectations

function doStuff($def) {
  assert(is_array($def) && isset($def['key']) && isset($def['value']), 'Invalid def');
  // ...
}

function doStuff($def) {
  assert('is_array($def) && isset($def[\'key\']) && isset($def[\'value\'])', 'Invalid def');
  // ...
}


ini_set('assert.exception', 1);
ini_set('zend.assertions', 1);

class InvalidDefStruct extends AssertionError {}

function doStuff(array $def) {
  assert(isset($def['key']) && isset($def['value']), new InvalidDefStruct('Invalid def'));
  // ...
}

// Generators

class RemoteSource implements Iterator {
  protected $key;

  protected $current;

  protected $client;

  public function __construct(Client $client) {
    $this->client = $client;
    $this->key = 0;
  }

  public function current() {
    return $this->current;
  }

  public function next() {
    $this->current = $this->client->get('http://api.com/entry/' . $this->key);
    $this->key++;
  }

  public function key() {
    return $this->key;
  }

  public function valid() {
    return (bool)$this->current;
  }

  public function rewind() {
    throw new Exception();
  }
}

$result = $db->query(...);

$iterator = new AppendIterator();
$iterator->append(new RemoteSource($client));
$iterator->append($result);

foreach ($iterator as $item) {
  // Do something.
}

function getRemoteValues($client) {
  $key = 0;
  while ($val = $client->get('http://api.com/entry/' . $key++)) {
    yield $val;
  }
}

function getLocalValues() {
  foreach (db()->query(...) as $record) {
    yield $record;
  }
}

function getValues($client) {
  yield from getRemoteValues($client);
  yield from getLocalValues();
  return 'done';
}

$values = getValues($client);
foreach ($values as $item) {
  // Do stuff
}
print $val->getReturn() . PHP_EOL;

// Anonymous classes

$mock_repository = $this->getMockBuilder(ThingieRepository::class)
  ->disableOriginalConstructor()
  ->getMock();

$obj1 = new Thingie();
$obj1->setVal('abc');

$obj2 = $this->getMockBuilder(Thingie::class)
  ->disableOriginalConstructor()
  ->getMock();
$obj1->method('getVal')->willReturn('def');

$map = [
  [1, $obj1],
  [2, $obj2],
];

$mock_repository->method('load')->will($this->returnValueMap($map));

$subject = new ClassUnderTest($mock_repository);
$this->assertTrue($subject->findThings());


$fake_repository = new class extends ThingieRepository {
  public function __construct() {}

  public function load($id) {
    switch ($id) {
      case 1:
        $obj1 = new Thingie();
        $obj1->setVal('abc');
        return $obj1;
      case 2:
        return new class extends Thingie {
          public function getVal() {
            return 'def';
          }
        };
      default:
        return null;
    }
  }
};

$subject = new ClassUnderTest($fake_repository);
$this->assertTrue($subject->findThings());



new Service(new class implements LoggerInterface {
  use LoggerTrait;

  public function log($message) {
    print $message . PHP_EOL;
  }
});


new class($logger) implements ServiceInterface {
  public function __construct(LoggerInterface $logger) {
    $this->logger = $logger;
  }

  public function doServiceStuff() { }
};
