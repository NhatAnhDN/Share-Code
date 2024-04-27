import telebot
import random
import os
bot = telebot.TeleBot("6945083379:AAF5I9_ly8DP53cIyOoMjPMb0yhZ83UTKak")
BALANCE_FILE = "balance.txt"
GITCODE_FILE = "gitcode.txt"



def read_balance():
  try:
    with open(BALANCE_FILE, "r") as f:
      balance = int(f.read())
  except FileNotFoundError:
    balance = 0
  except ValueError:
    balance = 0
  return balance

def write_balance(balance):
  try:
    with open(BALANCE_FILE, "w") as f:
      f.write(str(balance))
  except:
    pass



used_gitcodes = []


def create_gitcode(amount):
  gitcode = ''.join(random.choices('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
                                   k=8))
  gitcode_amounts[gitcode] = amount
  with open(GITCODE_FILE, "a") as f:
    f.write(f"{gitcode}:{amount}\n")
  return gitcode



gitcode_amounts = {}


def read_gitcodes():
  if not os.path.exists(GITCODE_FILE):
    return
  with open(GITCODE_FILE, "r") as f:
    for line in f:
      gitcode, amount = line.strip().split(":")
      gitcode_amounts[gitcode] = int(amount)



def remove_gitcode(gitcode):
  with open(GITCODE_FILE, "r") as f:
    lines = f.readlines()
  with open(GITCODE_FILE, "w") as f:
    for line in lines:
      if not line.startswith(gitcode):
        f.write(line)



@bot.message_handler(commands=['start'])
def send_welcome(message):
  bot.reply_to(
      message,
      "Chào mừng đến với game chẵn lẻ và tài xỉu! Hãy chọn một trong ba trò chơi bên dưới:\n\n( 1 ) : Chẵn lẻ\n( 2 ) : Tài xỉu\n( 3 ) : Bầu Cua\n( 4 ) : Đoán mặt đồng xu\n( 5 ) : Đoán số \n( 6 ) : Nạp tiền + gitcode\n( 7 ) : Kiểm tra số dư\n( 8 ) : Thoát\n\n( /tacgia )"
  )
  # Read Gitcodes from the file
  read_gitcodes()



@bot.message_handler(commands=['regcode'])
def create_gitcode_handler(message):
  bot.reply_to(message, "Vui lòng nhập số tiền cho gitcode:")
  bot.register_next_step_handler(message, process_gitcode_amount)



def process_gitcode_amount(message):
  try:
    amount = int(message.text)
    formatted_amount = "{:,.0f}".format(amount).replace(".", ",")
    gitcode = create_gitcode(amount)
    bot.reply_to(
        message,
        f"Đã tạo gitcode thành công. Gitcode của bạn là: {gitcode} ({formatted_amount} đồng)."
    )
  except ValueError:
    bot.reply_to(message, "Số tiền không hợp lệ.")


@bot.message_handler(func=lambda message: True)
def game(message):
  global balance, used_gitcodes
  if message.text == "1":
    if balance <= 0:
      bot.reply_to(
          message,
          "Bạn không đủ tiền để chơi trò chơi này. Vui lòng nạp thêm tiền vào tài khoản."
      )
    else:
      bot.reply_to(
          message,
          "Bạn đã chọn trò chơi chẵn lẻ. Hãy đoán số chẵn hay lẻ (nhập 'chẵn' hoặc 'lẻ'):"
      )
      bot.register_next_step_handler(message, even_odd_game)
  elif message.text == "2":
    if balance <= 0:
      bot.reply_to(
          message,
          "Bạn không đủ tiền để chơi trò chơi này. Vui lòng nạp thêm tiền vào tài khoản."
      )
    else:
      bot.reply_to(
          message,
          "Bạn đã chọn trò chơi tài xỉu. Hãy đoán tổng của hai con xúc xắc (nhập 'tài' hoặc 'xỉu'):"
      )
      bot.register_next_step_handler(message, dice_game)
  elif message.text == "6":
    bot.reply_to(
        message,
        "Vui lòng chuyển khoản tới tài khoản ngân hàng sau:\n\n👉Số tài khoản: 0339466041\n👉Chủ tài khoản: TRAN HUU HOI\n👉Tên ngân hàng: MOMO\n👉Nội dung: NẠP TIỀN BOT CLTX\n🤝Chuyển tiền xong ib admin zl 0339466041 để nhận gitcode nạp tiền\n👉Nhập (code) để nhập gitcode"
    )
    bot.register_next_step_handler(message, naptien)
  elif message.text == "code":
    bot.reply_to(message, "Vui lòng nhập gitcode nạp tiền:")
    bot.register_next_step_handler(message, naptien_gitcode)
  elif message.text == "8":
    bot.reply_to(message, "Cảm ơn bạn đã chơi game. Hẹn gặp lại!")
  elif message.text == "/tacgia":
    bot.reply_to(message, "TRANHUUHOI\n\n@tranhuuhoi : ZALO : 0339466041")
  elif message.text == "7":
    formatted_balance = "{:,.0f}".format(balance).replace(".", ",")
    bot.reply_to(message,
                 f"Số dư tài khoản của bạn là {formatted_balance} đồng.")
  elif message.text == "3":
    bot.reply_to(
        message,
        "Hãy chọn con vật muốn cược:\n\n( 1 ) Bầu\n( 2 ) Cua\n( 3 ) Tôm\n( 4 ) Cá\n( 5 ) Gà\n( 6 ) Hổ"
    )
    bot.register_next_step_handler(message, animal_selection)
# tác giả hhoi momo 0339466041. ủng hộ tôi 1k 2k để có động lực .
  elif message.text == "4":
    if balance <= 0:
      bot.reply_to(
          message,
          "Bạn không đủ tiền để chơi trò chơi này. Vui lòng nạp thêm tiền vào tài khoản."
      )
    else:
      bot.reply_to(
          message,
          "Bạn đã chọn trò chơi đoán mặt đồng xu. Hãy chọn mặt đồng xu hãy nhập (Mặt sấp / Mặt ngửa):"
      )
      bot.register_next_step_handler(message, start_toss_coin)
  elif message.text == "5":
    if balance <= 0:
      bot.reply_to(
          message,
          "Bạn không đủ tiền để chơi trò chơi này. Vui lòng nạp thêm tiền vào tài khoản."
      )
    else:
      bot.reply_to(
          message,
          "Bạn đã chọn trò chơi đoán số . Nhập ( 1 đến 5 ) để chơi đoán số .")
      bot.register_next_step_handler(message, number_guessing_game)
  else:
    bot.reply_to(
        message,
        "Xin lỗi, tôi không hiểu yêu cầu của bạn. Hãy chọn một trong ba trò chơi bên dưới:\n\n( 1 ) : Chẵn lẻ\n( 2 ) : Tài xỉu\n( 3 ) : Bầu Cua\n( 4 ) : Đoán mặt đồng xu\n( 5 ) : Đoán số \n( 6 ) : Nạp tiền + gitcode\n( 7 ) : Kiểm tra số dư\n( 8 ) : Thoát\n\n ( /tacgia )"
    )



def animal_selection(message):
  global balance
  animal_dict = {
      '1': 'Bầu',
      '2': 'Cua',
      '3': 'Tôm',
      '4': 'Cá',
      '5': 'Gà',
      '6': 'Hổ'
  }
  if message.text in animal_dict.keys():
    animal = animal_dict[message.text]
    bot.reply_to(message, f"Bạn đã chọn con vật: {animal}")
    bot.reply_to(message, "Hãy nhập số tiền muốn cược:")
    bot.register_next_step_handler(message, bet_amount_input, animal)
  else:
    bot.reply_to(message, "Lựa chọn không hợp lệ. Vui lòng chọn lại.")

def bet_amount_input(message, animal):
  global balance
  try:
    bet_amount = int(message.text)
    if bet_amount <= 999:
      bot.reply_to(message, "Số tiền cược phải lớn hơn 1000 đồng.")
    elif bet_amount > balance:
      bot.reply_to(message, "Số tiền cược lớn hơn số dư hiện tại.")
    else:
      # Code for Bầu Cua game
      animals = ['Bầu', 'Cua', 'Tôm', 'Cá', 'Gà', 'Hổ']
      selected_animal = animal
      bot.reply_to(message, f"Con vật được chọn: {selected_animal}")
      result = random.choices(animals, k=3)
      bot.reply_to(message, f"Bot đã chọn 3 con vật: {', '.join(result)}")
      if selected_animal in result:
        balance += bet_amount
        formatted_balance = "{:,.0f}".format(balance).replace(".", ",")
        bot.reply_to(
            message,
            f"Chúc mừng! Bạn đã trúng cược. Số dư tài khoản: {formatted_balance} đồng."
        )
      else:
        balance -= bet_amount
        formatted_balance = "{:,.0f}".format(balance).replace(".", ",")
        bot.reply_to(
            message,
            f"Rất tiếc! Bạn đã thua cược. Số dư tài khoản: {formatted_balance} đồng."
        )
      write_balance(balance)
  except ValueError:
    bot.reply_to(message, "Số tiền cược không hợp lệ. Vui lòng chọn lại.")


def start_toss_coin(message):
  global balance
  if message.text.lower() == "mặt sấp":
    user_choice = "mặt sấp"
  elif message.text.lower() == "mặt ngửa":
    user_choice = "mặt ngửa"
  else:
    bot.reply_to(message, "Lựa chọn không hợp lệ. Vui lòng chọn lại.")
    return
  bot.reply_to(
      message,
      f"Bạn đã đặt cược ( {user_choice} ). Vui lòng nhập số tiền cược:")
  bot.register_next_step_handler(message,
                                 lambda m: start_toss_coin_bet(m, user_choice))


def start_toss_coin_bet(message, user_choice):
  global balance
  try:
    bet_amount = int(message.text)
    if bet_amount > balance:
      bot.reply_to(
          message,
          "Bạn không đủ tiền để đặt cược này. Vui lòng đặt cược nhỏ hơn hoặc bằng số dư tài khoản."
      )
    else:
      formatted_amount = "{:,.0f}".format(bet_amount).replace(".", ",")
      bot.reply_to(
          message,
          f"Bạn đã đặt cược {formatted_amount} đồng. Đang xóc đồng xu...")
      bot_choice = random.choice(["mặt sấp", "mặt ngửa"])
      result = "thua"
      if user_choice == bot_choice:
        result = "thắng"
        balance += bet_amount
      else:
        balance -= bet_amount
      write_balance(balance)
      formatted_balance = "{:,.0f}".format(balance).replace(".", ",")
      bot.reply_to(
          message,
          f"Kết quả xóc đồng xu là ( {bot_choice} ) .Bạn {result}. Số dư tài khoản của bạn là {formatted_balance} đồng."
      )
  except ValueError:
    bot.reply_to(message, "Số tiền cược không hợp lệ. Vui lòng nhập lại.")

def number_guessing_game(message):
  global balance
  try:
    user_number = int(message.text)
    if user_number < 1 or user_number > 5:
      bot.reply_to(message,
                   "Số bạn chọn không hợp lệ. Vui lòng chọn số từ 1 đến 5.")
    else:
      bot.reply_to(
          message,
          f"Bạn đã chọn số {user_number}. Vui lòng nhập số tiền cược:")
      bot.register_next_step_handler(
          message, lambda m: process_number_bet(m, user_number))
  except ValueError:
    bot.reply_to(message, "Số bạn nhập không hợp lệ. Vui lòng nhập lại.")

def process_number_bet(message, user_number):
  global balance
  try:
    bet_amount = int(message.text)
    if bet_amount <= 0:
      bot.reply_to(
          message,
          "Số tiền cược không hợp lệ. Vui lòng nhập số tiền cược lớn hơn 0.")
    elif bet_amount > balance:
      bot.reply_to(
          message,
          "Bạn không đủ tiền để đặt cược này. Vui lòng đặt cược nhỏ hơn hoặc bằng số dư tài khoản."
      )
    else:
      formatted_amount = "{:,.0f}".format(bet_amount).replace(".", ",")
      bot.reply_to(
          message,
          f"Bạn đã đặt cược {formatted_amount} đồng. Đang chọn ngẫu nhiên 2 số..."
      )
      bot_numbers = random.sample(range(1, 6), 2)
      result = "thua"
      if user_number in bot_numbers:
        result = "thắng"
        balance += bet_amount * 2
      else:
        balance -= bet_amount
      write_balance(balance)
      formatted_balance = "{:,.0f}".format(balance).replace(".", ",")
      bot.reply_to(
          message,
          f"Bot đã chọn 2 số: {', '.join(str(num) for num in bot_numbers)}. Bạn {result}. Số dư tài khoản của bạn là {formatted_balance} đồng."
      )
  except ValueError:
    bot.reply_to(message, "Số tiền cược không hợp lệ. Vui lòng nhập lại.")



def even_odd_game(message):
  global balance
  if message.text.lower() == "chẵn":
    user_choice = "chẵn"
  elif message.text.lower() == "lẻ":
    user_choice = "lẻ"
  else:
    bot.reply_to(message, "Lựa chọn không hợp lệ. Vui lòng chọn lại.")
    return
  bot.reply_to(message,
               f"Bạn đã đặt cược {user_choice}. Vui lòng nhập số tiền cược:")
  bot.register_next_step_handler(
      message, lambda m: process_even_odd_bet(m, user_choice))


def process_even_odd_bet(message, user_choice):
  global balance
  try:
    bet_amount = int(message.text)
    if bet_amount > balance:
      bot.reply_to(
          message,
          "Bạn không đủ tiền để đặt cược này. Vui lòng đặt cược nhỏ hơn hoặc bằng số dư tài khoản."
      )
    else:
      formatted_amount = "{:,.0f}".format(bet_amount).replace(".", ",")
      bot.reply_to(
          message,
          f"Bạn đã đặt cược {formatted_amount} đồng. Đang chọn ngẫu nhiên...")
      bot_choice = random.choice(["chẵn", "lẻ"])
      result = "thua"
      if user_choice == bot_choice:
        result = "thắng"
        balance += bet_amount
      else:
        balance -= bet_amount
      write_balance(balance)
      formatted_balance = "{:,.0f}".format(balance).replace(".", ",")
      bot.reply_to(
          message,
          f"Bot đã chọn {bot_choice}. Bạn {result}. Số dư tài khoản của bạn là {formatted_balance} đồng."
      )
  except ValueError:
    bot.reply_to(message, "Số tiền cược không hợp lệ. Vui lòng nhập lại.")



def dice_game(message):
  global balance
  if message.text.lower() == "tài":
    user_choice = "tài"
  elif message.text.lower() == "xỉu":
    user_choice = "xỉu"
  else:
    bot.reply_to(message, "Lựa chọn không hợp lệ. Vui lòng chọn lại.")
    return
  bot.reply_to(message,
               f"Bạn đã đặt cược {user_choice}. Vui lòng nhập số tiền cược:")
  bot.register_next_step_handler(message,
                                 lambda m: process_dice_bet(m, user_choice))



def process_dice_bet(message, user_choice):
  global balance
  try:
    bet_amount = int(message.text)
    if bet_amount > balance:
      bot.reply_to(
          message,
          "Bạn không đủ tiền để đặt cược này. Vui lòng đặt cược nhỏ hơn hoặc bằng số dư tài khoản."
      )
    else:
      formatted_amount = "{:,.0f}".format(bet_amount).replace(".", ",")
      bot.reply_to(
          message,
          f"Bạn đã đặt cược {formatted_amount} đồng. Đang tung xúc xắc...")
      dice1 = random.randint(1, 6)
      dice2 = random.randint(1, 6)
      dice3 = random.randint(1, 6)
      total = dice1 + dice2 + dice3
      if total >= 3 and total <= 10:
        bot_choice = "xỉu"
      elif total >= 11 and total <= 18:
        bot_choice = "tài"
      else:
        bot.reply_to(
            message,
            "Có lỗi xảy ra trong quá trình tính toán. Vui lòng thử lại.")
        return
      result = "thua"
      if user_choice == bot_choice:
        result = "thắng"
        balance += bet_amount
      else:
        balance -= bet_amount
      write_balance(balance)
      formatted_balance = "{:,.0f}".format(balance).replace(".", ",")
      bot.reply_to(
          message,
          f"🎲 1 => {dice1}. 🎲 2 => {dice2}. 🎲 3 => {dice3}. Tổng là {total}. Kết quả là 👉 {bot_choice}. Bạn {result}. Số dư tài khoản của bạn là {formatted_balance} đồng."
      )
  except ValueError:
    bot.reply_to(message, "Số tiền cược không hợp lệ. Vui lòng nhập lại.")


def naptien(message):
  global balance, used_gitcodes
  if balance >= 10000000:
    bot.reply_to(message,
                 "Bạn không thể nạp tiền khi còn đủ tiền trong tài khoản.")
  else:
    bot.reply_to(message, "Nhập mã gitcode để nhận tiền:")
    bot.register_next_step_handler(message, lambda m: naptien_gitcode(m))



def naptien_gitcode(message):
  global balance, used_gitcodes
  gitcode = message.text.upper()
  if gitcode in used_gitcodes:
    bot.reply_to(
        message,
        "Gitcode đã được sử dụng trước đó. Vui lòng nhập một gitcode khác.")
  elif gitcode in gitcode_amounts:
    amount = gitcode_amounts[gitcode]
    balance += amount
    used_gitcodes.append(gitcode)
    write_balance(balance)
    # Remove the used Gitcode from the file
    remove_gitcode(gitcode)
    formatted_amount = "{:,}".format(amount)  # Định dạng số tiền với dấu phẩy
    formatted_balance = "{:,}".format(balance)  # Định dạng số dư với dấu phẩy
    bot.reply_to(
        message,
        f"Gitcode hợp lệ. Bạn đã nhận được {formatted_amount} đồng vào tài khoản. Số dư tài khoản của bạn là {formatted_balance} đồng."
    )
  else:
    bot.reply_to(message, "Gitcode không hợp lệ.")




bot.polling()
