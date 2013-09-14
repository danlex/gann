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

namespace Gann\Ann;

/**
* @package GeneticNeuralNet
* @access private
*/

class Layer
{
	
	/**
	* @var int
	*/
	protected $neuronsPerLayerSize;

	/**
	* @var int
	*/
	protected $inputsSize;

	/**
	* @var array
	*/
	protected $inputs;
	
	/**
	* @var int
	*/
	protected $outputsSize;

	/**
	* @var array
	*/
	protected $neurons;
	
	/**
	* @var array
	*/
	protected $outputs;

	/**
	* @param int $inputsSize
	* @param int $neuronsPerLayerSize
	* @uses createNeurons()
	*/
	public function __construct($inputsSize, $neuronsPerLayerSize)
	{
		$this->inputsSize = $inputsSize;
		$this->neuronsPerLayerSize = $neuronsPerLayerSize;
		$this->createNeurons();
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
	public function getOutputs()
	{
		return $this->outputs;
	}

	/**
	* @usses Neuron::__construct()
	* @return Layer
	*/
	public function createNeurons()
	{
		for($i = 0; $i < $this->neuronsPerLayerSize; $i ++){
			$this->neurons[$i] = new Neuron($this->inputsSize);
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
		foreach($this->neurons as $key => $neuron){
			$neuron->activate();
			$outputs[$key] = $neuron->getOutput();
		}
		$this->outputs = $outputs;
		return $this;
	}
}
