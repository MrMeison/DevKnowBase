
// info
// => бывают следующие операторы сравнения:
//    1. >             больше
//    2. >=            больше равно
//    3. <             меньше
//    4. <=            меньше равно
//    5. ==            нестрогое сравнение
//    6. !=            нестрогое не равно
//    6. ===           строгое сравнение
//    7. !==           строгое не равно
// => при сравнении разных типов значения преобразуются к числам
// => null и undefined равны друг другу, и больше ничему


// пример > >= < <=
var a = 1; var b = 2; var c;
c = b > a;   // true
c = b >= a;  // true
c = b < a;   // false
c = b <= a;  // false

// разница между мягким сравнением == и строгим сравнением ===
a = false;
b = "0";
c = a == b;   // true - оба значение приводятся к числу 0
c = a === b;  // false - оператор === не осуществляет приведения, а сравниввает "как есть"

// сравнение строк происходит побуквенно
a = "John"; b = "Johnny";
c = b > a;  // true, потому что в "john" 5 буква - ничего, а в "Johnny" n.

// сравнивать числа в виде строк нельзя, получится не правильно
a = "5"; b = "20";
c = a > b;  // true, потому что код симола "5" больше кода символа "2"

// сравнение разных типов
a = "5Иван"; b = 2;
c = a > b;  // false, потому что "5Иван" преобразуется к числу NaN, а 2 > NaN

a = "5"; b = 2;
c = a > b;  // true, потому что "5" преобразуется к числу 5

// разница между null и undefined, их сравнение
a = null; b = undefined;
c = a == b;   // true
c = a === b;  // false

// математический парадокс с null, лучше в сравнениях не использовать
a = null;
c = a > 0;  // FALSE
c = a == 0; // FALSE
c = a >= 0; // TRUE

// математический парадокс с undefined, лучше в сравнениях не использовать
a = undefined;
c = a > 0;  // FALSE
c = a == 0; // FALSE
c = a >= 0; // FALSE