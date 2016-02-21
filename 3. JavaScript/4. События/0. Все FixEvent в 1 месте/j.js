/* --------------------------------------------------
---------------- О Г Л А В Л Е Н И Е ----------------
JavaScript -> События
0. Все FixEvent в 1 месте


	> FixEvent - FIX всех IE-несовместимостей при работе с событиями в 1-й функции






-------------------------------------------------- */





//FixEvent - FIX всех IE-несовместимостей при работе с событиями
// в 1-й функции
function fixEvent(e, _this) {
  e = e || window.event;

  if (!e.currentTarget) e.currentTarget = _this;
  if (!e.target) e.target = e.srcElement;

  if (!e.relatedTarget) {
    if (e.type == 'mouseover') e.relatedTarget = e.fromElement;
    if (e.type == 'mouseout') e.relatedTarget = e.toElement;
  }

  if (e.pageX == null && e.clientX != null ) {
    var html = document.documentElement;
    var body = document.body;

    e.pageX = e.clientX + (html.scrollLeft || body && body.scrollLeft || 0);
    e.pageX -= html.clientLeft || 0;

    e.pageY = e.clientY + (html.scrollTop || body && body.scrollTop || 0);
    e.pageY -= html.clientTop || 0;
  }

  if (!e.which && e.button) {
    e.which = e.button & 1 ? 1 : ( e.button & 2 ? 3 : (e.button & 4 ? 2 : 0) );
  }

  return e;
}











/* --------------------------------------------------
---------------- И Н Ф О Р М А Ц И Я ----------------


Ссылки:


	> Глава "Устранение IE-несовместимостей: "fixEvent"" учебника по JavaScript
		от Ильи Кантора:
				http://learn.javascript.ru/fixevent


*****************************************************
Оглавление:

	> IE-несовместимости
	> Функция FixEvent
	> Если передать this 2-м аргументом, то он будет записан в currentTarget





*****************************************************




> IE-несовместимости
	> В учебном документе "5. События мыши" описан ряд отличий при работе
		с событиями в браузере IE.
	> Здесь имеются в виду следующий тип отличий - когда во всех браузерах
		присутствует свойство X, а в IE его нет, а вместо него Y.
	> Чтобы с этим справитсья, придумали Т.Н. FIX-функции. Все они работают
		одинаково - на основе присутствующих в IE Y вычисляют, какое значение
		было бы, если бы присутствовал X, и создают этот самый X с вычисленным
		значением. В результате с событиями в IE - касательно данных свойств -
		становится возможно работать также, как и в других браузерах.

> Функция FixEvent
	> Представляет собой FIX для IE сразу всех необходимых стандартных свойств.
	> Добавляет объекту события в IE следующие стандартные свойства:
		- target
		- relatedTarget
		- pageX/pageY
		- which

> Если передать this 2-м аргументом, то он будет записан в currentTarget
	> Имеется в виду передать в функцию-обработчик.
	> Это поведение отвечает стандарту.
	> Это поведение используется в функции FixEvent.









-------------------------------------------------- */





















