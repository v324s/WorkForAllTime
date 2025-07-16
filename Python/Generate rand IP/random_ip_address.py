import random
import socket
import struct


count = int(input("Сколько сгенерировать IP-адресов?: "))
for i in range(count):
    print(socket.inet_ntoa(struct.pack('>I', random.randint(1, 0xffffffff))))