<?php

$a = 5;
$b = '05';

// Почему true?
var_dump($a == $b);
/*
 * Используется оператор "равно" - гибкое сравнение.
 * Происходит сравнение только по значению.
 * При этом перед сравнением происходит неявное приведение типов.
 * Здесь значение переменной $b (строка) приводится
 * к числовому типу, т.е. к целому числу (integer) 5.
 * https://www.php.net/manual/ru/language.operators.comparison.php
 */

// Почему 12345?
var_dump((int)'012345');
/*
 * Явное приведение строки к типу integer (целочисленное значение).
 * https://www.php.net/manual/ru/language.types.type-juggling.php
 */

// Почему false?
var_dump((float)123.0 === (int)123.0);
/*
 * Используется оператор "тождественно равно" - жесткое сравнение.
 * Сравнение проводится по типу и по значению.
 * Также здесь происходит явное приведение типов операндов.
 * В данном случае левый и правый операнды 
 * будут иметь одиноковые значения, но разные типы.
 */

// Почему true?
var_dump((int)0 === (int)'hello, world');
/*
 * Используется оператор "тождественно равно" - жесткое сравнение.
 * Сравнение проводится по типу и по значению.
 * Также здесь происходит явное приведение типов операндов.
 * В данном случае правый операнд вычисляется, как 0 (ноль), т.к.
 * строка, не имеющая чисел, при приведении к целочисленному
 * значению (integer) будет равна 0. Левый операнд также будет 
 * равен целому числу 0.
 */
