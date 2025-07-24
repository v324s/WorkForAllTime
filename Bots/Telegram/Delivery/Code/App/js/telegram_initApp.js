tg = window.Telegram;
WebApp = tg.WebApp;

// Тема
const theme={
    bg: WebApp.themeParams.bg_color,
    secondary_bg: WebApp.themeParams.secondary_bg_color,
    text: WebApp.themeParams.text_color,
    hint: WebApp.themeParams.hint_color,
    link: WebApp.themeParams.link_color,
    button: WebApp.themeParams.button_color,
    button_text: WebApp.themeParams.button_text_color,
}

// Приложение на весь экран
WebApp.expand();