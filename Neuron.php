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
* @package GeneticNeuralNet
*/


namespace Danlex\Gann;

/**
* @package GeneticNeuralNet
* @access private
*/


class Neuron
{
	/**
	* @var int
	*/
	protected $inputsSize;
	
	/**
	* @var array
	*/
	protected $inputs;

	/**
	* @var array
	*/
	protected $weights;
	
	/**
	* @var int
	*/
	protected $output;

	public function __construct($inputsSize)
	{
		$this->inputsSize = $inputsSize;
		$this->initRandomWeights();
	}
	
	/**
	* Calculate the neuron activation
	* activation = i1*w1 + i2*wn ++ in*wn + (-1)*t
	* 
	* @return Neuron
	*/
	public function activate()
	{
		$sum = 0;
		for ($i = 0; $i < $this->inputsSize + 1; $i ++){
			$sum += $this->inputs[$i] * $this->weights[$i];
		}
		$this->output = $this->sigmoid($sum);
		return $this;
	}
	
	/**
	* return float $output
	*/
	public function getOutput(){
		return $this->output;
	}

	/**
	* @param array $inputs
	* @uses initializeWeights()
	* @return Neuron
	*/
	public function setInputs($inputs)
	{
		$this->inputs = $inputs;

		$this->inputs[] = 1; // bias

		if($this->weights === NULL){
			$this->initRandomWeights();
		}

		return $this;
	}

	/**
	* @param array $weights
	* @return DNN\Neuron
	*/
	public function setWeights($weights)
	{
		$this->weights = $weights;
		return $this;
	}

	/**
	* @return Array $weights
	*/
	public function getWeights()
	{
		return $this->weights;
	}

	/**
	* @return float $weight
	*/
	public function getWeight($i)
	{
		return $this->weight[$i];	
	}

	/**
	* Gets a random weight between [-0.25 .. 0.25]. Used to initialize the network.
	*
	* @return float A random weight
	*/
	private function getRandomWeight() 
	{
		return ((mt_rand(0, 1000) / 1000) - 0.5) / 2;
	}
	
	/**
	* Randomise the weights in the neural network
	*
	* @return Neuron
	*/
	private function initRandomWeights() 
	{
		for ($i = 0; $i < $this->inputsSize + 1; $i ++){
			$this->weight[$i] = $this->getRandomWeight();
		}
		return $this;
	}

	/**
	* Compute the sigmoid function 1 / (1+exp(-$v))
	* @param float $value
	* @return float (between near 0 and near 1)
	*/
	public static function sigmoid($value)
	{
		return 1 / (1 + exp(-1 * $value));
	}
}
