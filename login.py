#! C:\Users\sgari\AppData\Local\Programs\Python\Python38\python.exe
from os import environ
import cgi
from base64 import b64decode
import face_recognition
formData = cgi.FieldStorage()
face_match=0

print("Content-Type: text/html")
print()
print("<html>")
print("<body>")

if 'HTTP_COOKIE' in environ:
    for cookie in environ['HTTP_COOKIE'].split(';'):
        key, value = cookie.split('=')
        if key.strip() == 'UserID':
            username = value
image=formData.getvalue("current_image")

data_uri = image
header, encoded = data_uri.split(",", 1)
data = b64decode(encoded)

with open("image.png", "wb") as f:
    f.write(data)

got_image = face_recognition.load_image_file("image.png")

existing_image = face_recognition.load_image_file("img/"+username+".jpg")

try:
    got_image_facialfeatures = face_recognition.face_encodings(got_image)[0]
except:
    print("<script>alert('Face not found');</script>")

existing_image_facialfeatures = face_recognition.face_encodings(existing_image)[0]

results= face_recognition.compare_faces([existing_image_facialfeatures],got_image_facialfeatures)

if(results[0]):
    face_match=1
else:
    face_match=0


if(face_match==1):
    print("<script>window.location.href = 'result.php';</script>")
else:
    print("<script>window.location.href = 'login.php';alert('Face not recognized.')</script>")
print("</body>")
print("</html>")