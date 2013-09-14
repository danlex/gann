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
* @package GeneticNeuralNetwork
*/


namespace GeneticNeuralNet;

/**
* @package GeneticNeuralNet
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
	protected $ouputLayer;

	/**
	* @param integer $hiddenLayerSize (Default: 1)
	* @param integer $neuronsPerLayerSize (Default: 6)
	* @param integer $outputSize (Default: 1)
	* @usses createHiddenLayers()
	* @usses createOuputLayer()
	*/
	public function __construct($inputSize = 2, $hiddenLayerSize = 1, $neuronsPerLayerSize = 6, $outputSize = 1)
	{
		$this->inputSize = $inputSize;
		$this->hiddenLayerSize = $hiddenLayerSize;
		$this->neuronsPerLayerSize = $neuronsPerLayerSize;
		$this->outputSize = $outputSize;

		$this->createOutputLayer();
		$this->createHiddenLayers();
	}

	/**
	* @usses Layer::setInputs()
	* @usses Layer::activate();
	* @usses Layer::getOutputs();
	*/
	public function activate()
	{
		$inputs = $this->inputs;
		foreach ($this->hiddenLayers as $hiddenLayer){
			$inputs = $hiddenLayer->setInputs($inputs)->activate()->getOutputs();
        }
		$this->ouputs = $this->outputLayer->setInputs($inputs)->activate()->getOutputs();
		return $this;
	}

	/**
	* @usses Layer::__construct()
	*/
	protected function createHiddenLayers()
	{
		for ($i = 0; $i < $this->hiddenLayerSize; $i ++){
            $this->hiddenLayers[$i] = new Layer($this->inputSize, $this->neuronsPerLayerSize);
        }
		return $this;
	}

	/**
	* @usses Layer::__construct()
	*/
	protected function createOutputLayer()
	{
		$this->outputLayer = new Layer($this->inputSize, $this->outputSize);
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
    * @param array $outputs
    * @return Network
    */
	protected function setOutputs($outputs)
	{
		$this->outptuts = $outputs;
		return $this;
	}

	public function getOutputs()
	{
		return $this->outputs;
	}
}
