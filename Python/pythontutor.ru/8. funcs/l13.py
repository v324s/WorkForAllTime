# начало куска кода, который можно копировать из программы в программу
def factorial(n):
    res = 1
    for i in range(2, n + 1):
        res *= i
    return res
# конец куска кода

n = int(input())
f = factorial(n)
# дальше всякие действия с переменной f
