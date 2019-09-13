
Тестовая версия : https://se.ifmo.ru/~s264452/web-snapshot/

Стабильная версия: https://se.ifmo.ru/~s264452/web/

# 1 лабораторная работа по ПИП

>Без Bootstrap'a тяжко

![](https://i.imgur.com/HtVnOPI.png)

### Вариант:

![](https://github.com/AppLoidx/web-app-development-lab1/blob/master/areas.png?raw=true)

### Задание

Разработать PHP-скрипт, определяющий попадание точки на координатной плоскости в заданную область, и создать HTML-страницу, которая формирует данные для отправки их на обработку этому скрипту.
Параметр R и координаты точки должны передаваться скрипту посредством HTTP-запроса. Скрипт должен выполнять валидацию данных и возвращать HTML-страницу с таблицей, содержащей полученные параметры и результат вычислений - факт попадания или непопадания точки в область.
Кроме того, ответ должен содержать данные о текущем времени и времени работы скрипта.


#### Разработанная HTML-страница должна удовлетворять следующим требованиям:

* Для расположения текстовых и графических элементов необходимо использовать блочную верстку.
* Данные формы должны передаваться на обработку посредством POST-запроса.
* Таблицы стилей должны располагаться в самом веб-документе.
* При работе с CSS должно быть продемонстрировано использование селекторов элементов, селекторов атрибутов, селекторов идентификаторов, селекторов псевдоэлементов а также такие свойства стилей CSS, как наследование и каскадирование.
* HTML-страница должна иметь "шапку", содержащую ФИО студента, номер группы и новер варианта. При оформлении шапки необходимо явным образом задать шрифт (serif), его цвет и размер в каскадной таблице стилей.
* Отступы элементов ввода должны задаваться в пикселях.
* Страница должна содержать сценарий на языке JavaScript, осуществляющий валидацию значений, вводимых пользователем в поля формы. Любые некорректные значения (например, буквы в координатах точки или отрицательный радиус) должны блокироваться.

<hr>

### References

Cheatsheet: [by Band of Four](https://github.com/band-of-four/cheatsheets/blob/master/Internet-Applications-Development/Lab1.md)

Root Example: https://github.com/KaluginaMarina/Internet-Applications-Development

![](https://github.com/AppLoidx/web-app-development-lab1/blob/master/resources/screenshot/kaiki-chan-sleeping-zzz.png?raw=true)

<i>Art from [Polygonya](https://github.com/band-of-four/polygonya)</i>

<br>
<br><br><br><hr>

## Code review
Основная задача лабораторной работы состояла в освоении навыков связывания бэкенда (PHP) и фронтенда (HTML/CSS + JS) и непосредственно их создание.

### Frontend
Кость всего веб-документа составляет HTML. Он был составлен в блочном стиле (через _div_'ы), а все компоненты ввода пользователя располагались внутри тега `form`.
```html
<form class="data-send-form " id="form" oninput="onInpChange()">  
 <div> <div class="form-inputs ">  
  <div class="group">  
	<input type="text" id="y-value-select" name="y_value" required>  
	<span class="highlight"></span>  
	<span class="bar"></span>  
  <label>Y Value</label>  
 </div>  
  
 <label for="r-value-select" class="form-label"><div><strong>R:</strong></div></label>  
 <select id="r-value-select" name="r_value">  
	 <option value="1">1</option>  
	 <option>1.5</option>  
	 <option>2</option>  
	 <option>2.5</option>  
	 <option>3</option>  
 </select> 
</div>
.
.
.
```
Также было интересно работать с SVG-графикой:
```svg
<svg width="300" height="300" class="svg-graph" xmlns="http://www.w3.org/2000/svg">  
  
<!--            Линии оси-->  
  
  <line class="axis" x1="0" x2="300" y1="150" y2="150" stroke="black"></line>  
 <line class="axis" x1="150" x2="150" y1="0" y2="300" stroke="black"></line>  
 <polygon points="150,0 144,15 156,15" stroke="black"></polygon>  
 <polygon points="300,150 285,156 285,144" stroke="black"></polygon>  
  
 <line class="coor-line" x1="200" x2="200" y1="155" y2="145" stroke="black"></line>  
 <line class="coor-line" x1="250" x2="250" y1="155" y2="145" stroke="black"></line>  
  
 <line class="coor-line" x1="50" x2="50" y1="155" y2="145" stroke="black"></line>  
 <line class="coor-line" x1="100" x2="100" y1="155" y2="145" stroke="black"></line>  
  
 <line class="coor-line" x1="145" x2="155" y1="100" y2="100" stroke="black"></line>  
 <line class="coor-line" x1="145" x2="155" y1="50" y2="50" stroke="black"></line>  
  
 <line class="coor-line" x1="145" x2="155" y1="200" y2="200" stroke="black"></line>  
 <line class="coor-line" x1="145" x2="155" y1="250" y2="250" stroke="black"></line>  
  
 <text class="coor-text" x="195" y="140">R/2</text>  
 <text class="coor-text" x="248" y="140">R</text>  
  
 <text class="coor-text" x="40" y="140">-R</text>  
 <text class="coor-text" x="90" y="140">-R/2</text>  
  
 <text class="coor-text" x="160" y="105">R/2</text>  
 <text class="coor-text" x="160" y="55">R</text>  
  
 <text class="coor-text" x="160" y="205">-R/2</text>  
 <text class="coor-text" x="160" y="255">-R</text>  
  
  <!-- first figure-->  
  <polygon class="svg-figure rectangle-figure" points="100,150 100,50 150,50, 150,150"  
  fill="blue" fill-opacity="0.3" stroke="blue"></polygon>  
  
  <!-- second figure circle-->  
  <path class="svg-figure circle-figure" d="M 200 150 A 50 50, 90, 0, 0, 150 100 L 150 150 Z"  
  fill="green" fill-opacity="0.3" stroke="green"></path>  
  
  <!-- third figure-->  
  <polygon class="svg-figure triangle-figure" points="50,150 150,150 150,200"  
  fill="yellow" fill-opacity="0.3" stroke="yellow"></polygon>  
  
 <circle r="0" cx="150" cy="150" id="target-dot"></circle>  
  
 </svg>
```

Для стилизации HTML-документа используется CSS. В моем случае, я также использовал `scss`:
```scss
...
$circleLen: 188.522;  
$heartLen: 308.522;  
$svgSize: 90px;  
$circleW: 60px;  
  
.heart-loader {  
    width: $size;  
    height: $size;
    margin: 0 auto;  
  
  &__group {  
    transform-origin: 0 $svgSize;  
    animation: group-anim $totalAnim $delay forwards;  
  }  
  
  &__square {  
    stroke: $strokeColor;  
	stroke-dasharray: $squareLen, $squareLen;  
	stroke-dashoffset: $squareLen;  
	animation: square-anim $totalAnim $delay forwards;  
  }
  ...
```
```css
  
footer{  
    background-color: crimson;  
	align-self: end;  
	width: 100%;  
	padding-bottom: 10px;  
	padding-top: 10px;  
}  
.github-icon{  
    margin-top: 10px;  
	font-size: xx-large;  
}  
.fa-github{  
    color: white;  
}
```

## Backend
На бэкенде использовался PHP как простой и не требующий больших технических затрат скриптовый язык. Он использовался для вычисления факта попадания точки в ОДЗ
```php
<?php  
  
 function check($x, $y, $r){  
        if (($x >= -$r/2 && $x <= 0 && $y <= $r && $y >= 0) || ($y >= (-$x/2 - $r/2) && $y <= 0 && $x <= 0) || (($x*$x + $y*$y) <= $r*$r/4 && $x >= 0 && $y >= 0)){  
            return "<span style='color: green'>True</span>";  
	    } else {  
            return "<span style='color: red'>False</span>";  
	    }  
  }  
  
  function checkArea($x, $y, $r){  
        return !in_array($x, array(-4, -3, -2, -1, 0, 1, 2, 3, 4)) || !is_numeric($y) || $y < -3 || $y > 5 || !in_array($r, array( 1, 1.5, 2, 2.5, 3));  
  }  
  
  session_start();  
  
  date_default_timezone_set('Europe/Moscow');  
  $currentTime = date("H:i:s");  
  $start = microtime(true);  
  
  $x = (int) $_POST['x_value'];  
  $y = (float) str_replace(",", ".", $_POST['y_value']);  
  $r = (double) $_POST['r_value'];  
  
  if (checkArea($x, $y, $r)) {  
        http_response_code(400);  
  return;  
  }  
 
  $res = check ($x, $y, $r);  
  $time = microtime(true) - $start;  
  $result = array($x, $y, $r, $res, $currentTime, $time);  
  
  if (!isset($_SESSION['history'])) {  
        $_SESSION['history'] = array();  
  }  
  array_push($_SESSION['history'], $result);  
  include "table.php";
```

Этот PHP-скрипт возвращал HTML-таблицу, которая вставлялась посредством асинхронного запроса через FetchAPI:
```js
fetch('php/clear.php', {  method: 'POST'})  
    .then(ans => ans.text())  
    .then(table => document.querySelector('#ans').innerHTML=table);
```

## Вывод
В ходе этой лабораторной работы я сделал веб-документ со стилизацией через CSS используя также технологию SCSS. 

Также я на практическом примере убедился, что PHP - хороший язык для быстрого написания, но его особенности, такие как глобальные переменные, безусловные переходы или базовые функции находящиеся в глобальном неймспейсе делают не лучшим языком для разработки сложных серверных сценариев (бизнес-логики).

С другой же стороны вызвал интерес язык JavaScript, к которому я сначала относился с некоторым недоверием из-за динамической типизации и некоторых его весьма странных особенностей. Но в ходе работы с ней (не только в этой лабораторной работе) он все более начинал позиционировать себя как достойный внимания язык, благодаря его кроссплатформенности, множествам библиотек и широкому спектру использования (особенно с ES6). 
