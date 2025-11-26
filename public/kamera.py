# penyiar_kamera.py
from flask import Flask, Response
import cv2

app = Flask(__name__)

def ambil_frame():
    kamera = cv2.VideoCapture(0)  # 0 = kamera utama
    while True:
        sukses, frame = kamera.read()
        if not sukses:
            break
        else:
            # Ubah frame jadi format gambar JPEG
            sukses, buffer = cv2.imencode('.jpg', frame)
            if sukses:
                data_gambar = buffer.tobytes()
                # Kirim sebagai stream MJPEG
                yield (b'--frame\r\n'
                       b'Content-Type: image/jpeg\r\n\r\n' + data_gambar + b'\r\n')

@app.route('/video')
def video():
    return Response(ambil_frame(),
                    mimetype='multipart/x-mixed-replace; boundary=frame')

if __name__ == '__main__':
    # Jalankan di semua jaringan, port 5000
    app.run(host='0.0.0.0', port=5000, debug=False)