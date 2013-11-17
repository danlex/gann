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

    public function __construct(Evolution $evolution)
    {
        parent::__construct($evolution);
        $this->setGeneSize(81);
    }
    
    /**
     * (non-PHPdoc)
     * @see Gann\Ga.Member::getGeneToString()
     */
    public function getGeneToString()
    {
        $geneToString = '';
        for($i = 0; $i < $this->getGeneSize(); $i ++){
            $geneToString .= $this->getGeneItem($i);
        }
        
        return $geneToString;
    }
    
    /**
    * (non-PHPdoc)
    * @see Gann\Ga.Member::setRandomGene()
    */
    public function setRandomGene()
    {
        for($i=0; $i < $this->getGeneSize(); $i++){
            $this->setGeneItem($i, rand(1, 9));
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
            $this->setGeneItem($randomIndex, rand(1, 9));
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
        for ($i = 0; $i < 9; $i ++) {
        	//line
        	$box = array();
        	for ($j = 0; $j < 9; $j ++) {
        		$box[] = $i * 9 + $j;
        	}
        	$boxes[] = $box;
        	
        	//column
        	$box = array();
        	for ($j = 0; $j < 9; $j ++) {
        		$box[] = $i + $j * 9;
        	}
        	$boxes[] = $box;
        	
        	//box
        	
        }
        $boxes = array();
        for ($line = 0; $line < 3; $line ++) {
        	for ($column = 0; $column < 3; $column ++) {
	        	$box = array();
	        	for ($j = $line; $j < $line + 3; $j ++) {
	        		for($k = $column; $k < $column + 3; $k ++){
	        			$box[] = $j * 3 + $k;
	        		}
	        	}
	        	$boxes[] = $box;
        	}
        }
        print_r($boxes);die;
        $numbers = array();
        for ($i = 0; $i < 9; $i ++) {
            $numnbers[] = $i;
            $fintess += $this->countNotUnique($numbers);
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
        
        return $countNotUnique;
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
