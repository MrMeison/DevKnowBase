/* --------------------------------------------------
---------------- О Г Л А В Л Е Н И Е ----------------
JavaScript -> События
3. Отмена выделения, делегирование событий


	Отмена выделения
		> Сделать элемент e и всех его потомков невыделяемыми
		> Снять выделение во всем документе после 2xКлика, постфактум
		> Снять выделение во всем документе после выделения с зажатой ЛК мыши,
			постфактум - после того, как ЛК мыши будет отпущена






-------------------------------------------------- */

var e;

// Сделать элемент e и всех его потомков невыделяемыми
	e = document.getElementsByClassName('c1')[0];

	var handler = function(event) {
		// Кроссбраузерно получить объект-событие
		event = event || window.event

		// Кроссбраузерно отменить действия браузера "по умолчанию" в ответ
		// на возникновение события:
		event.preventDefault ? event.preventDefault() :
													(event.returnValue=false);
	};
	e.onselectstart = handler;
	e.onmousedown = handler;



//Снять выделение во всем документе после 2xКлика, постфактум
e = document.getElementsByClassName('c2')[0];
e.ondblclick = function(event) {
	// Кроссбраузерный способ снять выделение в документе
	window.getSelection ? window.getSelection().removeAllRanges() :
												document.selection.empty();
};



//Снять выделение во всем документе после выделения с
//	постфактум - после того, как ЛК мыши будет отпущена
e = document.getElementsByClassName('c3')[0];
e.onmouseup = function(event) {
	// Кроссбраузерный способ снять выделение в документе
	window.getSelection ? window.getSelection().removeAllRanges() :
			document.selection.empty();
};









/* --------------------------------------------------
---------------- И Н Ф О Р М А Ц И Я ----------------


Ссылки:


	> Глава "Отмена выделения, невыделяемые элементы" учебника по JavaScript
		от Ильи Кантора:
				http://learn.javascript.ru/unselectable

	> Глава "Делегирование событий" учебника по JavaScript
		от Ильи Кантора:
				http://learn.javascript.ru/event-delegation




*****************************************************
Оглавление:


	> Зачем нужно отменять выделение
	> Когда происходит выделение
	> Предотвращение выделения до его возникновения
	> Снятие выделения постфактум - после его возникновения

	> Делегирование событий (техника)
	> Примеры делегации событий



*****************************************************



Отмена выделения
================================



> Зачем нужно отменять выделение
	> Это бывает особенно нужно в элементах управленя, чтобы незапланированное
		выделение браузера не мешало пользователю.

> Когда происходит выделение
	> Выделение текста происходит:
		- При двойном клике по элементу.
		- При движении мыши с зажатой левой кнопкой

> Предотвращение выделения до его возникновения
	> Предотвратить выделение можно, предотвратив действия браузера
		"по умолчанию" для нижепредставленных событий:
		- mousedown (для всех браузеров, кроме IE)
		- onselectstart (для IE)
	> Если выделение в элементе А предотвращено, то оно автоматически
		предотвращается и во всех его потомках благодаря процессу всплытия
		соответствующего события.
	> Минусом такого подхода является тот факт, что невыделяемый элемент
		все равно можно выделить - достаточно начать выделение (зажать кнопку мыши)
		не на самом элементе, а рядом с ним.
	> Примеры:


		Сделать элемент e и всех его потомков невыделяемыми:
		-----
			var handler = function(event) {
				// Кроссбраузерно получить объект-событие
				event = event || window.event

				// Кроссбраузерно отменить действия браузера "по умолчанию" в ответ
				// на возникновение события:
				event.preventDefault ? event.preventDefault() :
															(event.returnValue=false);
			};
			e.onselectstart = handler;
			e.onmousedown = handler;


		Сделать только элемент e (предотвратить всплытие события) невыделяемым:
		-----
			var handler = function(event) {
				// Кроссбраузерно получить объект-событие
				event = event || window.event

				// Кроссбраузерно отменить действия браузера "по умолчанию" в ответ
				// на возникновение события:
				event.preventDefault ? event.preventDefault() :
															(event.returnValue=false);

				// Кроссбраузерно остановить всплытие
				event.stopPropagation ? event.stopPropagation() :
																(event.cancelBubble=true);
			};
			e.onselectstart = handler;
			e.onmousedown = handler;


> Снятие выделения постфактум - после его возникновения
	> Выделение можно убрать после его возникновения, через обработчик
		событий.
	> Этот способ подходит в большом кол-ве случаев. Например:
		- Если 2xКлик используется для переключения элемента в редактируемое
			состояние - путем показа виджета или замены элемента на input.
	> Примеры:

		Снять выделение во всем документе после 2xКлика, постфактум
		-----
			function clearSelection(event) {

				// Кроссбраузерный способ снять выделение в документе
				window.getSelection ? window.getSelection().removeAllRanges() : 	// для всех браузеров, кроме старых IE
															document.selection.empty();									// для старых IE

			};
			e.ondblclick = clearSelection;


		Снять выделение во всем документе после выделения с зажатой ЛК мыши,
		постфактум - после того, как ЛК мыши будет отпущена

			e.onmouseup = function(event) {
			// Кроссбраузерный способ снять выделение в документе
				window.getSelection ? window.getSelection().removeAllRanges() : 	// для всех браузеров, кроме старых IE
															document.selection.empty();									// для старых IE
			};





Делегирование событий
================================

> Делегирование событий (техника)
	> Если есть много элементов, события на которых нужно обрабатывать
		похожим образом, то не стоит присваивать отдельный обработчик каждому.
	> Вместо этого, лучше назначить один обработчик общему родителю. В нем
		можно получить целевой элемент event.target, понять на каком потомке
		произошло событие и обработать его.

> Примеры делегации событий
	> См. по адресу:

		'0. Practical samples and techniques' ->
		'2. Events'












-------------------------------------------------- */





















