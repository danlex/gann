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

class Evolution
{
    /**
     * the list of members
     * @var array
     */
    protected $population = NULL;
    
    /**
     * @var integer
     */
    protected $populationSize = 1000;
    
    /**
     * number of members to create per generation
     * @var integer
     */
    protected $populationIncrement = 900;

    /**
     * number of members to mutate per generation
     * @var integer
     */
    protected $populationMaxMutate = 900;

    /**
     * number of evolved generations
     * @var integer
     */
    protected $generations = 0;

    /**
     * maximum number of generations
     * @var integer
     */
    protected $maxGenerations = 10000;

    /**
     * get population
     * @return int
     */
    public function getPopulation()
    {
        return $this->population;
    }
    
    /**
     * set population
     * @return Evolution
     */
    public function setPopulation($population)
    {
        $this->population = $population;
        
        return $this;
    }
    
    /**
     * get population count
     * @return int
     */
    public function getPopulationCount()
    {
        return count($this->population);
    }
    
    /**
     * get population member by index
     * @param integer $index
     * @return Member
     */
    public function getMember($index)
    {
        return $this->population[$index];
    }
    
    /**
     * get random population member
     * @return Member
     */
    public function getRandomMember()
    {
        return $this->population[rand(0, $this->getPopulationCount() - 1)];
    }
    
    /**
     * get population member
     * @param int $index
     * @param Member $member
     * @return Evolution
     */
    public function setMember($index, Member $member)
    {
        $this->population[$index] = $member;
        return $this;
    }
    
    /**
     * get population size
     * @return int
     */
    public function getPopulationSize()
    {
        return $this->populationSize;
    }
    
    /**
     * set population size
     * @param integer $populationSize 
     * @return Evolution
     */
    public function setPopulationSize($populationSize)
    {
        $this->populationSize = $populationSize;

        return $this;
    }
    
     /**
     * get population size
     * @return int
     */
    public function getPopulationIncrement()
    {
        return $this->populationIncrement;
    }
    
    /**
     * set number of inputs
     * @param integer $populationIncrement 
     * @return Evolution
     */
    public function setPopulationIncrement($populationIncrement)
    {
        $this->populationIncrement = $populationIncrement;

        return $this;
    }

    /**
     * get number of members to mutate
     * @param integer $populationMaxMutate 
     * @return int
     */
    public function getPopulationMaxMutate($populationMaxMutate)
    {
        return $this->populationMaxMutate;
    }
    
    /**
     * set number members to mutate
     * @param integer $populationMaxMutate 
     * @return Evolution
     */
    public function setPopulationMaxMutate($populationMaxMutate)
    {
        $this->populationMaxMutate = $populationMaxMutate;

        return $this;
    }
    
    /**
     * get number of generations 
     * @return integer
     */
    public function getGenerations()
    {
        return $this->generations = $generations;
    }
    
    /**
     * set number of generations
     * @param integer $generations 
     * @return Evolution
     */
    public function setGenerations($generations)
    {
        $this->generations = $generations;

        return $this;
    }
    
    /**
     * init generations
     * @param integer $generations 
     * @return Evolution
     */
    public function initGenerations()
    {
        $this->generations = 0;

        return $this;
    }
    
    /**
     * increment number of generations
     * @param integer $generations 
     * @return Evolution
     */
    public function incrementGenerations()
    {
        $this->generations ++;

        return $this;
    }
    
    public function __construct($populationSize = 10, $populationIncrement = 2, $populationMaxMutate = 2, $maxGenerations = 100)
    {
        $this->setPopulationSize($populationSize);
        $this->setPopulationIncrement($populationIncrement);
        $this->setPopulationMaxMutate($populationMaxMutate);
        $this->setGenerations($generations);
    }
    
    /**
     * 
     * Start evolution
     * @uses initPopulation()
     * @uses nextGeneration()
     * @return Evolution
     */
    public function evolve()
    {
        $this->initGenerations()->initPopulation()->nextGeneration();
        
        return $this;
    }
    
    /**
     * create inital population
     * @return Evolution
     */
    protected function initPopulation()
    {
        for ($i = 0; $i < $this->getPopulationSize(); $i ++) {
            $this->setMember($i, new Member());
            $this->getMember($i)->setRandomGene();
        }
        
        return $this;
    }

    /**
     * 
     * selection of the fitest
     * @uses sortPopulation()
     * @return Evolution
     */
    protected function selection()
    {
        $thi->computeFitness()->sort()->crossover()->mutate();

        $this->debug ($this->getGenerations().'|'.$this->getMember(0)->getFitness().PHP_EOL);
        
        return $this;
    }
    
    /**
     * compute fitness for each member
     * @uses getPopulation()
     * @uses Member::getFitness()
     * @return Evolution
     */
    protected function computeFitness()
    {
        for ($i = 0; $i < $this->getPopulationSize(); $i ++) {
            $this->getMember($i)->computeFitness($this);
        }
        
        return $this;
    }

    /**
     * sort population by fitness
     * @uses getPopulation()
     * @uses Member::getFitness()
     * @return Evolution
     */
    protected function sort()
    {
        usort($this->getPopulation(), function (Member $a, Member $b)
        {
            if ($a->getFitness() == $b->getFitness()) {
                return 0;
            }
    
            return ($a->getFitness() > $b->getFitness()) ? +1 : -1;
        });
        
        return $this;
    }

    /**
     * crossover population
     * @uses getPopulation()
     * @uses Member::getFitness()
     * @return Evolution
     */
    protected function crossover()
    {
        for ($i = 0; $i < $this->getPopulationIncrement(); $i++) {
            $newMember = $this->getMember($i)->crossover($this->getMember($i+1));
            $this->setMember($this->getPopulationCount() - 1 - $i, $newMember);
        }
        
        return $this;
    }

    /**
     * mutate population
     * @uses getPopulationMaxMutate()
     * @uses getRandomMember()
     * @uses Member::mutate()
     * @return Evolution
     */
    protected function mutate()
    {
        for ($i = 0; $i < $this->getPopulationMaxMutate(); $i++) {
            $this->getRandomMember()->mutate();
        }
        
        return $this;
    }

    
    /**
     * 
     * Decide if we terminate the current evolution
     * @uses getGenerations()
     * @uses getMaxGenerations()
     * @return Evolution
     */
    protected function termination()
    {
        if ($this->getGenerations() > $this->getMaxGenerations()) {
            
            return true;
        }

        return false;
    }

    /**
     * initiate selection of next generation
     * @uses selection()
     * @uses termination()
     * @uses nextGeneration()
     * @return Evolution
     */
    protected function nextGeneration()
    {
        $this->selection();
        $this->incrementGenerations();
        if ($this->termination()) {
            return $this;
        }
        $this->nextGeneration();
    }
    
    /**
     * echo message
     * @param string $message
     * @return Evolution
     */
    protected function debug($message)
    {
        echo($str);
        
        return $this;
    }
}
