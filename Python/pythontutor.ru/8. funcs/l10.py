def f():
    print(a)
    if False:
        a = 0

a = 1
f()


# UnboundLocalError на строке 2: local variable 'a' referenced before assignment