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
* @version DNN Version 0.1 by Alexandru Dan
* @copyright Copyright (c) 2013 by Alexandru Dan
* @package Gann
*/

namespace Gann\Ann;

/**
* @package Gann
* @access private
*/

class Layer
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
	protected $neuronsPerLayerSize;

	/**
    * @var Layer
    */
    protected $nextLayer;

    
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
	protected $neurons;
	
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
    protected $trainMomentum;
    
	/**
     * set number of inputs
     * @param integer $inputSize 
     * @return Layer
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
     * @return Layer
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
     * set number of neurons per hidden layer
     * @param integer $neronsPerLayerSize 
     * @return Layer
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
    * @param Layer $nextLayer
    * @return Layer
    */
    public function setNextLayer($nextLayer)
    {
        $this->nextLayer = $nextLayer;
        return $this;
    }
    
	/**
    * @return Layer
    */
    public function getNextLayer()
    {
        return $this->nextLayer;
    }

    /**
    * set Layer training momentum
    * @param float $trainMomentum
    * @return Layer
    */
    public function setTrainMomentum($trainMomentum)
    {
        $this->trainMomentum = $trainMomentum;
        return $this;
    }

	/**
    * get network training momentum
    * @return float
    */
    public function getTrainMomentum()
    {
        return $this->trainMomentum;
    }

    /**
	* @param array $inputs
	* @usses Neuron::setInputs()
	* @return Layer
	*/
	public function setInputs($inputs)
	{
		$this->inputs = $inputs;
		foreach ($this->neurons as $neuron){
			$neuron->setInputs($inputs);
		}
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
    * @return Layer
    */
    protected function setOutputs($outputs)
    {
        $this->outptuts = $outputs;
        return $this;
    }
	
	/**
	* @return array
	*/
	public function getOutputs()
	{
		return $this->outputs;
	}

    /**
    * @return array
    */
    public function getNeurons()
    {
        return $this->neurons;
    }
    
	/**
    * @param array $trainInputs
    * @return Layer
    */
    public function setTrainInputs($trainInputs)
    {
        $this->trainInputs = $trainInputs;
        return $this;
    }
    
    /**
    * @param array $trainOutputs
    * @return Layer
    */
    public function setTrainOutputs($trainOutputs)
    {
        $this->trainOutputs = $trainOutputs;
        return $this;
    }

    public function getTrainOutput($key)
    {
        return $this->trainOutputs[$key];    
    }

	/**
	* @param int $inputSize
	* @param int $neuronsPerLayerSize
	* @uses createNeurons()
	*/
	public function __construct($inputSize, $neuronsPerLayerSize)
	{
		$this->inputSize = $inputSize;
		$this->neuronsPerLayerSize = $neuronsPerLayerSize;
		$this->createNeurons();
	}

	/**
	* @usses Neuron::__construct()
	* @return Layer
	*/
	public function createNeurons()
	{
		for($i = 0; $i < $this->neuronsPerLayerSize; $i ++){
			$this->neurons[$i] = new Neuron($this->inputSize);
		}
		return $this;
	}

	/**
	* @usses Neuron::activate()
	* @usses Neuron::getOutput()
	* @return Layer
	*/
	public function activate()
	{
		$outputs = array();
		foreach($this->getNeurons() as $key => $neuron){
			$neuron->activate();
			$outputs[$key] = $neuron->getOutput();
		}
		$this->setOutputs($outputs);
		return $this;
	}

    

    /**
    * @usses Neuron::setDelta()
    * @usses Neuron::getOutput()
    * @usses Neuron::getTrainOutput()
    * @return Layer
    */
    public function calculateOutputDeltas()
    {
        foreach($this->getNeurons() as $key => $neuron) {
            $output = $neuron->getOutput();
            $delta = $output * ($this->getTrainOutput($key) - $output) * (1 - $output);
            $neuron->setDelta($delta);
        }
        return $this;
    }

    /**
    * @uses Neuron::setDelta()
    * @uses Neuron::getWeight()
    * @uses Neuron::getDelta()
    * @uses Neuron::getOutput()
    * @uses getNeurons()
    * @return Layer
    */

    public function calculateHiddenDeltas()
    {
        $neuronsNextLayer = $this->getNextLayer()->getNeurons();
        /* @var $neuron Neuron */
        foreach($this->getNeurons() as $key => $neuron) {
            $sum = 0;
            /* @var $neuronNextLayer Neuron */
            foreach($neuronsNextLayer as $neuronNextLayer){
                $sum += $neuronNextLayer->getWeight($key) * 
                        $neuronNextLayer->getDelta() * $this->getTrainMomentum();
            }
            $output = $neuron->getOutput();
            $delta = $output * (1 - $output) * $sum;

            $neuron->setDelta($delta);
        }
        return $this;
	}

    /**
    * @uses Neuron::adjustWeights()
    */
    public function adjustWeights()
    {
        foreach($this->getNeurons() as $neuron)
            $neuron->adjustWeights();
    }
}
