
// info
// =>


// преобразование типов -----------------------------------
//   преобразование в строку
//     явное преобразование в строку
var a = 1234;
var b = String(a);
alert(typeof(b));  // функция typeof() возвращает строку с типом переменной

//     с помощью оператора +, у которого один из операндов строка
a = 1234;
a = '' + a;
alert(typeof(a));  // отображает string

// преобразование в число -----------------------------------
//   явное преобразование в число
a = '1234abdc';
b = Number(a);
alert(typeof(b));  // отображает number

//   преобразование в число с помощью оператора +      также при сравнении, кроме строгих ===, !==
b = +a;
alert(typeof(b));  // отображает number

//   преобразование в число undefined и null
a = null;
b = +a;  // приводится к 0
alert("null приведен к числу, получилось: " + b);  // отображает 0
alert("null приведен к числу, теперь его тип: " + typeof(b));  // отображает number

a = undefined;
b = +a;
alert("undefined приведен к числу, получилось: " + b);  // отображает NaN
alert("undefined приведен к числу, теперь его тип: " + typeof(b));  // отображает number