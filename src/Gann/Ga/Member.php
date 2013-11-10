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

class Member
{
	/**
	 * @var float
	 */
	protected $fitness = NULL;
    
    /**
	 * @var array
	 */
	protected $gene = NULL;
    
	/**
	 * @var int
	 */
	protected $geneCount = NULL;
    
	/**
	 * @var int
	 */
	protected $mutateCount = 90;

    public function __construct()
    {
    }

    public function setGene($value)
    {
        $this->gene = $value;
        $this->geneCount = count($value);

        return $this;
    }

    public function getGene()
    {
        return $this->gene;
    }

    public function setGeneCount($value)
    {
        $this->geneCount = $value;

        return $this;
    }

    public function getGeneCount()
    {
        return $this->geneCount;
    }

    public function getMutateCount()
    {
        return $this->mutateCount;
    }

    /**
    * Generate random gene
    * array(0, 1, 1)
    */
    public function setRandomGene($geneConfig = null)
    {
        $randomGene = array();
        $crtMapCount = $this->getOperatorCount();
        $startIndex = $this->getInputCount();
        for ($i = 0; $i < $this->getNodeCount(); $i ++) {
            $randomIndex = $i;
            $randomGene[$randomIndex] = rand(0, $randomIndex - 1);
        }
        $this->setGene($randomGene);

        return $this;
    }
    
    public function setFitness($value)
    {
        $this->fitness = $value;

        return $this;
    }

    public function getFitness()
    {
        return $this->fitness;
    }

    public function computeFitness($population = NULL)
    {
        $fitness = 0;
        
        $this->setFitness($fitness);

        return $this;
    }

    public function mutate()
    {
        for ($i = 0; $i < $this->getMutateCount(); $i ++) {
            $randomIndex = rand(0, $this->getGeneCount()-1);
            $this->gene[$randomIndex] = rand(0, $randomIndex - 1);
        }

        return $this;
    }

    public function crossover($memberY)
    {
        $geneX = $this->getGene();
        $geneY = $memberY->getGene();
        $geneZ = array();
        $randomIndex = rand(0, $this->getGeneCount() - 1);
        for ($i = 0; $i < $randomIndex; $i ++) {
            $geneZ[$i] = $geneX[$i];
        }

        for ($i = $randomIndex; $i < $this->getGeneCount(); $i ++) {
            $geneZ[$i] = $geneY[$i];
        }
        $memberZ = new Member();
        $memberZ->setGene($geneZ);
        return $memberZ;
    }
}
