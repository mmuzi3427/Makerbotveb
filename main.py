import logging

from aiogram import Bot, Dispatcher, executor, types
import random
from time import sleep
from func import *
# @php_bot_kodlari

API_TOKEN = '5221174647:AAHGn-adpDpbxaQk8QEvnlLUAbatlcCBL24'

# Configure logging
logging.basicConfig(level=logging.INFO)

# Initialize bot and dispatcher
bot = Bot(token=API_TOKEN, parse_mode="HTML")
dp = Dispatcher(bot)


#TYPER
async def typer(id, fname):
    txt = ""
    for i in fname:
        txt += i
        await bot.edit_message_text(f"{txt}░",  inline_message_id=id)
    await bot.edit_message_text(fname,  inline_message_id=id)

#TEXT
async def textw(id, fname):
    s1, s2 = '✨' , '💖'
    ltx = fname.lower()
    for i in ltx:
        txt = cdn(i)
        txt = txt.replace('0', s1)
        txt = txt.replace('1', s2)
        await bot.edit_message_text(f"{txt}",  inline_message_id=id)
    await bot.edit_message_text(f'✨💖{fname}💖✨',  inline_message_id=id)


#MAGIC
async def magic(id, fname):
    if bot:
        await bot.edit_message_text("❤️",  inline_message_id=id)
        arr = ["❤️", "🧡", "💛", "💚", "💙", "💜", "🤎", "🖤", "💖"]
        h = "🤍"
        first = ""		
        for i in "".join([h*9, "\n", h*2, arr[0]*2, h, arr[0]*2, h*2, "\n", h, arr[0]*7, h, "\n", h, arr[0]*7, h, "\n", h, arr[0]*7, h, "\n", h*2, arr[0]*5, h*2, "\n", h*3, arr[0]*3, h*3, "\n", h*4, arr[0], h*4]).split("\n"):
            first += i + "\n"
            await bot.edit_message_text(first,  inline_message_id=id)
            sleep(0.2)		
        for i in arr:
            await bot.edit_message_text("".join([h*9, "\n", h*2, i*2, h, i*2, h*2, "\n", h, i*7, h, "\n", h, i*7, h, "\n", h, i*7, h, "\n", h*2, i*5, h*2, "\n", h*3, i*3, h*3, "\n", h*4, i, h*4, "\n", h*9]),  inline_message_id=id)
            sleep(0.3)
        for _ in range(8):
            rand = random.choices(arr, k=34)
            await bot.edit_message_text("".join([h*9, "\n", h*2, rand[0], rand[1], h, rand[2], rand[3], h*2, "\n", h, rand[4], rand[5], rand[6], rand[7], rand[8],rand[9],rand[10], h, "\n", h, rand[11], rand[12], rand[13], rand[14], rand[15], rand[16],rand[17], h, "\n", h, rand[18], rand[19], rand[20], rand[21], rand[22], rand[23],rand[24], h, "\n", h*2, rand[25], rand[26], rand[27], rand[28], rand[29], h*2, "\n", h*3, rand[30], rand[31], rand[32], h*3, "\n", h*4, rand[33], h*4, "\n", h*9]),  inline_message_id=id)
            sleep(0.3)
        fourth = "".join([h*9, "\n", h*2, arr[0]*2, h, arr[0]*2, h*2, "\n", h, arr[0]*7, h, "\n", h, arr[0]*7, h, "\n", h, arr[0]*7, h, "\n", h*2, arr[0]*5, h*2, "\n", h*3, arr[0]*3, h*3, "\n", h*4, arr[0], h*4, "\n", h*9])
        await bot.edit_message_text(fourth,  inline_message_id=id)
        for _ in range(47):
            fourth = fourth.replace("🤍", "❤️", 1)
            await bot.edit_message_text(fourth,  inline_message_id=id)
            sleep(0.1)
        for i in range(8):
            await bot.edit_message_text((arr[0]*(8-i)+"\n")*(8-i),  inline_message_id=id)
            sleep(0.4)
        for i in ["I", "I ❤️", f"I ❤️ {fname}", f"I ❤️ {fname}!"]:
            await bot.edit_message_text(f"<b>{i}</b>",  inline_message_id=id)
            sleep(0.5)


#MAGIC2
async def magic2(id, fname):
    if bot:
        await bot.edit_message_text("❤️",  inline_message_id=id)
        arr = ["🥰", "😚", "☺️", "😘", "🤭", "😍", "😙", "🙃", "🤗"]
        h = "◽"
        first = ""		
        for i in "".join([h*9, "\n", h*2, arr[0]*2, h, arr[0]*2, h*2, "\n", h, arr[0]*7, h, "\n", h, arr[0]*7, h, "\n", h, arr[0]*7, h, "\n", h*2, arr[0]*5, h*2, "\n", h*3, arr[0]*3, h*3, "\n", h*4, arr[0], h*4]).split("\n"):
            first += i + "\n"
            await bot.edit_message_text(first,  inline_message_id=id)
            sleep(0.2)		
        for i in arr:
            await bot.edit_message_text("".join([h*9, "\n", h*2, i*2, h, i*2, h*2, "\n", h, i*7, h, "\n", h, i*7, h, "\n", h, i*7, h, "\n", h*2, i*5, h*2, "\n", h*3, i*3, h*3, "\n", h*4, i, h*4, "\n", h*9]),  inline_message_id=id)
            sleep(0.3)
        for _ in range(8):
            rand = random.choices(arr, k=34)
            await bot.edit_message_text("".join([h*9, "\n", h*2, rand[0], rand[1], h, rand[2], rand[3], h*2, "\n", h, rand[4], rand[5], rand[6], rand[7], rand[8],rand[9],rand[10], h, "\n", h, rand[11], rand[12], rand[13], rand[14], rand[15], rand[16],rand[17], h, "\n", h, rand[18], rand[19], rand[20], rand[21], rand[22], rand[23],rand[24], h, "\n", h*2, rand[25], rand[26], rand[27], rand[28], rand[29], h*2, "\n", h*3, rand[30], rand[31], rand[32], h*3, "\n", h*4, rand[33], h*4, "\n", h*9]),  inline_message_id=id)
            sleep(0.3)
        fourth = "".join([h*9, "\n", h*2, arr[0]*2, h, arr[0]*2, h*2, "\n", h, arr[0]*7, h, "\n", h, arr[0]*7, h, "\n", h, arr[0]*7, h, "\n", h*2, arr[0]*5, h*2, "\n", h*3, arr[0]*3, h*3, "\n", h*4, arr[0], h*4, "\n", h*9])
        await bot.edit_message_text(fourth,  inline_message_id=id)
        for _ in range(47):
            fourth = fourth.replace("🤍", "❤️", 1)
            await bot.edit_message_text(fourth,  inline_message_id=id)
            sleep(0.1)
        for i in range(8):
            await bot.edit_message_text((arr[0]*(8-i)+"\n")*(8-i),  inline_message_id=id)
            sleep(0.4)
        for i in ["I", "I ❤️", f"I ❤️ {fname}", f"I ❤️ {fname}!"]:
            await bot.edit_message_text(f"<b>{i}</b>",  inline_message_id=id)
            sleep(0.5)


#Hearth
async def heart(id, fname):
    for i in ['🧡','💛','💚','💙','💜','🖤','🤍','🤎','💔','❤️‍🔥','❤️‍🩹','❣️','💕','💞','💓','💗','💖','💘','💝', '❤️']:
        sleep(0.3)
        await bot.edit_message_text(i,  inline_message_id=id)


#funny
async def funny(id, fname):
    for _ in range(12):
        for i in ['😂🤣😂🤣😂🤣','🤣😂🤣😂🤣😂']:
            await bot.edit_message_text(i,  inline_message_id=id)
            sleep(0.3)

#moonsun
async def moonsun(id, fname):
    for _ in range(12):
        for i in ['🌝','🌚']:
            await bot.edit_message_text(i,  inline_message_id=id)
            sleep(0.3)


#clock
async def clock(id, fname):
    for i in "🕐🕑🕒🕓🕔🕕🕖🕗🕘🕙🕚🕛":
        await bot.edit_message_text(i,  inline_message_id=id)
        sleep(0.1)

#moon
async def moon(id, fname):
    for i in "🌖🌗🌘🌑🌒🌓🌔🌕":
        await bot.edit_message_text(i,  inline_message_id=id)
        sleep(0.1)


#juma
async def juma(id, fname):
    for i in ['──╔╗\n──║║\n──║╠╗╔╦╗╔╦══╗\n╔╗║║║║║╚╝║╔╗║\n║╚╝║╚╝║║║║╔╗╠╦╦╦╦╗\n╚══╩══╩╩╩╩╝╚╩╩╩╩╩╝', '╔═╗╔═╗──╔╗─────────╔╗\n║║╚╝║║──║║─────────║║\n║╔╗╔╗╠╗╔╣╚═╦══╦═╦══╣║╔╗\n║║║║║║║║║╔╗║╔╗║╔╣╔╗║╚╝╝\n║║║║║║╚╝║╚╝║╚╝║║║╔╗║╔╗╗\n╚╝╚╝╚╩══╩══╩══╩╝╚╝╚╩╝╚╝', '──╔╗\n──║║\n──║╠╗╔╦╗╔╦══╗\n╔╗║║║║║╚╝║╔╗║\n║╚╝║╚╝║║║║╔╗╠╦╦╦╦╗\n╚══╩══╩╩╩╩╝╚╩╩╩╩╩╝' , '╔═╗╔═╗──╔╗─────────╔╗\n║║╚╝║║──║║─────────║║\n║╔╗╔╗╠╗╔╣╚═╦══╦═╦══╣║╔╗\n║║║║║║║║║╔╗║╔╗║╔╣╔╗║╚╝╝\n║║║║║║╚╝║╚╝║╚╝║║║╔╗║╔╗╗\n╚╝╚╝╚╩══╩══╩══╩╝╚╝╚╩╝╚╝', '──╔╗\n──║║\n──║╠╗╔╦╗╔╦══╗\n╔╗║║║║║╚╝║╔╗║\n║╚╝║╚╝║║║║╔╗╠╦╦╦╦╗\n╚══╩══╩╩╩╩╝╚╩╩╩╩╩╝', '╔═╗╔═╗──╔╗─────────╔╗\n║║╚╝║║──║║─────────║║\n║╔╗╔╗╠╗╔╣╚═╦══╦═╦══╣║╔╗\n║║║║║║║║║╔╗║╔╗║╔╣╔╗║╚╝╝\n║║║║║║╚╝║╚╝║╚╝║║║╔╗║╔╗╗\n╚╝╚╝╚╩══╩══╩══╩╝╚╝╚╩╝╚╝', '◍ Juma Muborak! Qadrdonlar (◍•ᴗ•◍)']:
        await bot.edit_message_text(i,  inline_message_id=id)
        sleep(0.5)


#smile
async def smile(id, fname):
    for i in ["😀", "😃", "😄", "😁", "😆", "😅", "😂", "🤣", "😊", "😇", "🙂", "🙃", "😉", "😌", "😍", "🥰", "😘", "😗", "😙", "😚", "😋", "😛", "😝", "😜", "🤪", "🤨", "🧐", "🤓", "😎", "🤩", "🥳" ]:
        await bot.edit_message_text(i,  inline_message_id=id)
        sleep(0.3)

#police
async def police(id, fname):
    for _ in range(12):
        for i in ['🔴🔴🔴🔴🖱🖱🔵🔵🔵🔵\n🔴🔴🔴🔴🖱🖱🔵🔵🔵🔵\n🔴🔴🔴🔴🖱🖱🔵🔵🔵🔵','🔵🔵🔵🔵🖱🖱🔴🔴🔴🔴\n🔵🔵🔵🔵🖱🖱🔴🔴🔴🔴\n🔵🔵🔵🔵🖱🖱🔴🔴🔴🔴']:
            await bot.edit_message_text(i,  inline_message_id=id)
            sleep(0.3)
    await bot.edit_message_text("Police 🔴🖱🔵",  inline_message_id=id)


async def snow(id, fname):
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n\n\n\n\n\n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(0.75) 
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n    ❄️    ❄️     ❄️     ❄️     ❄️   ❄️\n\n\n\n\n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(0.75) 
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n    ❄️    ❄️     ❄️     ❄️     ❄️   ❄️\n❄️    ❄️    ❄️    ❄️    ❄️    ❄️       \n\n\n\n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(0.75) 
    await bot.edit_message_text(' ☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n   ❄️    ❄️     ❄️     ❄️     ❄️   ❄️\n❄️    ❄️    ❄️    ❄️    ❄️    ❄️       \n    ❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n\n\n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(0.75) 
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n    ❄️    ❄️     ❄️     ❄️     ❄️   ❄️\n❄️    ❄️    ❄️    ❄️    ❄️    ❄️       \n    ❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n\n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(0.75) 
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n    ❄️    ❄️     ❄️     ❄️     ❄️   ❄️\n❄️    ❄️    ❄️    ❄️    ❄️    ❄️       \n    ❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n  ❄️      ❄️    ❄️  ❄️      ❄️  ❄️ \n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(1.25) 
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n\n❄️    ❄️    ❄️    ❄️    ❄️    ❄️       \n    ❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n  ❄️      ❄️    ❄️  ❄️      ❄️  ❄️  \n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(0.75) 
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n\n\n    ❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n  ❄️      ❄️    ❄️  ❄️      ❄️  ❄️ \n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(0.75) 
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n\n\n\n❄️    ❄️    ❄️    ❄️    ❄️    ❄️     \n  ❄️      ❄️    ❄️  ❄️      ❄️  ❄️ \n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    sleep(0.75) 
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n\n\n\n\n  ❄️      ❄️    ❄️  ❄️      ❄️  ❄️ \n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)
    await bot.edit_message_text('☁️🌨☁️🌨☁️🌨☁️🌨☁️🌨☁️\n\n\n\n\n\n⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️☃️⛄️',  inline_message_id=id)


async def oqim(rid, id, q):
    if rid == '01':
        await typer(id, q)
    elif rid == '02':
        await textw(id, q)
    elif rid == '03':
        await magic(id, q)
    elif rid == '04':
        await magic2(id, q)
    elif rid == '05':
        await heart(id, q)
    elif rid == '06':
        await funny(id, q)
    elif rid == '07':
        await clock(id, q)
    elif rid == '08':
        await police(id, q)  
    elif rid == '09':
        await smile(id, q)
    elif rid == '10':
        await moonsun(id, q)
    elif rid == '11':
        await juma(id, q)
    elif rid == '12':
        await snow(id, q)
    elif rid == '13':
        await moon(id, q)

@dp.message_handler(commands=['start', 'help'])
async def send_welcome(message: types.Message):
    await message.reply("• Xush kelibsiz\nPastagi kunopkani bosing👇🏻",  reply_markup=types.InlineKeyboardMarkup().add(types.InlineKeyboardButton("⚙️ Foydalanish", switch_inline_query="Ismingiz")))


@dp.inline_handler()
async def inline_echo(inline_query: types.InlineQuery):
    text = inline_query.query or 'You'
    input_content = types.InputTextMessageContent(text)
    inl = types.InlineKeyboardMarkup().add(types.InlineKeyboardButton(".", callback_data='clear'))
    i_typer = types.InlineQueryResultArticle(
        id='01',
        thumb_url="https://i.imgur.com/sMwIBoq.jpg",
        title='✍️ yozish',
        description='yozgandek qilish',
        input_message_content=input_content,
        reply_markup=inl,
    )
    i_text = types.InlineQueryResultArticle(
        id='02',
        thumb_url="https://i.imgur.com/uxaqmlh.jpg",
        title=f'✨💖{text!r}💖✨',
        description='Text yozib keyin bosing',
        input_message_content=input_content,
        reply_markup=inl,
    )
    i_magic = types.InlineQueryResultArticle(
        id='03',
        thumb_url="https://i.imgur.com/CHXZcHr.jpg",
        title=f'I ❤️ {text!r}',
        description='magic',
        input_message_content=input_content,
        reply_markup=inl,
    )
    i_magic2 = types.InlineQueryResultArticle(
        id='04',
        thumb_url="https://i.imgur.com/t0zM5P9.jpg",
        title=f'❤️ Magic2',
        description='magic2',
        input_message_content=input_content,
        reply_markup=inl,
    )
    i_heart = types.InlineQueryResultArticle(
        id='05',
        thumb_url="https://i.imgur.com/dfrZJRT.jpg",
        title=f'❤️ hearts',
        description='yurakchalar',
        input_message_content=types.InputTextMessageContent('❤️'),
        reply_markup=inl,
    )
    i_fun = types.InlineQueryResultArticle(
        id='06',
        thumb_url="https://i.imgur.com/8f4Roel.jpg",
        title=f'🤣&😂',
        description='kulish',
        input_message_content=types.InputTextMessageContent('🤣😂🤣😂🤣😂'),
        reply_markup=inl,
    )
    i_clock = types.InlineQueryResultArticle(
        id='07',
        thumb_url="https://i.imgur.com/5i0CvFn.jpg",
        title=f'🕙Soat🕙',
        description='vaqt yurishi',
        input_message_content=types.InputTextMessageContent('🕛'),
        reply_markup=inl,
    )
    i_police = types.InlineQueryResultArticle(
        id='08',
        thumb_url="https://i.imgur.com/AOOJ8uU.jpg",
        title=f'🚔 police',
        description='police animation',
        input_message_content=types.InputTextMessageContent('🔴🔴🔴🔴🖱🖱🔵🔵🔵🔵\n🔴🔴🔴🔴🖱🖱🔵🔵🔵🔵\n🔴🔴🔴🔴🖱🖱🔵🔵🔵🔵'),
        reply_markup=inl,
    )
    i_smile = types.InlineQueryResultArticle(
        id='09',
        thumb_url="https://i.imgur.com/gUCO1Vw.jpg",
        title=f'🤪 emoji 😇',
        description='emojilar',
        input_message_content=types.InputTextMessageContent('🥳'),
        reply_markup=inl,
    )
    i_moonsun = types.InlineQueryResultArticle(
        id='10',
        thumb_url="https://i.imgur.com/4GOhVNS.jpg",
        title=f'🌚&🌝',
        description='Oy va Quyosh',
        input_message_content=types.InputTextMessageContent('🌚'),
        reply_markup=inl,
    )
    i_juma = types.InlineQueryResultArticle(
        id='11',
        thumb_url="https://i.imgur.com/al2HMcM.jpg",
        title=f'🕌 Juma Muborak',
        description='Yaqinlarni Juma bilan tabriklash uchun',
        input_message_content=types.InputTextMessageContent('🕌'),
        reply_markup=inl,
    )
    i_snow = types.InlineQueryResultArticle(
        id='12',
        thumb_url="https://i.imgur.com/xO5I4xz.jpg",
        title=f'⛄️ Snow ☃️',
        description='Qor yog\'ishi',
        input_message_content=types.InputTextMessageContent('❄️'),
        reply_markup=inl,
    )
    i_moon = types.InlineQueryResultArticle(
        id='13',
        thumb_url="https://i.imgur.com/clBZF2Y.jpg",
        title=f'🌕🌖🌗🌘🌑🌒🌓🌔',
        description='Oy to\'lishi',
        input_message_content=types.InputTextMessageContent('🌕'),
        reply_markup=inl,
    )
    lis = [i_typer, i_text, i_magic, i_magic2, i_heart, i_fun, i_clock, i_police, i_smile, i_moonsun, i_juma, i_snow, i_moon]
    msg = await inline_query.answer(results=lis, cache_time=1)
    

async def some_chosen_inline_handler(chosen_inline_result: types.ChosenInlineResult):
    rid = chosen_inline_result.result_id
    id = chosen_inline_result.inline_message_id
    q = chosen_inline_result.query or "You"
    await oqim(rid, id,  q)
    
    
# @php_bot_kodlari https://t.me/php_bot_kodlari

if __name__ == '__main__':
    dp.register_chosen_inline_handler(some_chosen_inline_handler, lambda chosen_inline_result: True)
    executor.start_polling(dp, skip_updates=True)