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

namespace Gann\Ga;

/**
* @package Gann
* @access public
*/

class MemberHelloWorld extends Member
{

    public function __construct(Evolution $evolution, $geneSize = 8, $mutateSize = 0.9)
    {
    	$geneSize = strlen($evolution->getTarget());
    	parent::__construct($evolution, $geneSize, $mutateSize);
    }
    
	
	/**
    * (non-PHPdoc)
    * @see Gann\Ga.Member::setRandomGene()
    */
    public function setRandomGene($geneConfig = null)
    {
    	$values = array_merge(range(32, 126));
        $max = count($values) - 1;
        $randomGene = array();
        for($i=0; $i < $this->getGeneSize(); $i++){
        	$this->setGeneItem($i, $values[mt_rand(0, $max)]);
        }
        $this->setGene($randomGene);
		
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see Gann\Ga.Member::mutate()
     */
    public function mutate()
    {
        for ($i = 0; $i < $this->getMutateSize() * $this->getGeneSize(); $i ++) {
            $randomIndex = rand(0, $this->getGeneSize()-1);
            $this->setGeneItem($randomIndex, $this->getGeneItem($randomIndex) + rand(-1, 1));
        }

        return $this;
    }

	/**
     * (non-PHPdoc)
     * @see Gann\Ga.Member::computeFitness()
     */
    public function computeFitness()
    {
    	$target = $this->getEvolution()->getTarget();
    	
        $fitness = 0;
    	for ($i = 0; $i < $this->getGeneSize(); $i ++) {
            $fitness += pow(ord($target[$i]) - $this->getGeneItem($i), 2);
        }
        $this->setFitness($fitness);
		
        return $this;
    }
}
