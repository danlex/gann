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

class MemberSudoku extends Member
{

    protected $sudokuSize = 3;
    
    public function getSudokuSize()
    {
    	return $this->sudokuSize;
    }
    
	public function getSudokuSize2()
    {
    	return pow($this->sudokuSize, 2);
    }

	public function getSudokuSize3()
    {
    	return pow($this->sudokuSize, 3);
    }
    
	public function getSudokuSize4()
    {
    	return pow($this->sudokuSize, 4);
    }
	
	public function __construct(Evolution $evolution)
    {
        parent::__construct($evolution);
        $this->setGeneSize($this->getSudokuSize4());
    }
    
    /**
     * (non-PHPdoc)
     * @see Gann\Ga.Member::getGeneToString()
     */
    public function getGeneToString()
    {
        $geneToString = PHP_EOL;
        for($i = 0; $i < $this->getGeneSize(); $i ++){
            if ($i % $this->getSudokuSize2() === 0){
            	$geneToString .= PHP_EOL;
            }
        	if ($this->getGeneItem($i) < 10){
        		$geneToString .= '0';
        	}
            $geneToString .= $this->getGeneItem($i);
        	$geneToString .= ' ';
        	
        }
        $geneToString .= PHP_EOL;
        return $geneToString;
    }
    
    /**
    * (non-PHPdoc)
    * @see Gann\Ga.Member::setRandomGene()
    */
    public function setRandomGene()
    {
        for($i=0; $i < $this->getGeneSize(); $i++){
            $this->setGeneItem($i, rand(1, $this->getSudokuSize2()));
        }
        
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see Gann\Ga.Member::mutate()
     */
    public function mutate()
    {
        for ($i = 0; $i < $this->getEvolution()->getGeneMutatePercent() * $this->getGeneSize(); $i ++) {
            $randomIndex = rand(0, $this->getGeneSize()-1);
            $this->setGeneItem($randomIndex, rand(1, $this->getSudokuSize2()));
        }

        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see Gann\Ga.Member::crossover()
     */
    public function crossover($memberY, $memberZ)
    {
        $memberY2 = $this->getEvolution()->getRandomMember();
    	$randomIndex = rand(0, $this->getGeneSize() - 1);
        for ($i = 0; $i < $randomIndex; $i ++) {
            $memberZ->setGeneItem($i, $this->getGeneItem($i));
        }

        for ($i = $randomIndex; $i < $this->getGeneSize(); $i ++) {
            $memberZ->setGeneItem($i, $memberY2->getGeneItem($i));
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
        $boxes = array();
        for ($i = 0; $i < $this->getSudokuSize2(); $i ++) {
        	//line
        	$box = array();
        	for ($j = 0; $j < $this->getSudokuSize2(); $j ++) {
        		$box[] = $i * $this->getSudokuSize2() + $j;
        	}
        	$boxes[] = $box;
        	
        	//column
        	$box = array();
        	for ($j = 0; $j < $this->getSudokuSize2(); $j ++) {
        		$box[] = $i + $j * $this->getSudokuSize2();
        	}
        	$boxes[] = $box;
        	
        	//box
        	
        }
        
        for ($line = 0; $line < $this->getSudokuSize(); $line ++) {
        	for ($column = 0; $column < $this->getSudokuSize(); $column ++) {
	        	$box = array();
	        	for ($j = 0; $j < $this->getSudokuSize(); $j ++) {
	        		for($k = 0; $k < $this->getSudokuSize(); $k ++){
	        			$box[] = $line * $this->getSudokuSize3() +  $column * $this->getSudokuSize() + ($j * $this->getSudokuSize2()) + $k;
	        		}
	        	}
	        	$boxes[] = $box;
        	}
        }
        /*
         00 01 02 03 04 05 06 07 08
         09 10 11 12 13 14 15 16 17
         18 19 20 21 22 23 24 25 26
         27 28 29 30 31 32 33 34 35
         36 37 38 39 40 41 42 43 44
         45 46 47 48 49 50 51 52 53
         54 55 56 57 58 59 60 61 62
         63 64 65
         */
        $numbers = array();
        foreach ($boxes as $box) {
            $fitness += $this->countNotUnique($box);
        }
        $this->setFitness($fitness);
        
        return $this;
    }
    
    public function countNotUnique($numbers)
    {
    	$countNotUnique = 0;
        $lineHash = array();
        for ($i = 0; $i < count($numbers); $i ++) {
            if(isset($lineHash[$this->getGeneItem($numbers[$i])])){
            	$countNotUnique ++; 
            } else {
            	$lineHash[$this->getGeneItem($numbers[$i])] = $numbers[$i];
            }
        }
        return  $countNotUnique;
    }
    
    /**
     * (non-PHPdoc)
     * @see Gann\Ga.Member::isPerfect()
     */
    public function isPerfect()
    {
    	return $this->getFitness() == 0;
    }
}
