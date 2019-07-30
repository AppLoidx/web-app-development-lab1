# 1 лабораторная работа по ПИП

>Без Bootstrap'a тяжко

![](https://github.com/AppLoidx/web-app-development-lab1/blob/master/resources/screenshot/2019-07-19_18-07-38.png?raw=true)

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

## Report
#### Check.php
Функция проверки попадания точки в ОДЗ :
```php
function check($x, $y, $r){
        if (($x >= -$r/2 && $x <= 0 && $y <= $r && $y >= 0) || ($y >= (-$x/2 - $r/2) && $y <= 0 && $x <= 0) || (($x*$x + $y*$y) <= $r*$r/4 && $x >= 0 && $y >= 0)){
            return "<span style='color: green'>True</span>";
        } else {
            return "<span style='color: red'>False</span>";
        }
    }
```

Функция проверки валидности данных:
```php
    function checkArea($x, $y, $r){
        return !in_array($x, array(-4, -3, -2, -1, 0, 1, 2, 3, 4)) || !is_numeric($y) || $y < -3 || $y > 5 || !in_array($r, array( 1, 1.5, 2, 2.5, 3));
    }
```

Глобальная переменная для вставки результатов: `$_SESSION['history'] = array();`

Метод вставки результата: 
```php
$result = array($x, $y, $r, $res, $currentTime, $time);
array_push($_SESSION['history'], $result);
```

#### index.html
Функция проверки вхождения точки в ОДЗ:
```js
const checkArea = function(){
            let yStr = $("#y-value-select").val().replace(",",".");
            let x = Number($("input[name=x_value]:checked").val());
            let y = Number(yStr);
            let r = Number($("#r-value-select").val());

            return (x >= -r / 2 && x <= 0 && y <= r && y >= 0) || (y >= (-x / 2 - r / 2) && y <= 0 && x <= 0) || ((x * x + y * y) <= r * r /4 && x >= 0 && y >= 0);
        };
```

Фигура на странице нарисована с помощью svg-элемента:
```html
<svg width="300" height="300" class="svg-graph" xmlns="http://www.w3.org/2000/svg">

  <!--            Линии оси-->

    <line x1="0" x2="300" y1="150" y2="150" stroke="black"></line>
    <line x1="150" x2="150" y1="0" y2="300" stroke="black"></line>
    <polygon points="150,0 144,15 156,15" stroke="black"></polygon>
    <polygon points="300,150 285,156 285,144" stroke="black"></polygon>

    <line class="coor-line" x1="200" x2="200" y1="155" y2="145" stroke="black"></line>
    <line class="coor-line" x1="250" x2="250" y1="155" y2="145" stroke="black"></line>

    <line class="coor-line" x1="50"  x2="50"  y1="155" y2="145" stroke="black"></line>
    <line class="coor-line" x1="100" x2="100" y1="155" y2="145" stroke="black"></line>

    <line class="coor-line" x1="145" x2="155" y1="100" y2="100" stroke="black"></line>
    <line class="coor-line" x1="145" x2="155" y1="50"  y2="50"  stroke="black"></line>

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
где последняя фигура (`id="target-dot"`) является указателем на точку, указанной параметрами `x`,`y`,`z`

Фукнция **onYInpChange** вызывается каждый раз при изменении формы, но так как она выполняет простую валидацию и чтобы не создавать еще одну аналогичную функцию, я также использовал её для валидации всех форм, поэтому она возвращает булево значение: `true` - если все формы валидны, иначе `false`

```js
const onYInpChange = function(){
        let elemY = $("#y-value-select");

        let dotTarget = $("#target-dot");
        
        let value = Number(elemY.val().replace(",","."));
        if (value < -3 ||  value > 5 || isNaN(value) || /[\s]+/.test(elemY.val()) || elemY.val()===""){
           elemY.removeClass().addClass("is-invalid");
           dotTarget.attr("r", 0);
           $('#menhera').attr("src","resources/invalid.jpg");

           return false;
        } else {

           document.querySelector('#error-log').textContent = " ";
           elemY.removeClass().addClass("is-valid");

           let elemR = $("#r-value-select");
           let calculatedX = 2 * (Number($("input[name=x_value]:checked").val()) * 50 / Number(elemR.val())) + 150;
           let calculatedY = -(((Number(elemY.val().replace(",",".")) * 50 * 2) / Number(elemR.val())) - 150);

           dotTarget.attr("r", 3);
           dotTarget.attr("cy", calculatedY);
           dotTarget.attr("cx", calculatedX);

           if (checkArea()){
               $('#menhera').attr("src","resources/correct.jpg");
           } else {
               $('#menhera').attr("src" , "resources/incorrect.jpg");
           }

           return true;
        }
        };

```

SVG-картинка имеет размеры 300x300`px` и имеет начало координат в верхнем левом углу, поэтому необходимо перевести значения осей в соответствующий размер пикселей и сместить точку начала координат, для указательной точки ("target-dot").

Изменение атрибутов точки:
```js
let elemR = $("#r-value-select");
let calculatedX = 2 * (Number($("input[name=x_value]:checked").val()) * 50 / Number(elemR.val())) + 150;
let calculatedY = -(((Number(elemY.val().replace(",",".")) * 50 * 2) / Number(elemR.val())) - 150);

dotTarget.attr("r", 3);
dotTarget.attr("cy", calculatedY);
dotTarget.attr("cx", calculatedX);
```

В случае, если какие-то данные не валидны - изменяем атрибут радиуса точки до 0`px`.

Функции кнопок:

##### Submit

```js
const submit = function(e) {
  e.preventDefault();
  if (!onYInpChange()){
      document.querySelector('#error-log').textContent = "Значение Y должно быть в диапазоне [-3;5]";
      return;
  }

     const formData = new FormData(document.querySelector('#form'));
     fetch('php/check.php', {
         method: 'POST',
         body: formData,
     })
         .then(ans => ans.text())
         .then(table => document.querySelector('#ans').innerHTML=table);
 };
 
document.addEventListener('DOMContentLoaded', function(){
   document.querySelector('#submitButton').addEventListener('click', submit);
});
```

##### Clear
```js
const clear = function(e) {
     e.preventDefault();
     fetch('php/clear.php', {
         method: 'POST',
     })
         .then(ans => ans.text())
         .then(table => document.querySelector('#ans').innerHTML=table);

 };

 document.addEventListener('DOMContentLoaded', function(){
     document.querySelector('#clearButton').addEventListener('click', clear);
 });
 ```
