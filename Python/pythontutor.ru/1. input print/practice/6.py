# «Следующее и предыдущее»
# Напишите программу, которая считывает целое число и выводит текст, аналогичный приведенному в примере (пробелы важны!).

# 0:
# The next number for the number 0 is 1.
# The previous number for the number 0 is -1.

n = int(input())
print("The next number for the number {} is {}.".format(n,n+1))
print("The previous number for the number {} is {}.".format(n,n-1))
