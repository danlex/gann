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

abstract class Member
{
    /**
     * @var Evolution
     */
    protected $evolution = NULL;
    
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
    protected $geneSize = NULL;

    /**
     * get evolution
     * @return Evolution
     */
    public function getEvolution()
    {
        return $this->evolution;
    }

    /**
     * set evolution
     * @param Evolution $evolution
     * @return Member
     */
    public function setEvolution(Evolution $evolution)
    {
        $this->evolution = $evolution;

        return $this;
    }
    
    /**
     * set member gene
     * @param Array $gene
     */
    public function setGene($gene)
    {
        $this->gene = $gene;
        $this->geneSize = count($gene);

        return $this;
    }
    
    /**
     * get member gene
     */
    public function getGene()
    {
        return $this->gene;
    }

    /**
     * set gene size
     * @param integer $geneSize
     * @return Member
     */
    public function setGeneSize($geneSize)
    {
        $this->geneSize = $geneSize;

        return $this;
    }

    /**
     * get gene size
     * @return integer
     */
    public function getGeneSize()
    {
        return $this->geneSize;
    }
    
    /**
     * set gene item by index
     * @param integer $index
     * @param integer $geneItem
     * @return string
     */
    public function setGeneItem($index, $geneItem)
    {
        $this->gene[$index] = $geneItem;
    }
    

    /**
     * get gene item by index
     * @param integer $index
     * @return string
     */
    public function getGeneItem($index)
    {
        if(!isset($this->gene[$index])){
            throw new \Exception("Gene index $index does not exist.");
        }
        return $this->gene[$index];
    }

    /**
     * set member fitness
     * @param float $fitness
     * @return Member
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;

        return $this;
    }

    /**
     * get fitness
     * @return float
     */
    public function getFitness()
    {
        return $this->fitness;
    }


    public function __construct(Evolution $evolution)
    {
        $this->setEvolution($evolution);
        
        return $this;
    }
    
    /**
     * 
     * crossover between curent member and memberY
     * select random index 0 to gene size
     * copy from current member gene from index 0 up to random index
     * copy from second member gene from random index to gene size
     * @param Member $memberY
     * @param Member $memberZ
     * @return Member
     */
    public function crossover($memberY, $memberZ)
    {
        $randomIndex = rand(0, $this->getGeneSize() - 1);
        for ($i = 0; $i < $randomIndex; $i ++) {
            $memberZ->setGeneItem($i, $this->getGeneItem($i));
        }

        for ($i = $randomIndex; $i < $this->getGeneSize(); $i ++) {
            $memberZ->setGeneItem($i, $memberY->getGeneItem($i));
        }
        return $this;
    }
    
    /**
     * compute gene as string
     * @uses getGeneSize()
     * @uses getGeneItem()
     * @return string
     */
    abstract public function getGeneToString();
    
    /**
    * Generate random gene
    * array(0, 1, 1)
    */
    abstract public function setRandomGene();
    
    /**
     * compute member fitness
     * @return Member
     */
    abstract public function computeFitness();
    
    /**
     * mutate member
     * @return Member
     */
    abstract public function mutate();
    
    /**
     * member touched the target
     * @return Member
     */
    abstract public function isPerfect();
}
