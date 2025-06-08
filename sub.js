const token = ""
async function telegramBotAPI(token, userid) {
    const apiUrl = `https://api.telegram.org/bot${token}`;

    try {
        const response = await fetch(apiUrl+"getChatMember?chat_id=-1002733136799&user_id="+userid);
        const data = await response.json();

        if (data.code === 200) {
            const t = data;
            return t//[t.Fajr, t.Sunrise, t.Dhuhr, t.Asr, t.Maghrib, t.Isha];
        } else {
            return ["Xatolik: ma’lumot topilmadi"];
        }
    } catch {
        return ["Xatolik: API ishlamadi"];
    }
}
