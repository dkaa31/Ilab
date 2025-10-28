let posisiAwal = 0;
let autoScrollInterval;

function getCurrentScheduleIndex() {
    const now = new Date();
    const currentTime = now.getHours() * 60 + now.getMinutes();

    if (jadwalHarian.length === 0) return -1;

    const first = jadwalHarian[0];
    const [firstStart] = first.waktu.split(' - ');
    const [fh, fm] = firstStart.split(':').map(Number);
    const firstTime = fh * 60 + fm;

    if (currentTime < firstTime) return -1;

    const last = jadwalHarian[jadwalHarian.length - 1];
    const [, lastEnd] = last.waktu.split(' - ');
    const [lh, lm] = lastEnd.split(':').map(Number);
    const lastTime = lh * 60 + lm;

    if (currentTime > lastTime) return -2;

    for (let i = 0; i < jadwalHarian.length; i++) {
        const [start, end] = jadwalHarian[i].waktu.split(' - ');
        const [sh, sm] = start.split(':').map(Number);
        const [eh, em] = end.split(':').map(Number);
        const sTime = sh * 60 + sm;
        const eTime = eh * 60 + em;

        if (currentTime >= sTime && currentTime < eTime) {
            return i;
        }
    }
    return -2;
}

function renderSchedule() {
    const scheduleScroll = document.getElementById('JadwalScroll');
    const jamEl = document.querySelector('.jam');
    const waktuEl = document.querySelector('.info-lab .waktu');
    const guruEl = document.querySelector('.info-lab .guru');
    const mapelEl = document.querySelector('.info-lab .mapel');
    const labEl = document.querySelector('.lab');
    const fotoGuru = document.getElementById('FotoGuru');

    if (jadwalKosong) {
        jamEl.textContent = 'TIDAK ADA JADWAL';
        waktuEl.textContent = '06:30 - 15:00';
        guruEl.textContent = penanggungjawabLab.nama;
        mapelEl.textContent = 'Penanggung Jawab Lab';
        labEl.textContent = penanggungjawabLab.lab;
        fotoGuru.src = penanggungjawabLab.foto;
        if (autoScrollInterval) clearInterval(autoScrollInterval);
        return;
    }

    const activeIndex = getCurrentScheduleIndex();

    if (activeIndex === -1) {
        jamEl.textContent = 'BELUM MASUK';
        waktuEl.textContent = '06:30 - 15:00';
        guruEl.textContent = penanggungjawabLab.nama;
        mapelEl.textContent = 'Penanggung Jawab Lab';
        labEl.textContent = penanggungjawabLab.lab;
        fotoGuru.src = penanggungjawabLab.foto;
    } else if (activeIndex === -2) {
        jamEl.textContent = 'JAM PULANG';
        waktuEl.textContent = '06:30 - 15:00';
        guruEl.textContent = penanggungjawabLab.nama;
        mapelEl.textContent = 'Penanggung Jawab Lab';
        labEl.textContent = penanggungjawabLab.lab;
        fotoGuru.src = penanggungjawabLab.foto;
    } else {
        const curr = jadwalHarian[activeIndex];
        jamEl.textContent = curr.jamKe === "Istirahat"
            ? 'ISTIRAHAT'
            : `JAM KE - ${curr.jamKe}`;
        waktuEl.textContent = curr.waktu;
        guruEl.textContent = penanggungjawabLab.nama;
        mapelEl.textContent = 'Penanggung Jawab Lab';
        labEl.textContent = curr.ruangan;
        fotoGuru.src = penanggungjawabLab.foto;
    }

    if (scheduleScroll) {
        scheduleScroll.innerHTML = '';
        jadwalHarian.forEach((jadwal, i) => {
            const isActive = i === activeIndex;
            const el = document.createElement('div');
            el.className = `jadwal-item ${isActive ? 'active' : ''}`;

            if (jadwal.jamKe === "Istirahat") {
                el.innerHTML = `
                    <div class="jadwal-detail istirahat">
                        <h3>Istirahat</h3>
                        <p>${jadwal.waktu}</p>
                        <p>Waktu Istirahat</p>
                        <p>${jadwal.ruangan}</p>
                    </div>
                `;
            } else {
                el.innerHTML = `
                    <div class="jadwal-detail">
                        <h3>${jadwal.mapel}</h3>
                        <p>${jadwal.waktu}</p>
                        <p>${jadwal.guru}</p>
                        <p>${jadwal.ruangan}</p>
                    </div>
                `;
            }
            scheduleScroll.appendChild(el);
        });
        startAutoScroll();
    }
}

function startAutoScroll() {
    if (autoScrollInterval) clearInterval(autoScrollInterval);
    const container = document.getElementById('JadwalScroll');
    if (!container) return;

    const total = container.scrollWidth;
    const visible = container.parentElement.offsetWidth;
    const scrollDist = total - visible;
    if (scrollDist <= 0) return;

    posisiAwal = 0;
    container.style.transform = 'translateX(0)';

    autoScrollInterval = setInterval(() => {
        if (Math.abs(posisiAwal) >= scrollDist) {
            posisiAwal = 0;
        } else {
            posisiAwal -= 2;
        }
        container.style.transform = `translateX(${posisiAwal}px)`;
    }, 30);
}

function updateClock() {
    const now = new Date();
    const h = String(now.getHours()).padStart(2, '0');
    const m = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('waktu').textContent = `${h}:${m}`;

    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const day = days[now.getDay()];
    const date = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();
    document.getElementById('tanggal').textContent = `${day}, ${date} ${month} ${year}`;
}

document.addEventListener('DOMContentLoaded', () => {
    renderSchedule();
    updateClock();
    setInterval(updateClock, 1000);
    setInterval(renderSchedule, 60000);
});