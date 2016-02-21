// ==========================================
// Модуль "m2_nodeproto_v1" приложения "tree"
// ==========================================


/* --------------------------------------------------
---------------- И Н Ф О Р М А Ц И Я ----------------


Ссылки:





*****************************************************
Оглавление:

	> О модуле
		> Описание модуля
		> Вход: зависимости модуля
		> Выход: что возвращает модуль

	> Прототипы: общие сведения
	> Узел дерева в приложении "tree". Основные факты.

	> Инструкция по применению

	> Параметры узла
	> Подробное описание некоторых параметров
	> Связи между параметрами узла и HTML-разметкой






	> Архитектура модуля



*****************************************************

> О модуле

	> Описание модуля
		- В этом модуле определён объект-прототип узла приложения "tree",
			а также его конструктор.

	> Вход: зависимости модуля
		- m1_library_v1
		- m7_nodemakedom_v1

	> Выход: что возвращает модуль
		- Возвращает ссылку на объект-прототип узла приложения "tree".


> Прототипы: общие сведения

	> Что такое прототип?
		> Это объект.
		> У него есть метод-конструктор.

	> Зачем нужен прототип?
		> Чтобы на его основе создавать объекты.
		> Используется, когда нужно создать много похожих объектов.
			Использование прототипов уменьшает объём кода.

	> Что такое функция-конструктор?
		> Это свойство объекта-прототипа, в котором лежит функция.
		> Эта фукнция запускается автоматически при создании нового объекта
			на основе прототипа.
		> Функции-конструктору можно передавать аргументы.
		> Код конструктора может быть таков, что в зависимости переданных
			аргументов результирующий объект может конструироваться по-разному.

	> О гарантированной валидности
		> Создание нового объекта из прототипа с помощью его метода-конструктора
			гарантирует, что этот объект будет именно таков, каков он был задуман
			(если в конструкторе нет ошибок).


> Узел дерева в приложении "tree". Основные факты.

	> Зачем узлам нужен прототип?
		- Узел - это объект, в котором должен быть чётко определённый набор свойств.
		- Узлов в дереве много.
		- Каждый узел должен быть валиден - иметь чётко определённый набор
			свойств, а для каждого из них должны быть выполненвы все ограничения.
		- Удобно было бы использовать какой-нибудь шаблон для клепания узлов.
			Таким шаблоном и является объект-прототип.

	> Как создать новый узел?
		- Каждый узел дерева должен быть создан из объекта-прототпа.
		- Это гарантирует, что все узлы дерева будут валидны.

	> Как получить DOM-структуру объекта-узла?
		- Для этого есть модуль "m7_nodemakedom".
		- Он подключается к данному модулю, как одна из зависимостей.

	> Основные принципы работы функции-конструктора прототипа:
		- На вход будет принимать конфигурационный объект.
		- В теле функции будет сформирован и возвращён готовый объект-узел.
		- В конфиг не обязательно передавать все параметры, а только необходимые.
		- Если не передать какой-нибудь не необходимый параметр, конструктор
			использует значение "по умолчанию", установленное для него.
		- Если в конфиге не передать один или более из обязательных параметров,
			конструктор вернёт false, что означает "ошибка",


> Инструкция по применению

	> Как использовать:

		> Создать новый объект "узел дерева", передав минимальный допустимый
			набор параметров:

				Новый способ (использован синтаксический сахар):
				-----
					var node1 = tree.node.create({
						id        : "nodeUID1",
						parent    : "nodeUID2"
					});

				Старый способ:
				-----
					var node1 = Object.create(tree.node).constructor({
						id        : "nodeUID1",
						parent    : "nodeUID2"
					});


		> Создать новый объект "узел дерева", передав в конфигурационном
			объекте уже побольше параметров (см. весь список ниже):

				Новый способ (использован синтаксический сахар):
				-----
					var node1 = tree.node.create({
						id        	: "nodeUID1",
						parent    	: "nodeUID2",
						text				: "Это текст узла",
						state     	: {
							opened   	: true,
							selected 	: true
						}
					});

				Старый способ:
				-----
					var node1 = Object.create(tree.node).constructor({
						id        	: "nodeUID1",
						parent    	: "nodeUID2",
						text				: "Это текст узла",
						state     	: {
							opened   	: true,
							selected 	: true
						}
					});

		> Создать готовый DOM-элемент узла дерева (LI) со всеми узлами,
			и получить ссылку на него:
			- Атрибут ID будет пока без прификса. Префиксы будет расставлять
				функция getTreeHTML объекта-прототипа treeProto.

					var li = node.nodemakedom();


> Параметры узла:


	Имя:						Тип:			Обязат-		Значение по		Краткое описание
														ельность:	умолчанию
	-----------------------------------------------------------------------------------
	{
1		id        	: "string"	да				false					Уникальный ID узла в этом дереве.
2		parent    	: "string"	да				false					ID узла-родителя этого узла.
3 	text     		: "string" 	нет				''						Текст узла
4		icon      	: "string"	нет				''						URL альтернативной иконки узла
5		state {    	: {}        нет											Настроечный объект состояния узла
6			opened   	: boolean 	нет				false					Раскрыт ли узел?
7			disabled 	: boolean 	нет				false					Отключен ли узел?
8			selected 	: boolean 	нет				false					Выделен ли узел?
		}
9		li_attr   	: {}      	нет				{}						Доп. атрибуты для эл-та LI узла
10	a_attr    	: {}      	нет				{}						Доп. атрибуты для эл-та LI узла
	}


> Подробное описание некоторых параметров




> Связи между параметрами узла и HTML-разметкой

	> HTML разметка узла

		> HTML-разметка с плейсхолдерами, указывающими на связь с параметрами

      	<li id={1} class="tree-node {6}">

      		<i class="tree-icon {6}"></i>

       		<a class="tree-anchor {8}">
      			<i class="tree-icon tree-icon-theme"></i>
      			{3}
      		</a>

      	</li>

    > Пример готовой HTML-разметки узла:

      	<li id="nodeUID1" class="tree-node tree-node-opened">

      		<i class="tree-icon tree-icon-opened"></i>

       		<a class="tree-anchor tree-selected">
      			<i class="tree-icon tree-icon-theme"></i>
      		</a>

      	</li>


	> Параметры и связи

		> {1}: id
			- В элемент LI надо добавить атрибут id со значением this.id.
			- Внимание! При добавлении узла в реальное дерево, нужно будет
				в атрибут id эл-та LI добавить приставку в виде ID этого дерева.

		> {2}: parent
			- Нет.
			- Этот атрибут понадобится в функции getTreeHTML для построения
				HTML-разметки всего дерева.

		> {3}: text
			- Вставляется как текстовый узел в конец эл-та A.

		> {4}: icon [!в разработке!]

		> {6}: state.opened
			- Если true, то:
				- В LI вставляется класс "tree-node-opened".
				- В i с классом "tree-icon" вставляется класс "tree-icon-opened"
			- Если false, то:
				- В LI вставляется класс "tree-node-closed".
				- В i с классом "tree-icon" вставляется класс "tree-icon-closed"

		> {7}: state.disabled [!в разработке!]

		> {8}: state.selected
			- Если true, то в A вставляется класс "tree-selected".
			- Если false, то ничего не делать.

		> {9}: li_attr [!в разработке!]

		> {10}: a_attr [!в разработке!]



> Архитектура модуля


[-----IN. Входы модуля]

IN1.	С помощью функции define определить модуль.
			> Внутри callback-функции модуля выполнить: [A,B,C,D].
			> Подключить на вход модуля следующие зависимости:
				- m1_library_v1
				- m7_nodemakedom_v1




[-----A. Создание объекта-прототипа и функции-конструктора]

a1.	Создать объект treeNodeProto, который и будет представлять собой
		прототип.

a2.	В объекте treeNodeProto создать свойство constructor, а в нём анонимную
		функцию. Эта функция должна принимать настроечный объект obj.
		Внутри этой функции выполнить следующее: [B, C, D]


[-----B. Проверка параметров ID и PARENT]

b1.	Проверить, переданы ли в obj параметры "id" и "parent". Если нет,
		то сразу вернуть false.

b2.	Проверить, соответствуют ли переданные в obj параметры "id" и "parent"
		шаблону: "nodeUID" + номер. Для parent есть исключение - он может быть
		равен "#". Если нет, то сразу вернуть false.


[-----C. Инициация параметров]

c1.	Инициировать параметр this.id:
		- Использовать значение obj.id

c2.	Инициировать параметр this.parent:
		- Использовать значение obj.parent

c3.	Инициировать параметр this.text:
		- Если obj.text не передан, использовать значение по умолчанию.
		- Если obj.text передан, использовать его.

c4.	Инициировать параметр this.icon
		- Если obj.icon не передан, использовать значение по умолчанию.
		- Если obj.icon передан, использовать его.

c5. Инициировать параметр this.state
		- Для этого выполнить следующее: [a10-a13]

c6.	Создать объект this.state = {}

c7.	Инициировать параметр this.state.opened:
			- Если obj.state или obj.state.opened не передан, использовать
				значение по умолчанию.
			- Если obj.state и obj.state.opened переданы, использовать
				значение obj.state.opened.

c8.	Инициировать параметр this.state.disabled:
			- Если obj.state или obj.state.disabled не передан, использовать
				значение по умолчанию.
			- Если obj.state и obj.state.disabled переданы, использовать
				значение obj.state.disabled.

c9.	Инициировать параметр this.state.selected:
			- Если obj.state или obj.state.selected не передан, использовать
				значение по умолчанию.
			- Если obj.state и obj.state.selected переданы, использовать
				значение obj.state.selected.

c10.	Инициировать параметр this.children значением по умолчанию


[-----D. Инициация функции nodemakedom]

d1.	Проверить, если переменная nodemakedom существует, и её значение -
		это функция, то инициировать this.nodemakedom этим значением.
		В противном случае, инициировать значением false.


[-----E. Создать и присвоить прототипу функцию create]

e1.	Создать у прототипа свойство create. Этому свойству присвоить
		анонимную функцию:
		> Аргументы:
			- obj: конфигурационный объект для создания объекта-узла
		> Возвращает:
			- Ссылку на свежесозданный объект-узел в случае успеха
			- false в случае неудачи
		> Описание функции:
			- Эта функци - синтаксический сахар.
			- Без неё для создания нового узла приходилось писать так:
						var node = Object.create(tree.node).constructor(obj);
			- С неё же это гораздо короче и понятнее:
						var node = tree.node.create(obj);


[-----OUT. Выходы модуля]

OUT1.	Вернуть ссылку на свежесозданный объект-узел



*/

/* --------------------------------------------------
---------------- Р Е А Л И З А Ц И Я ----------------*/


//[-----IN. Входы модуля]

//IN1.	С помощью функции define определить модуль.
//			> Внутри callback-функции модуля выполнить: [A,B,C,D].
//			> Подключить на вход модуля следующие зависимости:
//				- m1_library_v1
//				- m7_nodemakedom_v1
define(["m1_library/m1_library_v1", "m7_nodemakedom/m7_nodemakedom_v1"],
		function(library, nodemakedom){

		console.log('Загрузился модуль "m2_nodeproto_v1"');


//[-----A. Создание объекта-прототипа и функции-конструктора]

//a1.	Создать объект treeNodeProto, который и будет представлять собой
//		прототип.
var treeNodeProto = {


	//a2.	В объекте treeNodeProto создать свойство constructor, а в нём анонимную
	//		функцию. Эта функция должна принимать настроечный объект obj.
	//		Внутри этой функции выполнить следующее: [b1-b2, c1-c9, d1]
	constructor: function(obj) {


		//[-----B. Проверка параметров ID и PARENT]

		//b1.	Проверить, переданы ли в obj параметры "id" и "parent". Если нет,
		//		то сразу вернуть false.
		if(!obj || !obj.id || !obj.parent) return false;


		//Проверить, соответствуют ли переданные в obj параметры "id" и "parent"
		//шаблону: "nodeUID" + номер. Для parent есть исключение - он может быть
		//равен "#". Если нет, то сразу вернуть false.
		var reg = /nodeUID\d{1,}/i;		// регулярное выражение-шаблон
		if(!reg.test(obj.id) || (!reg.test(obj.parent) && obj.parent !== '#')) return false;


		//[-----C. Инициация параметров]

		//c1.	Инициировать параметр this.id:
		//		- Использовать значение obj.id
		this.id = obj.id;


		//c2.	Инициировать параметр this.parent:
		//		- Использовать значение obj.parent
		this.parent = obj.parent;


		//c3.	Инициировать параметр this.text:
		//		- Если obj.text не передан, использовать значение по умолчанию.
		//		- Если obj.text передан, использовать его.
		this.text = obj.text || '';


		//c4.	Инициировать параметр this.icon
		//		- Если obj.icon не передан, использовать значение по умолчанию.
		//		- Если obj.icon передан, использовать его.
		this.icon = obj.icon || '';


		//c5. Инициировать параметр this.state
		//		- Для этого выполнить следующее: [a10-a13]

			//c6.	Создать объект this.state = {}
			this.state = {};

			//c7.	Инициировать параметр this.state.opened:
			//			- Если obj.state или obj.state.opened не передан, использовать
			//				значение по умолчанию.
			//			- Если obj.state и obj.state.opened переданы, использовать
			//				значение obj.state.opened.
			if(obj.state && obj.state.opened) this.state.opened = obj.state.opened;
				else this.state.opened = false;

			//c8.	Инициировать параметр this.state.disabled:
			//			- Если obj.state или obj.state.disabled не передан, использовать
			//				значение по умолчанию.
			//			- Если obj.state и obj.state.disabled переданы, использовать
			//				значение obj.state.disabled.
			if(obj.state && obj.state.disabled) this.state.disabled = obj.state.disabled;
				else this.state.disabled = false;

			//c9.	Инициировать параметр this.state.selected:
			//			- Если obj.state или obj.state.selected не передан, использовать
			//				значение по умолчанию.
			//			- Если obj.state и obj.state.selected переданы, использовать
			//				значение obj.state.selected.
			if(obj.state && obj.state.selected) this.state.selected = obj.state.selected;
				else this.state.selected =	false;

		//c10.	Инициировать параметр this.children значением по умолчанию
		this.children = [];


		//[-----D. Инициация функции nodemakedom]

		//d1.	Проверить, если переменная nodemakedom существует, и её значение -
		//		это функция, то инициировать this.nodemakedom этим значением.
		//		В противном случае, инициировать значением false.

		var toStringOrigin = {}.toString;
		if(nodemakedom !== undefined &&
			 toStringOrigin.call(nodemakedom).slice(8,-1) == "Function") {

				this.nodemakedom = nodemakedom;

		}
		else this.nodemakedom = false;


		// Вернуть ссылку на свежесозданный объект
		return this;

	},


	//[-----E. Создать и присвоить прототипу функцию create]

	//e1.	Создать у прототипа свойство create. Этому свойству присвоить
	//		анонимную функцию:
	//		> Аргументы:
	//			- obj: конфигурационный объект для создания объекта-узла
	//		> Возвращает:
	//			- Ссылку на свежесозданный объект-узел в случае успеха
	//			- false в случае неудачи
	//		> Описание функции:
	//			- Эта функци - синтаксический сахар.
	//			- Без неё для создания нового узла приходилось писать так:
	//						var node = Object.create(tree.node).constructor(obj);
	//			- С неё же это гораздо короче и понятнее:
	//						var node = tree.node.create(obj);
	create : function(obj) {

		return Object.create(this).constructor(obj);

	}

};


	//[-----OUT. Выходы модуля]

	//OUT1.	Вернуть ссылку на свежесозданный объект-узел
	return treeNodeProto;

});		// конец определения модуля с помощью define

















