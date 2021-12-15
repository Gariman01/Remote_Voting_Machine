#! C:\Users\sgari\AppData\Local\Programs\Python\Python38\python.exe
import os
import cgi
from base64 import b64decode
import face_recognition
formData = cgi.FieldStorage()
face_match=0

print("Content-Type: text/html")
print()
print("<html>")
print("<body>")

flag = 0
if 'HTTP_COOKIE' in os.environ:
    for cookie in os.environ['HTTP_COOKIE'].split(';'):
        key, value = cookie.split('=')
        if key.strip() == 'UserID':
            username = value
            flag = 1
if flag==0:
    print("<script>window.location.href = 'login.php';</script>")

image=formData.getvalue("current_image")

data_uri = image
try:
    header, encoded = data_uri.split(",", 1)
    data = b64decode(encoded)
except:
    print("<script>alert('Please allow access to camera.');window.location.href = 'login.html';</script>")

curr_img_name = "curr_img/" + username + ".png"
with open(curr_img_name, "wb") as f:
    f.write(data)

got_image = face_recognition.load_image_file(curr_img_name)

existing_image = face_recognition.load_image_file("img/"+username+".jpg")

try:
    got_image_facialfeatures = face_recognition.face_encodings(got_image)[0]
except:
    print("<script>alert('We could not find a face. Please try again.');window.location.href = 'login.html';</script>")
    os.remove(curr_img_name)

existing_image_facialfeatures = face_recognition.face_encodings(existing_image)[0]

results= face_recognition.compare_faces([existing_image_facialfeatures],got_image_facialfeatures)

if(results[0]):
    face_match=1
else:
    face_match=0

os.remove(curr_img_name)
if(face_match==1):
    print("<script>window.location.href = 'session.php';</script>")
else:
    print("<script>alert('Face did not match.');window.location.href = 'signout.php';</script>")
print("</body>")
print("</html>")