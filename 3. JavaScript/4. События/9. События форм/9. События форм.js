/* --------------------------------------------------
---------------- О Г Л А В Л Е Н И Е ----------------
JavaScript -> События
9. События форм


	> Примеры работы с label




-------------------------------------------------- */



//Некоторые особенности работы с элементом формы input типа textarea:

	// Выводит innerHTML эл-та textarea с id='myTextarea'
	var alertTextareaInnerHTML = function() {

		// Получить ссылку на textarea с id='myTextarea'
		var textarea = document.getElementById('myTextarea');

		// Вывести с помощью alert значение innerHTML нашей textarea
		alert('textarea.innerHTML = '+textarea.innerHTML);

	};

	// Выводит value эл-та textarea с id='myTextarea'
	var alertTextareaValue = function() {

		// Получить ссылку на textarea с id='myTextarea'
		var textarea = document.getElementById('myTextarea');

		// Вывести с помощью alert значение value нашей textarea
		alert('textarea.value = '+textarea.value);

	};












/* --------------------------------------------------
---------------- И Н Ф О Р М А Ц И Я ----------------


Ссылки:


	> Глава 'Формы: события "change", "input", "propertychange"'
		учебника по JavaScript от Ильи Кантора:
				http://learn.javascript.ru/events-change

	> Глава 'Формы: метод и событие "submit"'
		учебника по JavaScript от Ильи Кантора:
				http://learn.javascript.ru/forms-methods

	> Глава 'Формы: свойства элементов'
		учебника по JavaScript от Ильи Кантора:
				http://learn.javascript.ru/form-elements



*****************************************************
Оглавление:

					----- [глава 1]

	> Общая информация

	> Событие change
		> Общая информация
		> Как работает change для основных типов элементов формы

	> Событие propertychange
		> Общая информация
		> Основное предназначение события propertychange
		> Как в функции-обработчике propertychange узнать, какое св-во изменилось?
		> Работая с propertychange, как отслеживать удаление символов?

	> Событие input

	> События cut, copy, paste

	> Живые примеры:
		> Ограничение длины ввода в input (как при отправке SMS)
		> МММ-калькулятор. Авто-пересчет при изменении значений форм.


					----- [глава 2]

	> Событие submit
		> Основное предназначение
		> Когда событие submit возбуждается?
		> Как отменить отправку формы на сервер при возбуждении события submit?
		> В IE<=8 событие submit не всплывает.

	> Метод submit
		> Основные 2 предназначения
		> Метод submit() НЕ генерирует событие submit

	> Живые примеры
		> Генерация "на лету" модального окна с формой


					----- [глава 3]

	> Некоторые особенности работы с элементом label формы
		> Основное предназначение
		> 2 способа использования
		> Как label работает с прочими эл-тами, кроме checkbox/radio?

	> Некоторые особенности работы с элементом формы input типа textarea
		> Главная особенность - не надо использовать textarea.innerHTML!
		> Для чтения значения из textarea надо использовать св-во value.

	> Некоторые особенности работы с элементами формы input типа "checkbox" и "radio"

	> Некоторые особенности работы с элементами формы select и option
		> Что возвращает select.value
		> Как выбрать в элементе select с помощью JS-кода?
		> Еще несколько полезных свойств эл-та select

	> Живые примеры
		> Валидация формы



*****************************************************




> Общая информация

	> Для HTML-элементов формы есть специальная группа событий, которые
	 	происходят только на них:
	 	- change					| происходит после изменения значения эл-та формы после потери им фокуса
	 	- propertychange	| (только IE<=8) использовать в IE<=8 вместо change
	 	- input						| происходит сразу после изменения значения текстового поля
	 	- cut							| происходит при команде "вырезать" до действий браузера "по умолчанию"
	 	- copy						| происходит при команде "копировать" до действий браузера "по умолчанию"
	 	- paste						| происходит при команде "вставить" до действий браузера "по умолчанию"
	 	- submit					| дей-ия брауз-а "по умолч." для этого соб-ия отправ-ют данные на сервер


	> Что может, а что не может JS по отношению к формам?
		> Javascript может делать с формами почти всё, что угодно. Единственное,
			чего он не может, это заполнять поля <input type='file'> без инициативы
			пользователя.

	> Валидация форм
		> Наиболее частое применение JS и событий форм по отношению к формам -
			это их валидация перед отправкой.
		> Но надо помнить, что эта валидация - лишь для удобства пользователя.
			Сервер не должен на неё полагаться, ведь JS-скрипт легко отключить, и
			тогда данные на клиентской стороне не будут проходит валидацию. Поэтому,
			если серверу нужны валидные данные, он должен проводить валидацию
			у себя на серверной стороне.

	> Отслеживание ввода данных в форму
		> Данные в форму могут быть введены разными способами:
			- Клавиатурой
			- Мышью
			- Операцией "вставка"
			- С мобильного устройства
		> С помощью специальной группы событий для форм можно отслеживать
			ввод из любого источника. И работать с этими данными как до их
			отражения на форме действиями браузера "по умолчанию", так и после.



> Событие change

	> Общая информация:
		> В соотв. со стандартом, событие change происходит после изменения
			значения элемента формы, после потери им фокуса.
			> Т.О. НЕ позволяет предотвратить изменение с помощью отмены действий
				браузера по умолчанию.
		> Процесс работы события change может отличаться от стандарта,
			в зависимости от:
			- Браузера
			- Типа элемента формы

	> Как работает change для основных типов элементов формы:

		> Text
			> Во всех браузерах:
					- В соотв. со стандартом.
					- Без исключений.

		> Checkbox, Radio
			> Во всех браузерах (кроме IE<=8):
					- В соотв. со стандартом.
					- НО: инициирует событие сразу, БЕЗ ожидания потери фокуса.
			> В IE<=8:
					- В соотв. со стандартом.

		> Select
			> Во всех браузерах:
					- В соотв. со стандартом.
					- НО: инициирует событие сразу, БЕЗ ожидания потери фокуса.
			> В IE<=8 и старой не-webkit-opera дополнительно:
					- Событие генерируется еще и при переборе значений с клавиатуры
						клавишами вверх-вниз.



> Событие propertychange

	> Общая информация:
		> Возбуждается после изменения любого свойства любого объекта.
			> Т.О. НЕ позволяет предотвратить изменение с помощью отмены действий
				браузера по умолчанию.
		> Возбуждается только в IE<=8.
		> НЕ возбуждается при удалении символов из input типа text любым методом.

	> Основное предназначение события propertychange
		> У события change есть проблема: в IE<=8, в элементах checkbox и radio
			оно возбуждается не сразу после изменения значения элемента, а только
			после потери им фокуса.
		> Событие propertychange предназначено для того, чтобы решить эту проблему.
			В вышеуказанных элементах, в IE<=8, оно возбуждается сразу, без ожидания
			потери фокуса элементом.

	> Как в функции-обработчике propertychange узнать, какое св-во изменилось?
		> Можно проверять свойство event.propertyName.
		> Например, если мы отслеживаем изменение св-ва value эл-та формы:

				if(event.propertyName == "value") {
					... какой-то JS-код ...
				}

	> Работая с propertychange, как отслеживать удаление символов?
		> Отслеживая следующие события:
			- cut			|	при удалении командой "вырезать"
			- keyup		| отслеживать кнопки Backspace и Delete
			- ... (TODO: )как отслеживать удаление через тач-скрин? ...



	> Кроссбраузерный способ назначить обработчик для эл-тов формы типа checkbox/radio
		так, чтобы отслеживать изменения в этих элементах БЕЗ ожидания потери фокуса

			if("onpropertychange" in checkbox) {
				// если поддерживается (IE)
				checkbox.onpropertychange = function() {
					if (event.propertyName == "checked") { // имя свойства
						alert(checkbox.checked);
					}
				};
			} else {
				// остальные браузеры
				checkbox.onchange = function() {
					alert(checkbox.checked);
				};
			}


> Событие input
	> Возбуждается сразу после изменения значения value элементов input
		или textarea.
		> Т.О. НЕ позволяет предотвратить изменение с помощью отмены действий
			браузера по умолчанию.
	> Поддерживается всеми браузерами одинаково хорошо, кроме IE<=9 и старой
		opera.
	> В IE<=9 поддерживается частично - а именно, не возникает при удалении
		символов.
		> Поэтому специально для решения этой проблемы в IE<=8, требуется отслеживать
			еще 2 события:
			- keyup		| отслеживать нажатие клавиш Backspace/Delete
			- cut			| отслеживать удаление с помощью операции "вырезать".
	> В старых opera (до перехода на webkit) событие input не вызывается
		при вставке текста командой "вставить".


> События cut, copy, paste
	> Используются редко, но иногда бывают полезны.
	> События cut, copy, paste происходят при вырезании/вставке/копировании
		значения в поле соответственно, ДО действий браузера "по умолчанию".
		> Т.О., возможно предотвратить действия браузера "по умолчанию",
			отменив их в функции-обработчике.
	> Эти события не позволяют получить доступ к данным, с которыми совершается
		манипуляция.



> Живые примеры:
	> Ограничение длины ввода в input (как при отправке SMS)
		- В поле можно ввести не более 25 символов.
		- Учтена возможность ввода/удаления не с клавиатуры.
		- В режиме online отображается кол-во введенных символов.
		- Если кол-во символов попадает в диапазон от 20 до 25, то
			отображаемое кол-во введенных символов из предыдущего
			пункта начинает отображатсья красным цветом.

			3. JavaScript ->
			0. Practical samples and techniques ->
			2. Events ->
			21. Input filter - sms and in length


	> МММ-калькулятор. Авто-пересчет при изменении значений форм.
		- Калькурятор использует правила вкладов МММ на конец лета 2011 года.
		- Имеет 3 элемента формы, в которых пользователь может изменять значения:
			размер вклада, срок вклада, льготный/не_льготный вклад.
		- Показывает процентрую ставку, рассчитывает сумму, в которую превратится
			изначальный вклад к концу вклада. Показывает наглядную разницу между
			первоначальным вкладом и результирующей суммуй с помощью цветных баров.
		- При изменении любого элемента формы сразу автоматически пересчитывает
			все результаты.

			3. JavaScript ->
			0. Practical samples and techniques ->
			2. Events ->
			22. MMM calculator






> Событие submit

	> Основное предназначение
		> Валидациея перед отправкой формы на сервер:
				Действия браузера "по умолчанию" для события submit - отправить форму
				на сервер. Но функция-обработчик срабатывает раньше, что делает возможным
				провести валидацию данных в форме, и если что-то не так, отменить отправку.

	> Когда событие submit возбуждается?
		1. Если нажать на кнопку <input type='submit'> или <input type='image'>.
		2. Если нажать enter, когда текстовое поле input находится в фокусе.

	> Как отменить отправку формы на сервер при возбуждении события submit?
		> Надо в функции-обработчике события submit отменить действия браузера
			по умолчанию.

	> В IE<=8 событие submit не всплывает.
		> Т.О. чтобы в IE<=8 можно было работать с этим событием, функцию-обработчик
			надо назначать на сам HTML-элемент формы.


> Метод submit

	> Основные 2 предназначения
		> Отправка формы на сервер из кода JavaScript.
		> Генерация формы средствами JS с последующей отправкой на сервер
			с помощью функции submit.

	> Метод submit() НЕ генерирует событие submit
		> Сабж. Предполагается, что программист к этому моменту уже произвел все
			необходимые проверки


> Живые примеры
	> Генерация "на лету" модального окна с формой
		- Такие окна часто используют для подписки клиентов. Пример:
				http://alenashefina.com/
		- На лету генерируется модальное окно, содержащее форму.
		- Действия браузера "по умолчанию" при нажатии на кнопки
			отменяются. С данными производятся требуемые манипуляции, и
			с помощью метода form.submit() они отправляются на сервер (условно)

			3. JavaScript ->
			0. Practical samples and techniques ->
			2. Events ->
			23. Gen form as modal window





> Некоторые особенности работы с элементом label формы

	> Основное предназначение
		> Клик по label засчитывается за клик по элементу формы, которому
			этот label принадлежит.
		> Это позволяет пользователям кликать по большой красивой метке, а не
			по маленькому квадратику input type='checkbox/radio'

	> 2 способа использования
		1. Завернуть элемент input в label, вот так:

				<label>Нажми на меня <input type='checkbox'></label>

		2. Либо, дать эл-ту label атрибут for, в значении которого написать
			 id того эл-та, к которому эта метка должна быть прикреплена.
			 Например:

			 	 <input type='checkbox' id='myId'>
			 	 <label for='myId'>Я согласен с правилами</label>

	> Как label работает с прочими эл-тами, кроме checkbox/radio?
		> Клик по label для других элементов вызывает (либо-либо):
			- Фокусировку на эл-те, за которым закреплен label (напр., select)
			- Клик по этому элементу (например, button)


> Некоторые особенности работы с элементом формы input типа textarea

	> Главная особенность - не надо использовать textarea.innerHTML!
		> Во-первых, потому что textarea.innerHTML содержит только то значение,
			которое было в нем изначально. Даже если пользователь ввел еще что-то,
			то запросив innerHTML мы увидим только то, что было изначально.
		> Во-вторых, если запросить значение через textarea.innerHTML, то
			Т.Н. HTML-entities не будут преобразованы. Например:

				Если изначально в textarea была запись:
				-----
					&lt;a&gt;

				То если запросить textarea.innerHTML, мы получим:
				-----
					&lt;a&gt;

				А если запросить textarea.value мы получим:
					 <a>

						> Т.Е. HTML-entities были приобразованы к человекопонятному виду.

	> Для чтения значения из textarea надо использовать св-во value.



> Некоторые особенности работы с элементами формы input типа "checkbox" и "radio"

	> Главная особенность
		> Элементы этих типов могут быть отмечены атрибутом checked.
		> Особенность в получении атрибута "checked" 2-мя доступными
			путями:
			- Если получать как св-во, то результатом будет логическое значение.
				Например:

					console.log(input.checked);		// 'true'

			- Если получать как атрибут, то результатом будет "как указано в HTML":
				Например:

					input.getAttribute('checked');		// ''



> Некоторые особенности работы с элементами формы select и option

	> Что возвращает select.value
		> Возвращает value выбранной опции option.
		> В случае, если присутствует атрибут multiple, возвращает value
			1-й из выбранных option.
			> А чтобы получить все выбранные значения, нужно устроить цикл
				по select.options:

					for (var i=0; i<select.options.length; i++) {
 						 var option = select.options[i];
 					}

	> Как выбрать в элементе select с помощью JS-кода?
		> Есть 2 способа:
			- Установить значение св-ва select.value.
			- Установить значение св-ва select.selectIndex (индексация опций
				эл-та select начинается с 0).

	> Еще несколько полезных свойств эл-та select:
		- select.selected		| выбрана ли опция
		- select.index			| номер опции в списке
		- select.text				| текстовое содержимое опции (то, что видит посетитель)


> Живые примеры
	> Валидация формы
		- Написана функция для валидации формы при нажатии на кнопку.

			3. JavaScript ->
			0. Practical samples and techniques ->
			2. Events ->
			24. Validation of form






-------------------------------------------------- */


















