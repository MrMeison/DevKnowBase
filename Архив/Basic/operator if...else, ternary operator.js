

// info
// =>

// пример работы оператора if ... else
var a = 0; var b = 20; var c;
if(a < 3) {
    c = a + b;
} else if(a < 2) {
    c = a + b;
} else if(a < 1) {
    c = a + b;
} else {
    c = a + b;
}

// тернарный оператор ?
if(a>b) {
    c = a;
} else {
    c = b;
}
с = (a > b) ? a : b;  // сокращенная запись написанного сверху

// несколько тернарных операторов - сокращенная запись большого if...else сверху
c = (a<3) ? a + b : (a<2) ? a + b : (a<1) ? a + b : a + b;