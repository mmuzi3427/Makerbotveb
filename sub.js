const token = ""
async function telegramBotAPI(token) {
    const apiUrl = `https://api.telegram.org/bot${token}`;

    try {
        const response = await fetch(apiUrl+"getchatmember");
        const data = await response.json();

        if (data.code === 200) {
            const t = data.data.timings;
            return [t.Fajr, t.Sunrise, t.Dhuhr, t.Asr, t.Maghrib, t.Isha];
        } else {
            return ["Xatolik: ma’lumot topilmadi"];
        }
    } catch {
        return ["Xatolik: API ishlamadi"];
    }
}
