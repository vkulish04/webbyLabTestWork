# WabbyLab Test


Тестовое задания на стажировку

## Функции

- Добавить фильм
- Удалить фильм
- Показать информацию о фильме
- Показать список фильмов, отсортированных по названию в алфавитном порядке
- Найти фильм по названию
- Найти фильм по имени актера.
- Импорт фильмов с текстового файла

система роботает на патерне MVC, для реализации отображения була использован css фреймвор bootstrap 4

## Установка системи

- создать дерикторию для сайта
- склонировать проект з git репозитория (https://github.com/vkulish04/webbyLabTestWork)
- создать базу даних
- в файле config/config_bd.php добавить конфиг бд
- перейти в браузере на главну страницу сайта, в результате система сама создаст таблицу для роботи в бд

## Требовани системи

- Apache_2.4
- MySQL-5.5
- PHP_7.0-7.1 и више


## Импорт даних 

Для импорта даних нужен текстовий файл с шаблоном:

Title: Blazing Saddles  
Release Year: 1974  
Format: VHS  
Stars: Mel Brooks, Clevon Little, Harvey Korman, Gene Wilder, Slim Pickens, Madeline Kahn  


Title: Casablanca  
Release Year: 1942  
Format: DVD  
Stars: Humphrey Bogart, Ingrid Bergman, Claude Rains, Peter Lorre  

в файле не должо бить лишних строк с текстом, пустие строки обрезаються