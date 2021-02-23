<?php


	/*Класс создаёт матрицу из векторов для распознавания образца
	 * по модели сети Хопфилда*/


	class Hopfield_Network_Matrix 
	
	
	
	{
		


	 /*В массиве result_matrinx хранится матрица*/
	public $result_matrix=array(); 
	/*В массиве  хранится матрица, умноженная на искомый вектор*/
	public $matrix_and_pattern=array();
	/*Массив хранит рузльтут умножения искомого вектора на матрицу с применением
	 * функции активации*/
	public $activation_matrix_and_pattern=array();
			
			
			
			
			
	/*Метод перемножает образцы сети на себя 
	 * и применяет операцию сложения к ним. Результат: матрица*/
	 
	public function createMatrix($vector) 
	
		
		
		{
			
			
		
		  /*Умножение векторов*/
	print '<strong>Векторы, умноженные на себя </strong>';
		 
 	for ($y=0; $y < count($vector)+1; $y++) {
			
			print '<br/>';	
			
			for($j=0; $j < count($vector[$y]); $j++) {		 
			for ($i=0; $i < count($vector[$y]); $i++) {
				
			 print  $vector[$y][$j]*$vector[$y][$i];
			
				/*Сложение векторов в матрицу*/		
				$this->result_matrix[$j][$i]+=$vector[$y][$j]*$vector[$y][$i];

				}	
				print '<br/>';	
			}	
				
		}
		
		
		
			print '<strong>Матрица: результат сложения перемноженных векторов</strong><br/> ';
			print '<br/>';
			
			/*Печать матрицы*/
			foreach($this->result_matrix as $arr) {		
			print_r($arr);
			print '<br/>';
		
		
		}
		
		
		
		/*Возврщаем матрицу*/
		return $this->result_matrix;	
		
		
		
}	





	/*Метод возвращает матрицу (массив), умноженную на искомый образец*/
	public function checkPattern($pattern) 
	
	
	
	{
			
			
		print '<strong>Матрица, умноженная на искомый вектор. С обнулённой диагональю</strong>';
		print '<br/>';
		
		/*Обнулим переменные для последующих вызовов*/
		
		$y = 0;
		$i = 0;
		$j = 0; 
		
		
		/*Обнулим функцию активации для последующих вызовов*/
		unset($this->matrix_and_pattern);
		
		
		/*Умножим на образец*/
		foreach($this->result_matrix as $arr) {		
				
				$new_val = 0;
		
				/*Обнулим диагональ*/
				$arr[$i]=0;
				$i++;
				
				
				foreach($arr as $k=> $val) 
				{
					$new_val+=$val*$pattern[$k];	
				}		
						
				$this->matrix_and_pattern[]=$new_val;
				$y++;
				
				print $new_val;
				print '<br>';
				
				}
				
				
				
						
			/*Применим функцию активации*/
				foreach ($this->matrix_and_pattern as $k=> $val)
				 {
				if ($val >= 0)
				$this->activation_matrix_and_pattern[$k]  = 1;
				if ($val < 0)
				$this->activation_matrix_and_pattern[$k]  = -1;
				}
			
				print_r($this->activation_matrix_and_pattern);
				print '<br/>';
			
			/*Возвращаем матрицу (массив), умноженную на образец с функцией активации*/
			return $this->activation_matrix_and_pattern;
		
		
	}



			


}			


/*Векторы - образцы сети*/
$vector[0]=array(-1,1,-1,1);
$vector[1]=array(1,-1,1,1);	
$vector[2]=array(-1,1,-1,-1);

/*Искомый вектор*/
$pattern=array(1,-1,1,-1);

$new_matrix = new Hopfield_Network_Matrix;	
/*Передаём векторы в класс*/
$new_matrix->createMatrix($vector);
/*Реузльтат умножения образца на матрицу и применение функции активации*/
$next_result[0]=$new_matrix->checkPattern($pattern);


	/*Вызов в цикле*/
	for($i=1; $i < 5; $i++) 

	{
		$next_result[$i] = 	$new_matrix->checkPattern($next_result[$i-1]);
		
	}


