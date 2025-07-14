using System.Windows.Forms;
using System.Net.NetworkInformation;
using System.Threading;

namespace pingerok
{
    public partial class MainForm : Form
    {
        private string programName = "Pingerok";
        private Label? selectedLabel = null; // Для перемещения меток
        private Button? selectedButton = null; // Хранит ссылку на перетаскиваемую кнопку
        private Point mouseOffset; // Сдвиг мыши относительно левого верхнего угла кнопки
        private bool isDragging = false; // Указывает, идет ли перемещение

        private bool isFullScreen = false;

        public List<(string IpAddress, Point Location)> ipAddressList = new List<(string, Point)>();
        public List<(string LabelText, Point Location)> labelList = new List<(string, Point)>();

        private Dictionary<string, int> pingFailures = new Dictionary<string, int>();
        private Dictionary<string, int> pingSuccesses = new Dictionary<string, int>();

        private string filePathLabel;

        public MainForm()
        {
            InitializeComponent();
            this.Text = programName;
        }

        private void StartPingForIp(string ipAddress)
        {
            Thread pingThread = new Thread(() =>
            {
                Ping pingSender = new Ping();
                PingReply reply;

                while (true)
                {
                    try
                    {
                        reply = pingSender.Send(ipAddress, 1000); // Таймаут 1 секунда

                        if (reply.Status == IPStatus.Success)
                        {
                            // Успешный пинг
                            if (!pingSuccesses.ContainsKey(ipAddress))
                                pingSuccesses[ipAddress] = 0;

                            UpdateButtonColor(ipAddress, Color.Yellow);
                            pingSuccesses[ipAddress]++;
                            pingFailures[ipAddress] = 0; // Сбрасываем ошибки

                            if (pingSuccesses[ipAddress] >= 5)
                                UpdateButtonColor(ipAddress, Color.LimeGreen);
                        }
                        else
                        {
                            // Неудачный пинг
                            RegisterPingFailure(ipAddress);
                        }
                    }
                    catch
                    {
                        // Любая ошибка пинга
                        RegisterPingFailure(ipAddress);
                    }

                    Thread.Sleep(1000); // Интервал между проверками
                }
            });

            pingThread.IsBackground = true; // Поток завершится при закрытии программы
            pingThread.Start();
        }
        private void RegisterPingFailure(string ipAddress)
        {
            if (!pingFailures.ContainsKey(ipAddress))
                pingFailures[ipAddress] = 0;

            pingFailures[ipAddress]++;
            pingSuccesses[ipAddress] = 0; // Сбрасываем успешные попытки

            if (pingFailures[ipAddress] >= 3 && pingFailures[ipAddress] < 10)
                UpdateButtonColor(ipAddress, Color.Yellow);
            else if (pingFailures[ipAddress] >= 10)
                UpdateButtonColor(ipAddress, Color.Red);
        }

        private void UpdateButtonColor(string ipAddress, Color color)
        {
            if (InvokeRequired)
            {
                Invoke(new Action(() => UpdateButtonColor(ipAddress, color)));
                return;
            }

            foreach (Control control in panel1.Controls)
            {
                if (control is Button button && button.Text == ipAddress)
                {
                    button.BackColor = color;
                    break;
                }
            }
        }
        private void SaveConfig(string filePath)
        {
            UpdateIpAddressList(); // Обновляем список IP-адресов
            UpdateLabelList();     // Обновляем список меток

            using (StreamWriter writer = new StreamWriter(filePath))
            {
                // Сохраняем кнопки (IP-адреса)
                foreach (var (ip, location) in ipAddressList)
                {
                    writer.WriteLine($"IP,{ip},{location.X},{location.Y}");
                }

                // Сохраняем метки
                foreach (var (labelText, location) in labelList)
                {
                    writer.WriteLine($"LABEL,{labelText},{location.X},{location.Y}");
                }
            }
        }
        private void LoadConfig(string filePath)
        {
            ipAddressList.Clear();
            labelList.Clear();
            panel1.Controls.Clear(); // Очищаем все элементы на панели

            using (StreamReader reader = new StreamReader(filePath))
            {
                string? line;
                while ((line = reader.ReadLine()) != null)
                {
                    var parts = line.Split(',');
                    if (parts.Length == 4 &&
                        int.TryParse(parts[2], out int x) &&
                        int.TryParse(parts[3], out int y))
                    {
                        string type = parts[0];
                        string text = parts[1];
                        Point location = new Point(x, y);

                        if (type == "IP")
                        {
                            ipAddressList.Add((text, location));
                            AddIpButton(text, location);
                        }
                        else if (type == "LABEL")
                        {
                            labelList.Add((text, location));
                            AddLabel(text, location);
                        }
                    }
                }
                filePathLabel = filePath;

            }
        }
        private void UpdateLabelList()
        {
            labelList.Clear();
            foreach (Control control in panel1.Controls)
            {
                if (control is Label label)
                {
                    string text = label.Text;
                    Point location = label.Location;
                    labelList.Add((text, location));
                }
            }
        }

        // Меню - отркыть
        private void открытьToolStripMenuItem_Click(object sender, EventArgs e)
        {
            OpenFileDialog openFileDialog = new OpenFileDialog
            {
                Filter = "Config files (*.conf)|*.conf|All files (*.*)|*.*",
                Title = "Открыть конфигурационный файл"
            };

            if (openFileDialog.ShowDialog() == DialogResult.OK)
            {
                LoadConfig(openFileDialog.FileName);
                this.Text = $"{programName} - {openFileDialog.FileName}";
            }
        }

        private void UpdateIpAddressList()
        {
            ipAddressList.Clear();
            foreach (Control control in panel1.Controls)
            {
                if (control is Button button)
                {
                    string ip = button.Text;
                    Point location = button.Location;
                    ipAddressList.Add((ip, location));
                }
            }
        }

        // Меню - сохранить как
        private void сохранитьКакToolStripMenuItem_Click(object sender, EventArgs e)
        {
            SaveFileDialog saveFileDialog = new SaveFileDialog
            {
                Filter = "Config files (*.conf)|*.conf|All files (*.*)|*.*",
                Title = "Сохранить конфигурационный файл"
            };

            if (saveFileDialog.ShowDialog() == DialogResult.OK)
            {
                SaveConfig(saveFileDialog.FileName);
            }
        }

        // Загрузка формы
        private void Form1_Load(object sender, EventArgs e)
        {

        }

        // Ивенты мышки на кнопке
        private void IpButton_MouseDown(object sender, MouseEventArgs e)
        {
            if (sender is Button button && e.Button == MouseButtons.Left)
            {
                // Если кнопка уже выбрана, зафиксируем её
                if (isDragging)
                {
                    isDragging = false;
                    selectedButton = null;
                }
                else
                {
                    // Начинаем перемещение
                    isDragging = true;
                    selectedButton = button;

                    // Вычисляем сдвиг мыши относительно кнопки
                    mouseOffset = new Point(e.X, e.Y);
                }
            }
        }

        // Ивенты мышки на кнопке
        private void IpButton_MouseMove(object sender, MouseEventArgs e)
        {
            if (isDragging && selectedButton != null)
            {
                // Получаем координаты курсора относительно панели
                Point newLocation = panel1.PointToClient(Cursor.Position);

                // Устанавливаем новое положение кнопки с учетом сдвига мыши
                selectedButton.Location = new Point(
                    newLocation.X - mouseOffset.X,
                    newLocation.Y - mouseOffset.Y
                );
            }
        }

        // Ивенты мышки на кнопке
        private void IpButton_MouseUp(object sender, MouseEventArgs e)
        {
            if (sender is Button && e.Button == MouseButtons.Left && isDragging)
            {
                // Останавливаем перемещение
                isDragging = false;
                selectedButton = null;
            }
        }

        // Ивенты мышки на метке
        private void Label_MouseDown(object sender, MouseEventArgs e)
        {
            if (sender is Label label && e.Button == MouseButtons.Left)
            {
                if (isDragging)
                {
                    // Завершаем перемещение, если уже идет
                    isDragging = false;
                    selectedLabel = null;
                }
                else
                {
                    // Начинаем перемещение
                    isDragging = true;
                    selectedLabel = label;

                    // Вычисляем сдвиг мыши относительно метки
                    mouseOffset = new Point(e.X, e.Y);
                }
            }
        }

        // Ивенты мышки на метке
        private void Label_MouseMove(object sender, MouseEventArgs e)
        {
            if (isDragging && selectedLabel != null)
            {
                // Получаем координаты курсора относительно панели
                Point newLocation = panel1.PointToClient(Cursor.Position);

                // Устанавливаем новое положение метки с учетом сдвига мыши
                selectedLabel.Location = new Point(
                    newLocation.X - mouseOffset.X,
                    newLocation.Y - mouseOffset.Y
                );
            }
        }

        // Ивенты мышки на метке
        private void Label_MouseUp(object sender, MouseEventArgs e)
        {
            if (sender is Label && e.Button == MouseButtons.Left && isDragging)
            {
                // Останавливаем перемещение
                isDragging = false;
                selectedLabel = null;
            }
        }

        // Функция добавления ip
        public void AddIpButton(string ipAddress, Point location)
        {
            if (!ipAddressList.Any(ip => ip.IpAddress == ipAddress))
            {
                ipAddressList.Add((ipAddress, location)); // Добавляем IP-адрес и координаты в список
            }

            Button ipButton = new Button
            {
                Text = ipAddress,
                BackColor = Color.Gray,
                Size = new Size(150, 40),
                Location = location,
                FlatStyle = FlatStyle.Popup,
                Enabled = toolStripMenuItemPositioningMode.Checked
            };


            ipButton.MouseDown += IpButton_MouseDown;
            ipButton.MouseMove += IpButton_MouseMove;
            ipButton.MouseUp += IpButton_MouseUp;

            this.panel1.Controls.Add(ipButton);
            StartPingForIp(ipAddress);
        }

        // Функция добавления метки
        public void AddLabel(string labelText, Point location)
        {
            Label label = new Label
            {
                Text = labelText,
                BackColor = Color.LightGray,
                AutoSize = true,
                ForeColor = Color.Black,
                Location = location,
                Enabled = toolStripMenuItemPositioningMode.Checked // Режим позиционирования
            };

            // Добавляем обработчики событий для перемещения
            label.MouseDown += Label_MouseDown;
            label.MouseMove += Label_MouseMove;
            label.MouseUp += Label_MouseUp;

            this.panel1.Controls.Add(label);
        }


        // Меню - адреса
        private void адресаToolStripMenuItem_Click(object sender, EventArgs e)
        {
            using (AddressForm addressForm = new AddressForm())
            {
                addressForm.Owner = this;
                addressForm.ShowDialog();
            }
        }

        // Меню - полноэкранный режим
        private void fullsizeToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (!isFullScreen)
            {
                fullsizeToolStripMenuItem.Checked = true;
                this.FormBorderStyle = FormBorderStyle.None;
                this.WindowState = FormWindowState.Maximized;
                //this.TopMost = true; // Поверх всех окон
                isFullScreen = true;
            }
            else
            {
                fullsizeToolStripMenuItem.Checked = false;
                this.FormBorderStyle = FormBorderStyle.Sizable;
                this.WindowState = FormWindowState.Normal;
                //this.TopMost = false; // Убираем "поверх всех окон"
                isFullScreen = false;
            }
        }

        // Меню - выход
        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        // Меню - режим позиционирования
        private void toolStripMenuItemPositioningMode_Click(object sender, EventArgs e)
        {
            toolStripMenuItemPositioningMode.Checked = !toolStripMenuItemPositioningMode.Checked;

            // Включаем или выключаем все кнопки на панели
            foreach (Control control in panel1.Controls)
            {
                if (control is Button button)
                {
                    button.Enabled = toolStripMenuItemPositioningMode.Checked;
                }
                else if (control is Label label)
                {
                    label.Enabled = toolStripMenuItemPositioningMode.Checked;
                }
            }
        }


        // Функция удаления кнопки
        public void RemoveIpButton(string ipAddress)
        {
            foreach (Control control in panel1.Controls)
            {
                if (control is Button button && button.Text == ipAddress)
                {
                    panel1.Controls.Remove(button);
                    button.Dispose();
                    break;
                }
            }
        }


        // Меню - добавить метку
        private void добавитьМеткуToolStripMenuItem_Click(object sender, EventArgs e)
        {
            using (Form inputForm = new Form())
            {
                inputForm.Text = "Добавить метку";
                inputForm.Size = new Size(300, 150);

                TextBox textBox = new TextBox { Left = 20, Top = 20, Width = 240 };
                Button okButton = new Button { Text = "OK", Left = 100, Top = 60, DialogResult = DialogResult.OK };

                inputForm.Controls.Add(textBox);
                inputForm.Controls.Add(okButton);

                inputForm.AcceptButton = okButton;

                if (inputForm.ShowDialog() == DialogResult.OK)
                {
                    string labelText = textBox.Text;
                    Point location = new Point(10, 10); // Начальное положение
                    labelList.Add((labelText, location));
                    AddLabel(labelText, location);
                }
            }
        }

        private bool blackTheme = false;
        private void темнаяТемаToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (blackTheme == false)
            {
                темнаяТемаToolStripMenuItem.Checked = true;
                blackTheme = true;
                toolStripMenuItem1.BackColor = Color.FromArgb(64, 64, 64);
                //toolStripMenuItem1.ForeColor = Color.White;
                panel1.BackColor = Color.FromArgb(20, 20, 20);
                foreach (ToolStripMenuItem m in toolStripMenuItem1.Items)
                {
                    SetWhiteColor(m);
                }
                toolStripMenuItem1.Renderer = new ToolStripProfessionalRenderer(new Cols());
                foreach (Control control in panel1.Controls)
                {
                    if (control is Label label)
                    {
                        //label.BackColor = Color.Black;
                        label.ForeColor = Color.Pink;
                    }
                }
            }
            else
            {
                темнаяТемаToolStripMenuItem.Checked = false;
                blackTheme = false;
                toolStripMenuItem1.BackColor = SystemColors.Control;
                //toolStripMenuItem1.ForeColor = Color.Black;
                panel1.BackColor = SystemColors.Control;
                foreach (Control control in panel1.Controls)
                {
                    if (control is Label label)
                    {
                        label.BackColor = Color.LightGray;
                        label.ForeColor = Color.Black;
                    }
                }

            }
        }
        private void SetWhiteColor(ToolStripMenuItem item)
        {
            item.ForeColor = Color.White;
            foreach (ToolStripMenuItem it in item.DropDownItems)
            {
                SetWhiteColor(it);
            }
        }

        public class Cols : ProfessionalColorTable
        {
            public override Color MenuItemSelected
            {
                // 51, 153, 255 - устанавливаем голубой цвет выбранного элемента
                // (или задаете свой)
                get { return Color.FromArgb(64, 64, 64); }
            }

            public override Color ToolStripDropDownBackground
            {
                get { return Color.Black; }
            }

            public override Color ImageMarginGradientBegin
            {
                get { return Color.Black; }
            }

            public override Color ImageMarginGradientEnd
            {
                get { return Color.Black; }
            }

            public override Color ImageMarginGradientMiddle
            {
                get { return Color.Black; }
            }

            public override Color MenuItemSelectedGradientBegin
            {
                get { return Color.FromArgb(64, 64, 64); }
            }
            public override Color MenuItemSelectedGradientEnd
            {
                get { return Color.FromArgb(64, 64, 64); }
            }

            public override Color MenuItemPressedGradientBegin
            {
                get { return Color.FromArgb(64, 64, 64); }
            }

            public override Color MenuItemPressedGradientMiddle
            {
                get { return Color.FromArgb(64, 64, 64); }
            }

            public override Color MenuItemPressedGradientEnd
            {
                get { return Color.FromArgb(64, 64, 64); }
            }

            public override Color MenuItemBorder
            {
                get { return Color.FromArgb(64, 64, 64); }
            }
        }
    }
}
