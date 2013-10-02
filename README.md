Gann - Genetic Algoritm Neural Network Train
==============================

Gann use Genetic Agorithm to train a Neural Network



Setup composer.json
-------------------
{
    "name": "danlex/ganne",
    "description": "Example using Genetic Neural Network library.",
    "keywords": ["Genetic", "neural", "network", "example"],
    "homepage": "https://github.com/danlex/ganne",
    "license": "BSD 2",
    "authors": [
        {
            "name": "Alexandru Dan",
            "email": "dan_lex@yahoo.com"
        }
    ],
    "config": {
        "vendor-dir": "vendor"
    },
    "require": {
    "php": ">=5.3.0",
        "danlex/gann": "dev-master"
    },
    "autoload": {
        "psr-0": {"Gann\\Ann": "src/"}
    }
}


Usage
-----

```php
<?php
error_reporting(E_ALL);
$loader = include "vendor/autoload.php";

use Gann\Ann\Network;

$trains = array(
        0 => array(
            'in'=>array(1,0),
            'out'=>array(1)
        ),
        1 => array(
            'in'=>array(0,1),
            'out'=>array(1)
        ),
        2 => array(
            'in'=>array(1,1),
            'out'=>array(0)
        ),
        3 => array(
            'in'=>array(0,0),
            'out'=>array(0)
        )
    );

$i = 1;
$r = 1;
$network = new Network(2, 2, 3, 1);
$network->setTrainLearningRate(0.9);
$network->setTrainOutputErrorTolerance(0.0005);
do{
    foreach($trains as $train){
        $network->setTrainInputs($train['in'])->setTrainOutputs($train['out'])->train();
        $outputs = $network->getOutputs();
        $trainOutput = $network->getTrainOutput(0);
        if ($trainOutput == ($outputs[0] < 0.5 ? 0 : 1)){
            $r ++;
        }
        $i ++;
    }
} while ($network->getTrainError() > $network->getTrainOutputErrorTolerance() && $r/$i < 0.99);
$network->setInputs(array(1,0))->activate();
$outputs = $network->getOutputs();
echo (" 0 1 ");
print_r(($outputs[0] < 0.5 ? 0 : 1));
echo("\n");
```

