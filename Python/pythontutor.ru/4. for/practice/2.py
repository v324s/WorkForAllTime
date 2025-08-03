# «Ряд - 2»
# Даны два целых числа A и В. Выведите все числа от A до B включительно, в порядке возрастания, если A < B, или в порядке убывания в противном случае.

a = int(input())
b = int(input())

if a < b:
    for n in range(a,b+1):
        print(n)
else:
    for n in range(b,a-1,-1):
        print(n)