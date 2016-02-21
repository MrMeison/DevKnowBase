/**
 * Задача:
 *
 * > Сделать простую валидацию текстового поля формы на число.
 *
 * > Валидация должна производиться, когда текстовое поле теряет фокус.
 *
 * > Когда же оно получает фокус, сообщение об ошибке должно убираться.
 *
 *
 *
 * Архитектура решения:
 *
 * 1. Создать HTML-форму с элементам input type='text', и справа от
 * 		неё пустой эл-т span с id='error' для отображения сообщения об ошибке.
 * 		Для эл-та span настроить стиль так, чтобы цвет шрифта был красным.
 *
 * 2. 2. Получить ссылку на элемент input из п.1 и эл-т span с id='error'
 *
 * 3. Назначить функцию-обработчик события onblur для эл-та из п.2.
 * 		В ней выполнить следующее: [4]
 *
 * 4. Если значение value текстового поля - не число, то:
 * 		- Применить к нему класс errorClass
 * 	  - Написать красным шрифтом сообщение об ошибке в эл-те span с id='error'.
 *
 * 5. Назначить функцию-обрабочтик onfocus для эл-та из п.2.
 * 		В ней выполнить следующее: [6]
 *
 * 6. - Удалить класс errorClass
 * 		- Удалить содержимое эл-та span с id='error'
 *
 *
 *
 */


// Задействованные переменные
var input,		// ссылка на input type='text'
		span;			// ссылка на span с id='error'


//2. Получить ссылку на элемент input из п.1 и эл-т span с id='error'
input = document.getElementById('myForm').elements[0];
span = document.getElementById('error');


//3. Назначить функцию-обработчик события onblur для эл-та из п.2.
//		В ней выполнить следующее: [4]
input.onblur = function() {


	//4. 	Если значение value текстового поля - не число, то:
	//		- Применить к нему класс errorClass
	//	  - Написать красным шрифтом сообщение об ошибке в эл-те span с id='error'.
	if( isNaN(this.value) ) {

		// Применить класс errorClass
		input.className = 'errorClass';

		// Написать красным шрифтом сообщение об ошибке в эл-те span с id='error'.
		span.innerHTML = ' Вы ввели не число';

	}

};


//5. Назначить функцию-обрабочтик onfocus для эл-та из п.2.
//		В ней выполнить следующее: [6]
input.onfocus = function() {


	//6. 	- Удалить класс errorClass
	//		- Удалить содержимое эл-та span с id='error'

		// Удалить класс errorClass
		input.className = '';

		// Удалить содержимое эл-та span с id='error'
		span.innerHTML = '';

};






