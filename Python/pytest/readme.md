# Введенные команды

## Включение виртуальной среды
```
py -m venv venv
```

## Активация виртуальной среды

```
.\venv\Scripts\activate
```

## Установка зависимостей

```
pip install .\requirements.txt
```


## Подробный тест с print 
pytest -s -v filename.py::test_function