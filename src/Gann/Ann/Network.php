<?php

/**
* Genetic Neural Net - Version 0.1
*
* <b>LICENCE</b>
*
* The BSD 2-Clause License
*
* http://opensource.org/licenses/bsd-license.php
*
* Copyright (c) 2013, Alexandru Dan
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
* 1. Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* 2. Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in the
* documentation and/or other materials provided with the distribution.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
* FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
* COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
* CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
* LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* @author Alexandru Dan <dan_lex@yahoo.com>
* @version Gann Version 0.1 by Alexandru Dan
* @copyright Copyright (c) 2013 by Alexandru Dan
* @package Gann
*/

namespace Gann\Ann;

/**
* @package Gann
* @access public
*/

class Network
{
    
    /**
     * @var integer
     */
    protected $inputSize;
    
    /**
     * @var integer
     */
    protected $outputSize;
    
    /**
     * @var integer
     */
    protected $hiddenLayerSize;

    /**
    * @var integer
    */
    protected $neuronsPerLayerSize;
    
    /**
     * @var array
     */
    protected $inputs;
    
    /**
     * @var array
     */
    protected $outputs;

    /**
     * @var array
     */
    protected $hiddenLayers;

    /**
     * @var Layer
     */
    protected $outputLayer;

    /**
     * @var array
     */
    protected $trainInputs;

    /**
     * @var array
     */
    protected $trainOutputs;

    /**
     * @var float
     */
    protected $trainOutputErrorTolerance = 0.002;

    /**
     * @var float
     */
    protected $trainLearningRate = 0.07;

    /**
     * @var float
     */
    protected $trainMomentum = 0.95;
    
    /**
     * set number of inputs
     * @param integer $inputSize 
     * @return Network
     */
    public function setInputSize($inputSize)
    {
        $this->inputSize = $inputSize;
        return $this;
    }
    
    /**
     * get number of inputs
     * @return integer
     */
    public function getInputSize()
    {
        return $this->inputSize;
    }
    
    /**
     * set number of outpus
     * @param integer $outputSize 
     * @return Network
     */
    public function setOutputSize($outputSize)
    {
        $this->outputSize = $outputSize;
        return $this;
    }
    
    /**
     * get network output size
     * @return integer
     */
    public function getOutputSize()
    {
        return $this->outputSize;
    }
    
    /**
     * set number of hidden layers
     * @return Network
     */
    public function setHiddenLayerSize($hiddenLayerSize)
    {
        $this->hiddenLayerSize = $hiddenLayerSize;
        return $this;
    }
    
    /**
     * get number of hidden layers
     * @return integer
     */
    public function getHiddenLayerSize()
    {
        return $this->hiddenLayerSize;
    }

    /**
     * set number of neurons per hidden layer
     * @param integer $neronsPerLayerSize 
     * @return Network
     */
    public function setNeuronsPerLayerSize($neuronsPerLayerSize)
    {
        $this->neuronsPerLayerSize = $neuronsPerLayerSize;
        return $this;
    }
    
    /**
     * get numer of neurons per hidden layer
     * @return integer
     */
    public function getNeuronsPerLayerSize()
    {
        return $this->neuronsPerLayerSize;
    }
    
    /**
     * @param array $inputs
     * @return Network
     */
    public function setInputs($inputs)
    {
        $this->inputs = $inputs;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * @param array $outputs
     * @return Network
     */
    public function setOutputs($outputs)
    {
        $this->outputs = $outputs;
        return $this;
    }

    public function getOutputs()
    {
        return $this->outputs;
    }
    
    /**
     * set output layer of the neural net
     * @param Layer $outputLayer
     * return Network
     */
    public function setOutputLayer(Layer $outputLayer)
    {
        $this->outputLayer = $outputLayer;
        return $this;
    }
    
    /**
     * 
     * get output layer of the neural net
     * return Layer
     */
    public function getOutputLayer()
    {
        return $this->outputLayer;    
    }
    
    /**
     * set hidden layer by index $key
     * @param integer $key
     * @param Layer $layer
     * @return Network
     */
    public function addHiddenLayer($key, Layer $layer)
    {
        $this->hiddenLayers[$key] = $layer;
        return $this;    
    }
    
    /**
     * get network hidden layers
     * @param array
     */
    public function getHiddenLayers()
    {
        return $this->hiddenLayers;    
    }
    
    /**
     * get hidden layer by index $key
     * @param Layer
     */
    public function getHiddenLayer($key)
    {
        return $this->hiddenLayers[$key];    
    }
        
    /**
     * @param array $trainInputs
     * @uses Network::setInputs()
     * @return Network
     */
    public function setTrainInputs($trainInputs)
    {
        $this->trainInputs = $trainInputs;
        $this->setInputs($trainInputs);
        return $this;
    }

    /**
     * @param array $trainOutputs
     * @uses Layer::setTrainOutputs()
     * @return Network
     */
    public function setTrainOutputs($trainOutputs)
    {
        $this->trainOutputs = $trainOutputs;
        $this->getOutputLayer()->setTrainOutputs($trainOutputs);
        return $this;
    }
    
    /**
     * get train output by key
     * @param float $key
     * @return float
     */
    public function getTrainOutput($key)
    {
        return $this->trainOutputs[$key];
    }
    
    /**
     * set network training momentum
     * @param float $trainMomentum
     * @return Network
     */
    public function setTrainMomentum($trainMomentum)
    {
        $this->trainMomentum = $trainMomentum;
        return $this;
    }

    /**
     * get network training momentum
     * @return Network
     */
    public function getTrainMomentum()
    {
        return $this->trainMomentum;
    }
    
    /**
     * set network training larning rate
     * @param float $trainLearningRate
     * @return Network
     */
    public function setTrainLearningRate($trainLearningRate)
    {
        $this->trainLearningRate = $trainLearningRate;
        return $this;
    }

    /**
     * get network training learning rate
     * @return float
     */
    public function getTrainLearningRate()
    {
        return $this->trainLearningRate;
    }
    
    public function setTrainOutputErrorTolerance($trainOutputErrorTolerance)
    {
        $this->trainOutputErrorTolerance = $trainOutputErrorTolerance;
        return $this;
    }
    
    public function getTrainOutputErrorTolerance()
    {
        return $this->trainOutputErrorTolerance;
    }
    
    /**
    * @param integer $hiddenLayerSize (Default: 1)
    * @param integer $neuronsPerLayerSize (Default: 6)
    * @param integer $outputSize (Default: 1)
    * @uses createHiddenLayers()
    * @uses createOuputLayer()
    */
    public function __construct($inputSize = 2, $hiddenLayerSize = 2, $neuronsPerLayerSize = 4, $outputSize = 1)
    {
        $this->setInputSize($inputSize);
        $this->setHiddenLayerSize($hiddenLayerSize);
        $this->setNeuronsPerLayerSize($neuronsPerLayerSize);
        $this->setOutputSize($outputSize);

        $this->createOutputLayer();
        $this->createHiddenLayers();
    }

    /**
    * @uses getInputs()
    * @uses getHiddenLayers()
    * @uses Layer::setInputs()
    * @uses Layer::activate()
    * @uses Layer::getOutputs()
    * @uses setOutputs()
    */
    public function activate()
    {
        $inputs = $this->getInputs();
        /* @var $hiddenLayer Layer */
        foreach ($this->getHiddenLayers() as $hiddenLayer){
            $hiddenLayer->setInputs($inputs);
            $hiddenLayer->activate();
            $inputs = $hiddenLayer->getOutputs();
        }
        $outputs = $this->getOutputLayer()->setInputs($inputs)->activate()->getOutputs();
        $this->setOutputs($outputs);
        return $this;
    }

    /**
    * @uses Layer::__construct()
    */
    protected function createHiddenLayers()
    {
        $inputSize = $this->getInputSize();
        $neuronsPerLayerSize = $this->getNeuronsPerLayerSize();
        for ($i = 0; $i < $this->getHiddenLayerSize(); $i ++){
            $this->addHiddenLayer($i, new Layer($inputSize, $neuronsPerLayerSize));
            $inputSize = $neuronsPerLayerSize;
        }
        return $this;
    }

    /**
     * @uses setOutputLayer()
     * @uses getNeuronsPerLayerSize()
     * @uses getOutputSize()
     * @uses Layer::__construct()
     * @return Network
     */
    protected function createOutputLayer()
    {
        $this->setOutputLayer(new Layer($this->getNeuronsPerLayerSize(), $this->getOutputSize()));
        return $this;
    }

    /**
    * @uses activate()
    * @uses Layer::calculateDeltas()
    * @uses Layer::adjustWeights()
    */
    public function train()
    {
        $this->setTrainParams();
        $this->activate();
        $this->calculateDeltas();
        $this->adjustWeights();
    }
    
    /**
     * set train learning rate and train momentum
     * @uses Layer::setLearningRate
     * @uses Layer::setTrainMomentum
     * @return Network
     */
    protected function setTrainParams()
    {
        $this->getOutputLayer()->setTrainLearningRate($this->getTrainLearningRate());
        $this->getOutputLayer()->setTrainMomentum($this->getTrainMomentum());
        foreach ($this->getHiddenLayers() as $hiddenLayer){
            $hiddenLayer->setTrainLearningRate($this->getTrainLearningRate());
            $hiddenLayer->setTrainMomentum($this->getTrainMomentum());
        }
        return $this;
    }

    /**
     * @uses getOutputLayer()
     * @uses Layer::calculateHiddenDeltas()
     * @uses getHiddenLayerSize()
     * @uses getHiddenLayer()
     * @uses getTrainMomentum()
     * @uses Layer::calculateOutputDeltas()
     * @uses Layer::setNextLayer()
     * @uses Layer::setTrainMomentum
     */
    protected function calculateDeltas()
    {
        $nextLayer = $this->getOutputLayer()->calculateOutputDeltas();     
        for ($i = $this->getHiddenLayerSize() - 1; $i >= 0; $i--){
            /* @var Layer $nextLayer */
            $nextLayer = $this->getHiddenLayer($i)->setNextLayer($nextLayer)->calculateHiddenDeltas();
        }
        return $this;
    }

    /**
     * @uses Layer::adjustWeights()
     * @return Network
     */
    protected function adjustWeights()
    {
        $this->getOutputLayer()->adjustWeights();
        /* @var Layer $hiddenLayer */
        foreach ($this->getHiddenLayers() as $key => $hiddenLayer){
            $hiddenLayer->adjustWeights();
        }
        return $this;
    }

    /**
     * @return float
     * @uses getOutputs()
     */
    public function getTrainError()
    {
        $error = 0;
        foreach($this->getOutputs() as $key => $output){
            $error += pow($output - $this->getTrainOutput($key), 2);
        }
        return $error / 2;
    }
}
