def factorial(n):
    res = 1
    for i in range(1, n + 1):
        res *= i
    return res

for i in range(1, 6):
    print(i, '! = ', factorial(i), sep='')



# 1! = 1
# 2! = 2
# 3! = 6
# 4! = 24
# 5! = 120