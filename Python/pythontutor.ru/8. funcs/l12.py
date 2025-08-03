def factorial(n):
    global f
    res = 1
    for i in range(2, n + 1):
        res *= i
    f = res

n = int(input())
factorial(n)
# дальше всякие действия с переменной f
