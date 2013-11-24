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
     * percent of members to create per generation
     * @var float
     */
    protected $populationIncrement = 0.2;

    /**
     * percent of members to mutate per generation
     * @var float
     */
    protected $populationMutatePercent = 0.2;

	/**
     * gene mutate percent
     * @var float
     */
    protected $geneMutatePercent = 0.2;
    
    /**
     * number of evolved generations
     * @var integer
     */
    protected $generations = 0;

    /**
     * maximum number of generations
     * @var integer
     */
    protected $maxGenerations = 1000000;

    /**
     * member item class
     * @var string
     */
    protected $memberClass = 'Member';

    /**
     * get population
     * @return array
     */
    public function getPopulation()
    {
        return $this->population;
    }
    
    /**
     * set population
     * @param array $population
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
        $this->population[$index] = null;
        unset($this->population[$index]);
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
     * set percent of members to create each generation
     * @param float $populationIncrement 
     * @return Evolution
     */
    public function setPopulationIncrement($populationIncrement)
    {
        $this->populationIncrement = $populationIncrement;

        return $this;
    }

    /**
     * get percent of members to mutate
     * @return float
     */
    public function getPopulationMutatePercent()
    {
        return $this->populationMutatePercent;
    }
    
    /**
     * set percent of members to mutate
     * @param float $populationMutatePercent 
     * @return Evolution
     */
    public function setPopulationMutatePercent($populationMutatePercent)
    {
        $this->populationMutatePercent = $populationMutatePercent;

        return $this;
    }
    
    /**
     * set gene mutate percent 0..100
     * @param float $geneMutatePercent
     * @return Member
     */
    public function setGeneMutatePercent($geneMutatePercent)
    {
        $this->geneMutatePercent = $geneMutatePercent;
        
        return $this;
    }

    /**
     * get gene mutate percent
     * @return float
     */
    public function getGeneMutatePercent()
    {
        return $this->geneMutatePercent;
    }
    
    /**
     * get number of generations 
     * @return integer
     */
    public function getGenerations()
    {
        return $this->generations;
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
    
    /**
     * get maximum number of generations
     * @param integer $maxGenerations 
     * @return int
     */
    public function getMaxGenerations()
    {
        return $this->maxGenerations;
    }
    
    /**
     * set maximum number of generations
     * @param integer $maxGenerations 
     * @return Evolution
     */
    public function setMaxGenerations($maxGenerations)
    {
        $this->maxGenerations = $maxGenerations;

        return $this;
    }
    
    /**
     * get member class
     * @return string
     */
    public function getMemberClass()
    {
        return $this->memberClass;
    }
    
    /**
     * set member class
     * @param striing $memberClass 
     * @return Evolution
     */
    public function setMemberClass($memberClass)
    {
        $this->memberClass = $memberClass;

        return $this;
    }
    
    /**
     * get target
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }
    
    /**
     * set target
     * @param string $target 
     * @return Evolution
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }
    
    public function __construct()
    {
        return $this;
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
    protected function memberFactory()
    {
        $memberClass = __NAMESPACE__ . '\\' . $this->getMemberClass();
        $reflectionClass = new \ReflectionClass($memberClass);
        $member = $reflectionClass->newInstanceArgs(array('evolution'=>$this));
        
        return $member;
    }

    /**
     * create inital population
     * @return Evolution
     */
    protected function initPopulation()
    {
        for ($i = 0; $i < $this->getPopulationSize(); $i ++) {
            $this->setMember($i, $this->memberFactory());
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
        $this->computeFitness()->sort()->crossover()->mutate();
        $this->debugPopulation();
    	
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
            $this->getMember($i)->computeFitness();
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
        usort($this->population, function (Member $a, Member $b)
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
        for ($i = 0; $i < $this->getPopulationIncrement() * $this->getPopulationSize(); $i++) {
            $newMember = $this->getMember($this->getPopulationCount() - 1 - $i);
            $this->getMember($i)->crossover($this->getMember($i+1), $newMember);
        }
        
        return $this;
    }

    /**
     * mutate population
     * @uses getPopulationMutatePercent()
     * @uses getRandomMember()
     * @uses Member::mutate()
     * @return Evolution
     */
    protected function mutate()
    {
        for ($i = 0; $i < $this->getPopulationMutatePercent(); $i++) {
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
        if ($this->getGenerations() >= $this->getMaxGenerations() || $this->getMember(0)->isPerfect()) {
            
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
        echo($message);
        
        return $this;
    }
    
    /*
     * debug population fitness
     * @return Evolution
     */
    protected function debugPopulation()
    {
    	
    	for($i = 0; $i < 1; $i ++){
        	$this->debug ($this->debugMemory() . '|' . $this->getPopulationSize(). '|'. $this->getPopulationIncrement() . '|'. $this->getPopulationMutatePercent() . '|' .$this->getGeneMutatePercent() . '|' . $this->getGenerations().'|'.$this->getMember($i)->getFitness().'|'.$this->getMember($i)->getGeneToString() . PHP_EOL);
    	}
    	//$this->debug(PHP_EOL. PHP_EOL. PHP_EOL);
    	return $this;
    }
    
    protected function debugMemory()
	{
	    $size = memory_get_usage(true);
		$unit = array('b','kb','mb','gb','tb','pb');
	    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	}
}
