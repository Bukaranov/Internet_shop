Учебно задание, интернет-каталог (компания NZ)

Цель: создать интернет-каталог товаров электротехники

База данных:

Создание бд хранится в папке 'db_tables'

1. Таблица товаров (название, описание, изображение, цена, категория, бренд) - для товаров.
2. Таблица категорий (название, описание) - для хранения категорий товаров (ноутбуки, планшеты, телефоны и т.д).
3. Таблица брендов (название, описание) - для хранения фирм (samsung, apple и т.д).

Форма для создания товара:
●  название - текстовое поле (input)
●  описание - текстовое поле (textarea)
●  изображение - добавление файла (fileinput)
●  цена - текстовое поле (только число)
●  категория - выбор из тбл. категорий (select)
●  бренд - выбор из тбл. брендов (select)

Условия:
●  все поля в форме обязательны к заполнения
●  предусмотреть валидацию всех полей в зависимости от типа поля
●  все таблицы должны иметь сортировку по полям, фильтры для поиска и пагинацию (использовать плагин gridview)

За основы дизайна всят шаблон: https://getbootstrap.com/docs/3.3/examples/offcanvas/

Результат:
Для пользователя:
●  главная страница
○  слева меню категорий
○  содержание - карточки товаров (с картинкой, названием, ценой, описанием)
●  страница авторизации
Для администратора:
●  Товары (таблица товаров, добавить, удалить и редактировать)
●  Категории (таблица категорий, добавить, удалить и редактировать)
●  Бренды (таблица брендов, добавить, удалить и редактировать)
●  Выход