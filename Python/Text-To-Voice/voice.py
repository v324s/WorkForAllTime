import pyttsx3

engine = pyttsx3.init()
user_text = input("Введите текст, который нужно озвучить: ")
print(f"Озвучиваю: '{user_text}'...")
engine.say(user_text)
engine.runAndWait()
print("Готово!")