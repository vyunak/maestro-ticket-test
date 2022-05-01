# Maestro Ticket System
## _Test task_

### 1. SQL
- Составьте список пользователей users, которые осуществили хотя бы один заказ orders в интернет магазине.

```
create DATABASE shop;
use shop;
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) COMMENT 'Имя покупателя',
  birthday_at DATE COMMENT 'Дата рождения',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) COMMENT = 'Покупатели';

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  id SERIAL PRIMARY KEY,
  user_id INT UNSIGNED,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY index_of_user_id(user_id)
) COMMENT = 'Заказы';

INSERT INTO orders VALUES
  (DEFAULT, 1, DEFAULT, DEFAULT),
  (DEFAULT, 1, DEFAULT, DEFAULT),
  (DEFAULT, 2, DEFAULT, DEFAULT)

INSERT INTO users VALUES
  (DEFAULT, 'alex73', '1982-10-11', NOW(), NOW()),
  (DEFAULT, 'admin', '1990-01-01', NOW(), NOW()),
  (DEFAULT, 'third client', '1990-01-01', NOW(), NOW())
```
### 2. Работа с массивами и строками.

- Есть список временных интервалов (интервалы записаны в формате чч:мм-чч:мм).

 Необходимо написать две функции:

 2.1 Первая функция должна проверять временной интервал на валидность
принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм)
возвращать boolean

 2.2 Вторая функция должна проверять "наложение интервалов" при попытке добавить новый интервал в список существующих
принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм)
возвращать boolean

 "наложение интервалов" - это когда в промежутке между началом и окончанием одного интервала, встречается начало, окончание или то и другое одновременно, другого интервала.

 Пример:

 Cуществующие интервалы
 ```
"10:00-14:00"
"16:00-20:00"
```
пытаемся добавить еще один интервал
```
"09:00-11:00" => произошло наложение
"11:00-13:00" => произошло наложение
"14:00-16:00" => наложения нет
"14:00-17:00" => произошло наложение
```

 Входные данные: Можно использовать список:
```
$list = array (
	'09:00-11:00',
	'11:00-13:00',
	'15:00-16:00',
	'17:00-20:00',
	'20:30-21:30',
	'21:30-22:30',
);
```