import hashlib

str = input("Введите строку которую нужно зашифровать: ")
str = str.encode('utf-8')
hash_object = hashlib.sha256(str)
hex_dig = hash_object.hexdigest()
print(hex_dig)