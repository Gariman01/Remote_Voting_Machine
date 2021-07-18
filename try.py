#! C:\Users\sgari\AppData\Local\Programs\Python\Python38\python.exe
from os import environ

print("Content-type:text/html\r\n\r\n")

if "HTTP_COOKIE" in environ:
    print(environ["HTTP_COOKIE"])
else:
    print("HTTP_COOKIE not set!")